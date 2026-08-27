<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold" style="color: #15803d;">{{ $title }}</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola pengaturan jam masuk dan jam pulang standar perusahaan</p>
        </div>
    </x-slot>
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mt-0 mb-6 md:w-1/2 md:flex-none">
                <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="mb-0 text-slate-800 dark:text-white">Konfigurasi Jam Kerja</h5>
                        </div>
                        
                        @if(session('success'))
                            <div class="relative p-4 mb-4 text-white border border-solid rounded-lg bg-gradient-to-tl from-green-600 to-lime-400 border-lime-300">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.jam-kerja.update') }}" method="POST">
                            @csrf
                            <div class="flex flex-col mb-4">
                                <label for="jam_masuk" class="mb-2 text-sm font-bold text-slate-700 dark:text-white/80">Jam Masuk</label>
                                <input type="time" name="jam_masuk" id="jam_masuk" value="{{ old('jam_masuk', date('H:i', strtotime($config->jam_masuk))) }}" class="input input-bordered w-full" required>
                                @error('jam_masuk')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="flex flex-col mb-6">
                                <label for="jam_pulang" class="mb-2 text-sm font-bold text-slate-700 dark:text-white/80">Jam Pulang</label>
                                <input type="time" name="jam_pulang" id="jam_pulang" value="{{ old('jam_pulang', date('H:i', strtotime($config->jam_pulang))) }}" class="input input-bordered w-full" required>
                                @error('jam_pulang')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-full text-white">Simpan Konfigurasi</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="w-full max-w-full px-3 mt-0 mb-6 md:w-1/2 md:flex-none">
                <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="p-6">
                        <h5 class="mb-4 text-slate-800 dark:text-white">Informasi</h5>
                        <p class="text-sm text-slate-700 dark:text-white/80">
                            Konfigurasi ini digunakan sebagai dasar untuk menentukan status kehadiran karyawan:
                        </p>
                        <ul class="list-disc pl-5 mt-2 text-sm text-slate-700 dark:text-white/80 space-y-2">
                            <li>Karyawan yang melakukan presensi masuk <b>setelah</b> Jam Masuk akan ditandai sebagai <b>Terlambat</b>.</li>
                            <li>Karyawan yang melakukan presensi masuk <b>sebelum</b> Jam Masuk akan ditandai sebagai <b>Datang Awal</b>.</li>
                            <li>Karyawan yang melakukan presensi keluar <b>sebelum</b> Jam Pulang akan ditandai sebagai <b>Pulang Awal</b>.</li>
                            <li>Karyawan yang melakukan presensi keluar <b>setelah</b> Jam Pulang akan ditandai sebagai <b>Lembur / Lama</b>.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
