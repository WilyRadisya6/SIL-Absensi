<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        
        $user = Auth::guard('karyawan')->user();
        $jamKerja = \App\Models\KonfigurasiJamKerja::where('nama_shift', $user->jenis_shift ?? 'Non-Shift')->first() ?? (object)['jam_masuk' => '08:00:00', 'jam_pulang' => '16:00:00'];

        $hariIni = Carbon::now()->format("Y-m-d");
        $presensiHariIni = DB::table("presensi")
            ->where('nik', $user->nik)
            ->where('tanggal_presensi', $hariIni)
            ->first();

        $riwayatPresensi = DB::table("presensi")
            ->where('nik', $user->nik)
            // Cara 1 mencari tanggal
            ->whereMonth('tanggal_presensi', date('m'))
            ->whereYear('tanggal_presensi', date('Y'))
            ->orderBy("tanggal_presensi", "desc")
            ->paginate(10);

        $rekapPresensi = DB::table("presensi")
            ->selectRaw("COUNT(nik) as jml_kehadiran, SUM(IF (jam_masuk > '{$jamKerja->jam_masuk}',1,0)) as jml_terlambat")
            ->where('nik', $user->nik)
            // Cara 2 mencari tanggal
            ->whereRaw("MONTH(tanggal_presensi)='" . date('m') . "'")
            ->whereRaw("YEAR(tanggal_presensi)='" . date('Y') . "'")
            ->first();

        $rekapPengajuanPresensi = DB::table("pengajuan_presensi")
            ->selectRaw("SUM(IF (status = 'I',1,0)) as jml_izin, SUM(IF (status = 'S',1,0)) as jml_sakit")
            ->where('nik', $user->nik)
            ->where('status_approved', 2)
            ->whereRaw("MONTH(tanggal_pengajuan)='" . date('m') . "'")
            ->whereRaw("YEAR(tanggal_pengajuan)='" . date('Y') . "'")
            ->first();

        // Ensure we don't pass null if query results in null sums
        if (!$rekapPengajuanPresensi->jml_izin) $rekapPengajuanPresensi->jml_izin = 0;
        if (!$rekapPengajuanPresensi->jml_sakit) $rekapPengajuanPresensi->jml_sakit = 0;
        if (!$rekapPresensi->jml_kehadiran) $rekapPresensi->jml_kehadiran = 0;
        if (!$rekapPresensi->jml_terlambat) $rekapPresensi->jml_terlambat = 0;

        $leaderboard = DB::table("presensi as p")
            ->join('karyawan as k', 'k.nik', '=', 'p.nik')
            ->where('tanggal_presensi', $hariIni)
            ->orderBy('jam_masuk', 'asc')
            ->paginate(10);

        return view("dashboard.index", compact("title", "presensiHariIni", "riwayatPresensi", "rekapPresensi", "rekapPengajuanPresensi", "leaderboard", "jamKerja"));
    }

    public function indexAdmin()
    {
        $title = "Dashboard Admin";

        $hariIni = Carbon::now()->format("Y-m-d");

        $totalKaryawan = Karyawan::count();

        $rekapPresensi = DB::table("presensi as p")
            ->join('karyawan as k', 'k.nik', '=', 'p.nik')
            ->leftJoin('konfigurasi_jam_kerja as j', 'k.jenis_shift', '=', 'j.nama_shift')
            ->selectRaw("COUNT(p.nik) as jml_kehadiran, SUM(IF (p.jam_masuk > j.jam_masuk,1,0)) as jml_terlambat")
            ->where('p.tanggal_presensi', $hariIni)
            ->first();

        $rekapPengajuanPresensi = DB::table("pengajuan_presensi")
            ->selectRaw("SUM(IF (status = 'I',1,0)) as jml_izin, SUM(IF (status = 'S',1,0)) as jml_sakit")
            ->where('status_approved', 2)
            ->where('tanggal_pengajuan', $hariIni)
            ->first();

        // Ensure we don't pass null if query results in null sums
        if (!$rekapPengajuanPresensi->jml_izin) $rekapPengajuanPresensi->jml_izin = 0;
        if (!$rekapPengajuanPresensi->jml_sakit) $rekapPengajuanPresensi->jml_sakit = 0;
        if (!$rekapPresensi->jml_kehadiran) $rekapPresensi->jml_kehadiran = 0;
        if (!$rekapPresensi->jml_terlambat) $rekapPresensi->jml_terlambat = 0;

        return view("admin.dashboard", compact("title", "totalKaryawan", "rekapPresensi", "rekapPengajuanPresensi"));
    }

    public function bacaNotifikasi($id)
    {
        $notification = Auth::guard('karyawan')->user()->notifications()->find($id);
        
        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }
}
