@extends("dashboard.layouts.main")

@section("css")
    <style>
        #webcam-capture {
            margin: 0 auto 1.5rem auto !important;
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            max-width: 100%;
        }

        #webcam-capture video {
            width: 100% !important;
            height: auto !important;
            max-width: 640px;
            border-radius: 24px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            #webcam-capture video {
                height: 400px !important;
            }
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.03em;
        }
        .badge-tepat     { background: #d1fae5; color: #065f46; }
        .badge-terlambat { background: #fee2e2; color: #991b1b; }
        .badge-cepat     { background: #fef3c7; color: #92400e; }
        .badge-normal    { background: #e0f2fe; color: #0c4a6e; }

        .shift-info-card {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
            border: 1px solid #d1fae5;
            border-radius: 16px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.25rem;
        }
        .dark .shift-info-card {
            background: linear-gradient(135deg, #052e16 0%, #064e3b 100%);
            border-color: #166534;
        }

        .alasan-box {
            background: #fffbeb;
            border: 1px solid #fbbf24;
            border-radius: 12px;
            padding: 0.875rem 1rem;
            margin-bottom: 1rem;
        }
        .dark .alasan-box {
            background: #451a03;
            border-color: #d97706;
        }
    </style>
@endsection

@section("js")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // ===== 1. Ambil data dari sessionStorage (diisi oleh dashboard) =====
        const _presensiAlasan = sessionStorage.getItem('presensi_alasan') || '';
        const _presensiJenis  = sessionStorage.getItem('presensi_jenis')  || '{{ request()->query("jenis", "masuk") }}';
        const _presensiLokasi = sessionStorage.getItem('presensi_lokasi') || '';

        // ===== 2. Setup Webcam =====
        Webcam.set({
            width: 640,
            height: 480,
            image_format: 'jpeg',
            jpeg_quality: 90,
            force_flash: false,
            flip_horiz: true,
        });
        Webcam.attach('#webcam-capture');

        // ===== 3. Lokasi dari sessionStorage atau GPS =====
        let lokasi = document.getElementById('lokasi');
        if (_presensiLokasi) {
            lokasi.value = _presensiLokasi;
        } else if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                lokasi.value = position.coords.latitude + ", " + position.coords.longitude;
            }, function() {});
        }

        // ===== 4. Isi jenis presensi dari sessionStorage =====
        window.addEventListener('DOMContentLoaded', function() {
            const inputPresensi = document.getElementById('presensi');
            if (inputPresensi && _presensiJenis) {
                inputPresensi.value = _presensiJenis;
            }

            // Tampilkan alasan box jika ada
            const alasanBox  = document.getElementById('alasan-box');
            const alasanText = document.getElementById('alasan-text');
            const inputAlasan = document.getElementById('input-alasan');

            if (_presensiAlasan && alasanBox && alasanText) {
                alasanBox.classList.remove('hidden');
                alasanText.textContent = _presensiAlasan;
            }
            if (inputAlasan && _presensiAlasan) {
                inputAlasan.value = _presensiAlasan;
            }
        });

        // ===== 5. Jam live =====
        function updateClock() {
            const now = new Date();
            const hh = String(now.getHours()).padStart(2, '0');
            const mm = String(now.getMinutes()).padStart(2, '0');
            const ss = String(now.getSeconds()).padStart(2, '0');
            const el = document.getElementById('jam-sekarang');
            if (el) el.textContent = hh + ':' + mm + ':' + ss + ' WIB';
        }
        setInterval(updateClock, 1000);
        updateClock();

        // ===== 6. Handle tombol presensi =====
        let notifikasi_presensi_masuk        = document.getElementById('notifikasi_presensi_masuk');
        let notifikasi_presensi_keluar       = document.getElementById('notifikasi_presensi_keluar');
        let notifikasi_presensi_gagal_radius = document.getElementById('notifikasi_presensi_gagal_radius');

        $("#take-presensi").click(function() {
            let image = "";
            Webcam.snap(function(uri) {
                image = uri;
            });

            if (lokasi.value == "") {
                Swal.fire({
                    title: "Gagal",
                    text: "Lokasi belum ditemukan! Pastikan GPS aktif dan berikan izin akses lokasi pada browser Anda.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
                return;
            }

            const alasanValue = document.getElementById('input-alasan')
                ? document.getElementById('input-alasan').value
                : '';

            $.ajax({
                type: "POST",
                url: "{{ route('karyawan.presensi.store') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    image:  image,
                    lokasi: lokasi.value,
                    jenis:  $("#presensi").val(),
                    alasan: alasanValue,
                },
                cache: false,
                success: function(res) {
                    if (res.status == 200) {
                        // Bersihkan sessionStorage setelah berhasil
                        sessionStorage.removeItem('presensi_alasan');
                        sessionStorage.removeItem('presensi_jenis');
                        sessionStorage.removeItem('presensi_lokasi');

                        if (res.jenis_presensi == "masuk") {
                            notifikasi_presensi_masuk.play();
                        } else if (res.jenis_presensi == "keluar") {
                            notifikasi_presensi_keluar.play();
                        }
                        Swal.fire({
                            title: "Presensi",
                            text: res.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        setTimeout("location.href='{{ route('karyawan.dashboard') }}'", 5000);

                    } else if (res.status == 500) {
                        if (res.jenis_error == "radius") {
                            notifikasi_presensi_gagal_radius.play();
                        }
                        Swal.fire({
                            title: "Presensi",
                            text: res.message,
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan sistem atau server (Cek koneksi & lokasi).",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });
    </script>
@endsection

@section("container")
    <div>
        <audio id="notifikasi_presensi_masuk">
            <source src="{{ asset('audio/notifikasi_presensi_masuk.mp3') }}" type="audio/mpeg">
        </audio>
        <audio id="notifikasi_presensi_keluar">
            <source src="{{ asset('audio/notifikasi_presensi_keluar.mp3') }}" type="audio/mpeg">
        </audio>
        <audio id="notifikasi_presensi_gagal_radius">
            <source src="{{ asset('audio/notifikasi_presensi_gagal_radius.mp3') }}" type="audio/mpeg">
        </audio>

        <div class="-mx-3 flex flex-wrap">
            <div class="mb-6 w-full max-w-full px-3 sm:flex-none">
                <div class="dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-xl">
                    <div class="flex-auto p-4">

                        {{-- ===== Info Shift Card ===== --}}
                        <div class="shift-info-card dark:text-white mb-4">
                            <div class="flex flex-wrap items-center justify-between gap-3">

                                {{-- Jam Sekarang --}}
                                <div class="flex items-center gap-3">
                                    <div class="rounded-full h-10 w-10 bg-gradient-to-tl from-blue-500 to-violet-500 inline-flex items-center justify-center shadow-sm flex-shrink-0">
                                        <i class="ri-time-line text-lg text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase opacity-60 mb-0">Jam Sekarang</p>
                                        <h6 class="font-bold mb-0" id="jam-sekarang">--:--:-- WIB</h6>
                                    </div>
                                </div>

                                {{-- Info Shift --}}
                                <div class="flex items-center gap-3">
                                    <div class="rounded-full h-10 w-10 bg-gradient-to-tl from-emerald-500 to-teal-400 inline-flex items-center justify-center shadow-sm flex-shrink-0">
                                        <i class="ri-calendar-schedule-line text-lg text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase opacity-60 mb-0">Jam Shifting</p>
                                        <h6 class="font-bold mb-0">
                                            {{ \Carbon\Carbon::parse($jamKerja->jam_masuk)->format('H:i') }}
                                            &ndash;
                                            {{ \Carbon\Carbon::parse($jamKerja->jam_pulang)->format('H:i') }}
                                        </h6>
                                    </div>
                                </div>

                                {{-- Status Badge --}}
                                <div>
                                    @php
                                        $jamNow        = \Carbon\Carbon::now()->format('H:i:s');
                                        $jenisReq      = request()->query('jenis', 'masuk');
                                        $isTerlambat   = $jenisReq === 'masuk'  && $jamNow > $jamKerja->jam_masuk;
                                        $isPulangCepat = $jenisReq === 'keluar' && $jamNow < $jamKerja->jam_pulang;
                                    @endphp

                                    @if($jenisReq === 'masuk')
                                        @if($isTerlambat)
                                            <span class="status-badge badge-terlambat">
                                                <i class="ri-alarm-warning-line"></i> Terlambat
                                            </span>
                                        @else
                                            <span class="status-badge badge-tepat">
                                                <i class="ri-checkbox-circle-line"></i> Tepat Waktu
                                            </span>
                                        @endif
                                    @else
                                        @if($isPulangCepat)
                                            <span class="status-badge badge-cepat">
                                                <i class="ri-run-line"></i> Pulang Cepat
                                            </span>
                                        @else
                                            <span class="status-badge badge-normal">
                                                <i class="ri-checkbox-circle-line"></i> Sesuai Jam
                                            </span>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>

                        {{-- ===== Alasan Box ===== --}}
                        <div id="alasan-box" class="alasan-box hidden dark:text-white">
                            <div class="flex items-start gap-2">
                                <i class="ri-chat-quote-line text-amber-500 text-lg mt-0.5 flex-shrink-0"></i>
                                <div>
                                    <p class="text-xs font-semibold text-amber-700 dark:text-amber-400 mb-1 uppercase">
                                        @if(request()->query('jenis') === 'keluar')
                                            Alasan Pulang Cepat
                                        @else
                                            Alasan Keterlambatan
                                        @endif
                                    </p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-0" id="alasan-text"></p>
                                </div>
                            </div>
                        </div>

                        {{-- Hidden inputs --}}
                        <input type="text" name="lokasi"          id="lokasi"       class="input input-primary" hidden>
                        <input type="text" name="alasan_hidden"   id="input-alasan" hidden>

                        {{-- Webcam --}}
                        <div id="webcam-capture" class="mx-auto"></div>

                        {{-- Tombol Presensi --}}
                        <div class="flex justify-center">
                            @if ($presensiKaryawan == null)
                                <input type="text" name="presensi" id="presensi" value="{{ request()->query('jenis', 'masuk') }}" hidden>
                                <button id="take-presensi" class="btn btn-primary btn-wide text-white">
                                    <i class="ri-camera-line text-lg"></i>
                                    Check In
                                </button>
                            @elseif ($presensiKaryawan->jam_keluar != null)
                                <button id="take-presensi" class="btn btn-disabled btn-ghost btn-wide text-white dark:bg-slate-600/60 dark:text-white">
                                    <i class="ri-camera-line text-lg"></i>
                                    Presensi Selesai
                                </button>
                            @elseif ($presensiKaryawan != null)
                                <input type="text" name="presensi" id="presensi" value="{{ request()->query('jenis', 'keluar') }}" hidden>
                                <button id="take-presensi" class="btn btn-error btn-wide text-white">
                                    <i class="ri-camera-line text-lg"></i>
                                    Check Out
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
