<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold" style="color: #15803d;">Dashboard</h2>
            <p class="text-sm text-gray-500 mt-0.5">Selamat datang, {{ Auth::user()->name }}. Berikut ringkasan data hari ini.</p>
        </div>
    </x-slot>

    <div class="px-5 pt-6">
        <div class="w-full flex flex-wrap xl:flex-nowrap justify-center gap-4">

            <a href="{{ route('admin.karyawan') }}" class="sil-stat-card w-full md:w-1/4 lg:w-1/5" title="Lihat Data Karyawan">
                <div class="icon-wrap">
                    <i class="ri-team-line"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalKaryawan }}</div>
                    <div class="stat-label">Total Karyawan</div>
                </div>
            </a>

            <a href="{{ route('admin.monitoring-presensi', ['tanggal_presensi' => \Carbon\Carbon::now()->format('Y-m-d')]) }}" class="sil-stat-card w-full md:w-1/4 lg:w-1/5" title="Lihat Monitoring Presensi Hari Ini">
                <div class="icon-wrap">
                    <i class="ri-fingerprint-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $rekapPresensi->jml_kehadiran }}</div>
                    <div class="stat-label">Karyawan Hadir</div>
                </div>
            </a>

            <a href="{{ route('admin.administrasi-presensi', ['status' => 'S']) }}" class="sil-stat-card w-full md:w-1/4 lg:w-1/5" title="Lihat Pengajuan Sakit">
                <div class="icon-wrap">
                    <i class="ri-hospital-line"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $rekapPengajuanPresensi->jml_sakit }}</div>
                    <div class="stat-label">Karyawan Sakit</div>
                </div>
            </a>

            <a href="{{ route('admin.administrasi-presensi', ['status' => 'I']) }}" class="sil-stat-card w-full md:w-1/4 lg:w-1/5" title="Lihat Pengajuan Izin">
                <div class="icon-wrap">
                    <i class="ri-file-list-3-line"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $rekapPengajuanPresensi->jml_izin }}</div>
                    <div class="stat-label">Karyawan Izin</div>
                </div>
            </a>

            <a href="{{ route('admin.monitoring-presensi', ['tanggal_presensi' => \Carbon\Carbon::now()->format('Y-m-d'), 'terlambat' => 1]) }}" class="sil-stat-card w-full md:w-1/4 lg:w-1/5" title="Lihat Karyawan Terlambat Hari Ini">
                <div class="icon-wrap">
                    <i class="ri-time-line"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $rekapPresensi->jml_terlambat }}</div>
                    <div class="stat-label">Karyawan Terlambat</div>
                </div>
            </a>

        </div>
    </div>
</x-app-layout>