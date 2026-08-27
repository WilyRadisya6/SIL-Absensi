<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold" style="color: #15803d;">Dashboard</h2>
            <p class="text-sm text-gray-500 mt-0.5">Selamat datang, {{ Auth::user()->name }}. Berikut ringkasan data hari ini.</p>
        </div>
    </x-slot>

    <div class="px-5 pt-6">
        <div class="w-full flex flex-wrap xl:flex-nowrap justify-center gap-4">

            <div class="sil-stat-card w-full md:w-1/4 lg:w-1/5">
                <div class="icon-wrap">
                    <i class="ri-team-line"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalKaryawan }}</div>
                    <div class="stat-label">Total Karyawan</div>
                </div>
            </div>

            <div class="sil-stat-card w-full md:w-1/4 lg:w-1/5">
                <div class="icon-wrap">
                    <i class="ri-fingerprint-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $rekapPresensi->jml_kehadiran }}</div>
                    <div class="stat-label">Karyawan Hadir</div>
                </div>
            </div>

            <div class="sil-stat-card w-full md:w-1/4 lg:w-1/5">
                <div class="icon-wrap">
                    <i class="ri-hospital-line"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $rekapPengajuanPresensi->jml_sakit }}</div>
                    <div class="stat-label">Karyawan Sakit</div>
                </div>
            </div>

            <div class="sil-stat-card w-full md:w-1/4 lg:w-1/5">
                <div class="icon-wrap">
                    <i class="ri-file-list-3-line"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $rekapPengajuanPresensi->jml_izin }}</div>
                    <div class="stat-label">Karyawan Izin</div>
                </div>
            </div>

            <div class="sil-stat-card w-full md:w-1/4 lg:w-1/5">
                <div class="icon-wrap">
                    <i class="ri-time-line"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $rekapPresensi->jml_terlambat }}</div>
                    <div class="stat-label">Karyawan Terlambat</div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

