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
                height: 400px !important; /* Provide a good portrait height on mobile */
            }
        }
    </style>
@endsection

@section("js")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Webcam.set({
            width: 640,
            height: 480,
            image_format: 'jpeg',
            jpeg_quality: 90,
            force_flash: false,
            flip_horiz: false,
        });
        Webcam.attach('#webcam-capture');

        let lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallBack);
        }

        function successCallback(position) {
            let latitude = position.coords.latitude;
            let longitude = position.coords.longitude;
            lokasi.value = latitude + ", " + longitude;
        }

        function errorCallBack(position) {
            //
        }

        let notifikasi_presensi_masuk = document.getElementById('notifikasi_presensi_masuk');
        let notifikasi_presensi_keluar = document.getElementById('notifikasi_presensi_keluar');
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

            $.ajax({
                type: "POST",
                url: "{{ route("karyawan.presensi.store") }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi.value,
                    jenis: $("input[name='presensi']").val(),
                },
                cache: false,
                success: function(res) {
                    if (res.status == 200) {
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
                        setTimeout("location.href='{{ route("karyawan.dashboard") }}'", 5000);

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
            <source src="{{ asset("audio/notifikasi_presensi_masuk.mp3") }}" type="audio/mpeg">
        </audio>
        <audio id="notifikasi_presensi_keluar">
            <source src="{{ asset("audio/notifikasi_presensi_keluar.mp3") }}" type="audio/mpeg">
        </audio>
        <audio id="notifikasi_presensi_gagal_radius">
            <source src="{{ asset("audio/notifikasi_presensi_gagal_radius.mp3") }}" type="audio/mpeg">
        </audio>
        <div class="-mx-3 flex flex-wrap">
            <div class="mb-6 w-full max-w-full px-3 sm:flex-none">
                <div class="dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-xl">
                    <div class="flex-auto p-4">
                        <input type="text" name="lokasi" id="lokasi" class="input input-primary" hidden>
                        <div id="webcam-capture" class="mx-auto"></div>
                        <div class="flex justify-center">
                            @if ($presensiKaryawan == null)
                                <input type="text" name="presensi" id="presensi" value="masuk" hidden>
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
                                <input type="text" name="presensi" id="presensi" value="keluar" hidden>
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
