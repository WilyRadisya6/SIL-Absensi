<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfigurasiJamKerja;

class JamKerjaController extends Controller
{
    public function index()
    {
        $title = 'Konfigurasi Jam Kerja';
        $configs = KonfigurasiJamKerja::all();

        if ($configs->isEmpty()) {
            // Fallback just in case
            KonfigurasiJamKerja::create(['nama_shift' => 'Non-Shift', 'jam_masuk' => '08:00:00', 'jam_pulang' => '16:00:00']);
            KonfigurasiJamKerja::create(['nama_shift' => 'Shift 1', 'jam_masuk' => '07:00:00', 'jam_pulang' => '15:00:00']);
            KonfigurasiJamKerja::create(['nama_shift' => 'Shift 2', 'jam_masuk' => '15:00:00', 'jam_pulang' => '23:00:00']);
            KonfigurasiJamKerja::create(['nama_shift' => 'Shift 3', 'jam_masuk' => '23:00:00', 'jam_pulang' => '07:00:00']);
            $configs = KonfigurasiJamKerja::all();
        }

        return view('admin.jam-kerja.index', compact('title', 'configs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'jam_masuk' => 'required|array',
            'jam_pulang' => 'required|array'
        ]);

        foreach ($request->jam_masuk as $id => $jam_masuk) {
            $config = KonfigurasiJamKerja::find($id);
            if ($config) {
                $config->update([
                    'jam_masuk' => $jam_masuk,
                    'jam_pulang' => $request->jam_pulang[$id] ?? $config->jam_pulang
                ]);
            }
        }

        return redirect()->back()->with('success', 'Konfigurasi jam kerja berhasil diperbarui!');
    }
}
