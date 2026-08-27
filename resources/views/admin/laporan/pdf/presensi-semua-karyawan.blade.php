<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title . '.pdf' }}</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        .title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            font-weight: 800;
            line-height: 1.5rem;
        }

        table {
            border-collapse: collapse;
        }

        .identitas-karyawan {
            margin-top: 2rem;
        }

        .identitas-karyawan td {
            padding: 0.25rem;
        }

        .presensi-karyawan {
            width: 100%;
            margin-top: 1.5rem;
        }

        .presensi-karyawan tbody>tr>td {
            text-align: center;
            padding: 0.5rem;
        }

        .presensi-karyawan th {
            font-weight: bold;
            background: salmon;
            padding: 0.5rem;
            font-size: 14px;
        }

        .presensi-karyawan>tbody>tr>td {
            font-size: 12px;
        }

        .presensi-karyawan,
        .presensi-karyawan>thead>tr>th,
        .presensi-karyawan>tbody>tr>td {
            border: 1px solid black;
            padding: 0.5rem
        }

        .pengesahan-atasan {
            width: 100%;
            margin-top: 2rem;
        }

        .atasan td {
            text-align: center;
            vertical-align: bottom;
            height: 10rem;
        }

        .tempat td {
            text-align: right;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">
        <table style="width: 100%">
            <tr>
                <td style="width: 30px;">
                    <img src="{{ public_path('img/apple-icon.png') }}" alt="logo" width="90" height="90" style="border-radius: 12px; margin-right: 15px;" />
                </td>
                <td>
                    <span class="title" style="margin-left: 0.5rem; font-size: 16px;">
                        {{ strtoupper($title) }} <br>
                    </span>
                    <span class="title" style="margin-left: 0.5rem; font-size: 14px;">
                        PERIODE {{ strtoupper(\Carbon\Carbon::make($bulan)->locale('id')->isoFormat("MMMM")) }} TAHUN {{ \Carbon\Carbon::make($bulan)->format("Y") }} <br>
                    </span>
                    <span class="title" style="margin-left: 0.5rem; font-size: 16px; color: #15803d;">
                        PT. SINKONA INDONESIA LESTARI <br>
                    </span>
                    <span style="margin-left: 0.5rem; font-size: 12px; color: #666;">
                        <i>Jl. Raya Ciater, Kec. Serpong, Kota Tangerang Selatan, Banten</i>
                    </span>
                </td>
            </tr>
        </table>

        <table class="presensi-karyawan">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Karyawan / NIK</th>
                    <th>Jabatan / Departemen</th>
                    <th>Jumlah Kehadiran</th>
                    <th>Jumlah Terlambat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatPresensi as $value => $item)
                    <tr>
                        <td>
                            {{ $value + 1 . "." }}
                        </td>
                        <td>
                            {{ $item->nama_karyawan }} - {{ $item->nik }}
                        </td>
                        <td>
                            {{ $item->jabatan_karyawan }} - {{ $item->nama_departemen }}
                        </td>
                        <td>
                            {{ $item->total_kehadiran }}
                        </td>
                        <td>
                            {{ $item->total_terlambat }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="pengesahan-atasan">
            <tr class="tempat">
                <td colspan="2">
                    Subang, {{ \Carbon\Carbon::now()->locale('id')->isoFormat("D MMMM Y") }}
                </td>
            </tr>
            <tr class="atasan">
                <td>
                    <u>Wily Radisya</u> <br>
                    <i><b>HRD Manager</b></i>
                </td>
                <td>
                    <u>Jane Doe</u> <br>
                    <i><b>Direktur Utama</b></i>
                </td>
            </tr>
        </table>
    </section>

</body>

</html>
