<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': dark }" :data-theme="dark ? 'dark' : 'light'" x-data="data()" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sinkona Indonesia Lestari — {{ config('app.name', 'Presensi') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <script>
            (function() {
                try {
                    var theme = localStorage.getItem('theme');
                    var dark = localStorage.getItem('dark');
                    var isDark = theme === 'dark' || dark === 'true' || (!theme && !dark && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    if (isDark) {
                        document.documentElement.classList.add('dark');
                        document.documentElement.setAttribute('data-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        document.documentElement.setAttribute('data-theme', 'light');
                    }
                } catch (e) {}
            })();
        </script>
        <script src="{{ asset('js/init-alpine.js') }}"></script>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --sil-green: #16a34a;
                --sil-green-dark: #15803d;
                --sil-green-deeper: #14532d;
                --sil-green-light: #22c55e;
                --sil-yellow: #facc15;
                --sil-yellow-dark: #eab308;
                --sil-yellow-light: #fef9c3;
                --sil-bg: #f0fdf4;
            }

            * { font-family: 'Inter', sans-serif !important; }

            body {
                background-color: var(--sil-bg);
                background-image:
                    radial-gradient(ellipse at 15% 40%, rgba(22, 163, 74, 0.07) 0%, transparent 55%),
                    radial-gradient(ellipse at 85% 10%, rgba(250, 204, 21, 0.07) 0%, transparent 55%);
                min-height: 100vh;
            }

            /* ===== NAVBAR ===== */
            .sil-navbar {
                background: linear-gradient(135deg, #14532d 0%, #15803d 40%, #16a34a 70%, #15803d 100%);
                border-bottom: 3px solid var(--sil-yellow);
                box-shadow: 0 4px 24px rgba(21, 128, 61, 0.4);
                position: sticky;
                top: 0;
                z-index: 50;
            }

            .sil-nav-link {
                color: rgba(255,255,255,0.82);
                font-weight: 500;
                font-size: 0.78rem;
                padding: 0.45rem 0.85rem;
                border-radius: 0.5rem;
                transition: all 0.2s ease;
                border: 1px solid transparent;
                white-space: nowrap;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
            }
            .sil-nav-link:hover {
                color: var(--sil-yellow);
                background: rgba(250,204,21,0.13);
                border-color: rgba(250,204,21,0.25);
            }
            .sil-nav-link.active {
                color: #15803d;
                background: var(--sil-yellow);
                border-color: var(--sil-yellow-dark);
                font-weight: 700;
                box-shadow: 0 2px 10px rgba(250,204,21,0.45);
            }

            /* ===== HEADER ===== */
            .sil-header {
                background: white;
                border-bottom: 2px solid rgba(250, 204, 21, 0.5);
                box-shadow: 0 2px 12px rgba(22, 163, 74, 0.1);
            }
            .sil-header h2 { color: var(--sil-green-dark); font-weight: 700; }

            /* ===== TABLE CARD ===== */
            .sil-table-wrapper {
                background: white;
                border-radius: 1.25rem;
                border: 1px solid rgba(22, 163, 74, 0.12);
                box-shadow: 0 6px 28px rgba(22, 163, 74, 0.09);
                overflow: hidden;
            }

            .sil-table-inner { width: 100%; border-collapse: collapse; }
            .sil-table-inner thead { background: linear-gradient(135deg, #15803d 0%, #16a34a 100%); }
            .sil-table-inner thead th {
                padding: 1rem 1.25rem;
                font-weight: 600;
                font-size: 0.75rem;
                letter-spacing: 0.07em;
                text-transform: uppercase;
                color: white;
                text-align: left;
            }
            .sil-table-inner tbody tr {
                border-bottom: 1px solid rgba(22, 163, 74, 0.07);
                transition: all 0.18s ease;
            }
            .sil-table-inner tbody tr:last-child { border-bottom: none; }
            .sil-table-inner tbody tr:hover { background: rgba(22, 163, 74, 0.04); }
            .sil-table-inner tbody td {
                padding: 0.875rem 1.25rem;
                font-size: 0.875rem;
                color: #374151;
                vertical-align: middle;
            }

            .row-badge {
                background: linear-gradient(135deg, #16a34a, #15803d);
                color: white;
                width: 1.875rem;
                height: 1.875rem;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 0.72rem;
                box-shadow: 0 2px 6px rgba(22,163,74,0.35);
            }

            /* ===== DAISYUI OVERRIDES ===== */
            .btn-primary { background: var(--sil-green) !important; border-color: var(--sil-green-dark) !important; color: white !important; font-weight: 600; }
            .btn-primary:hover { background: var(--sil-green-dark) !important; }
            .btn-warning { background: var(--sil-yellow) !important; border-color: var(--sil-yellow-dark) !important; color: #14532d !important; font-weight: 700; }
            .btn-warning:hover { background: var(--sil-yellow-dark) !important; }
            .btn-success { background: var(--sil-green) !important; border-color: var(--sil-green-dark) !important; color: white !important; }
            .btn-success:hover { background: var(--sil-green-dark) !important; }
            .btn-neutral { background: #374151 !important; border-color: #1f2937 !important; color: white !important; }
            .btn-error { background: #ef4444 !important; border-color: #dc2626 !important; color: white !important; }
            .btn-error:hover { background: #dc2626 !important; }
            .btn-info { background: #0ea5e9 !important; border-color: #0284c7 !important; color: white !important; font-weight: 600; }
            .btn-info:hover { background: #0284c7 !important; }

            /* ===== FORMS ===== */
            .input, .textarea, .select, .input-bordered, .textarea-bordered, .select-bordered {
                border: 1.5px solid #bbf7d0 !important;
                border-radius: 0.625rem !important;
                background: #f0fdf4 !important;
                transition: all 0.2s ease;
                color: #1f2937 !important;
            }
            .input:focus, .textarea:focus, .select:focus {
                border-color: var(--sil-green) !important;
                box-shadow: 0 0 0 3px rgba(22,163,74,0.15) !important;
                background: white !important;
                outline: none !important;
            }

            /* ===== MODAL ===== */
            .modal-box {
                border-radius: 1.25rem !important;
                border: 2px solid rgba(22,163,74,0.18) !important;
                box-shadow: 0 20px 60px rgba(22,163,74,0.18) !important;
            }
            .modal-box h3 { color: var(--sil-green-dark); font-weight: 700; }

            /* ===== RADIO ===== */
            input[type="radio"].checked\:bg-red-500:checked { background-color: var(--sil-yellow) !important; border-color: var(--sil-yellow-dark) !important; }
            input[type="radio"].checked\:bg-blue-500:checked { background-color: var(--sil-green) !important; border-color: var(--sil-green-dark) !important; }

            /* ===== USER DROPDOWN ===== */
            .sil-user-btn {
                display: inline-flex; align-items: center; gap: 0.4rem;
                color: rgba(255,255,255,0.92);
                background: rgba(255,255,255,0.12);
                border: 1px solid rgba(255,255,255,0.22);
                border-radius: 0.5rem;
                padding: 0.4rem 0.875rem;
                font-size: 0.875rem; font-weight: 500;
                cursor: pointer; transition: all 0.2s ease;
            }
            .sil-user-btn:hover { background: rgba(250,204,21,0.15); border-color: rgba(250,204,21,0.35); color: var(--sil-yellow); }

            /* ===== MOBILE NAV ===== */
            .sil-mobile-nav { background: linear-gradient(180deg, #15803d, #16a34a); border-top: 2px solid var(--sil-yellow); }
            .sil-mobile-nav a { color: rgba(255,255,255,0.85); display: block; padding: 0.65rem 1.25rem; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; margin: 0.15rem 0.5rem; transition: all 0.18s; text-decoration: none; }
            .sil-mobile-nav a:hover { background: rgba(250,204,21,0.2); color: var(--sil-yellow); }

            /* ===== LOGO BADGE ===== */
            .sil-logo-badge {
                background: var(--sil-yellow); color: #14532d; font-weight: 800; font-size: 1rem;
                padding: 0.3rem 0.9rem; border-radius: 0.5rem; letter-spacing: 0.06em;
                box-shadow: 0 2px 8px rgba(250,204,21,0.5); border: 2px solid rgba(255,255,255,0.3);
                transition: all 0.2s; text-decoration: none; display: inline-block;
            }
            .sil-logo-badge:hover { transform: scale(1.04); box-shadow: 0 4px 14px rgba(250,204,21,0.6); }

            /* ===== STAT CARDS ===== */
            .sil-stat-card {
                background: white; border-radius: 1rem;
                border: 1px solid rgba(22,163,74,0.12);
                box-shadow: 0 4px 20px rgba(22,163,74,0.08);
                padding: 1.25rem 1.5rem;
                display: flex; align-items: center; gap: 1rem;
                transition: all 0.2s ease;
                text-decoration: none;
                color: inherit;
                cursor: pointer;
            }
            .sil-stat-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 28px rgba(22,163,74,0.18);
                text-decoration: none;
                color: inherit;
            }
            .sil-stat-card .icon-wrap {
                background: linear-gradient(135deg, #fef9c3, #fef08a);
                color: var(--sil-green-dark); border-radius: 0.75rem;
                width: 3.5rem; height: 3.5rem;
                display: flex; align-items: center; justify-content: center;
                font-size: 1.75rem; flex-shrink: 0;
                transition: transform 0.2s ease;
            }
            .sil-stat-card:hover .icon-wrap {
                transform: scale(1.08);
            }
            .sil-stat-card .stat-value { font-size: 1.5rem; font-weight: 800; color: var(--sil-green-dark); }
            .sil-stat-card .stat-label { font-size: 0.8rem; color: #6b7280; font-weight: 500; margin-top: 0.1rem; }

            /* ===== SCROLLBAR ===== */
            ::-webkit-scrollbar { width: 6px; height: 6px; }
            ::-webkit-scrollbar-track { background: #f0fdf4; }
            ::-webkit-scrollbar-thumb { background: #86efac; border-radius: 3px; }
            ::-webkit-scrollbar-thumb:hover { background: #16a34a; }

            /* ===== STATUS ICONS ===== */
            .text-success { color: #16a34a !important; }
            .text-error { color: #ef4444 !important; }

            /* ===== GLOBAL DAISYUI TABLE REDESIGN ===== */

            /* Wrapper lama (bg-slate-200, px-10, dll) — buat transparan, hapus padding/kotak ganda */
            .bg-slate-200 {
                background: transparent !important;
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
                padding: 0 !important;
            }

            /* Tabel sendiri yang jadi "card" — satu kotak saja */
            .table {
                background: white !important;
                border-radius: 1rem !important;
                overflow: hidden !important;
                box-shadow: 0 4px 24px rgba(22, 163, 74, 0.1) !important;
                border: 1px solid rgba(22, 163, 74, 0.12) !important;
                border-collapse: separate !important;
                border-spacing: 0 !important;
                width: 100% !important;
            }

            /* Header tabel */
            .table thead tr th,
            .table thead th {
                background: linear-gradient(135deg, #15803d 0%, #16a34a 100%) !important;
                color: white !important;
                font-weight: 600 !important;
                font-size: 0.75rem !important;
                letter-spacing: 0.06em !important;
                text-transform: uppercase !important;
                padding: 0.9rem 1rem !important;
                border: none !important;
                white-space: nowrap;
            }

            /* Baris tabel */
            .table tbody tr {
                background: white !important;
                border-bottom: 1px solid rgba(22, 163, 74, 0.06) !important;
                transition: background 0.15s ease, transform 0.1s ease;
            }
            .table tbody tr:last-child {
                border-bottom: none !important;
            }
            .table tbody tr:hover,
            .table tbody tr.hover:hover {
                background: rgba(22, 163, 74, 0.035) !important;
            }

            /* Teks sel tabel */
            .table td,
            .table tbody td {
                color: #1f2937 !important;
                font-size: 0.875rem !important;
                padding: 0.8rem 1rem !important;
                vertical-align: middle !important;
                border: none !important;
            }

            /* Override warna spesifik DaisyUI yang bikin teks pucat */
            .table :is(td, th) {
                border-color: transparent !important;
            }
            .table-zebra tbody tr:nth-child(even) {
                background: rgba(22, 163, 74, 0.02) !important;
            }

            /* DARK MODE VARIANTS */
            html.dark body { background-color: #0f172a; background-image: none; color: #f1f5f9; }
            html.dark .sil-navbar { background: linear-gradient(135deg, #064e3b, #065f46); border-bottom-color: #1e293b; box-shadow: 0 4px 24px rgba(0,0,0,0.5); }
            html.dark .sil-header { background: #1e293b; color: #f8fafc; border-bottom: 1px solid rgba(255,255,255,0.05); }
            html.dark .sil-card, html.dark .sil-stat-card, html.dark .modal-box { background: #1e293b; border-color: rgba(255,255,255,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
            html.dark .sil-table-wrapper { background: #1e293b; border-color: rgba(255,255,255,0.08); box-shadow: 0 6px 28px rgba(0,0,0,0.3); }
            html.dark .sil-stat-card .stat-value { color: #f8fafc; }
            html.dark .sil-stat-card .stat-label { color: #94a3b8; }
            html.dark .sil-stat-card .icon-wrap { background: #064e3b; color: #86efac; }
            html.dark .sil-header h2 { color: #86efac; }
            html.dark .table { background: #1e293b !important; border-color: rgba(255,255,255,0.05) !important; }
            html.dark .table thead tr th, html.dark .table thead th { background: #0f172a !important; color: #cbd5e1 !important; border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
            html.dark .table tbody tr { background: #1e293b !important; border-bottom-color: rgba(255,255,255,0.02) !important; }
            html.dark .table tbody tr:hover { background: rgba(255,255,255,0.02) !important; }
            html.dark .table td, html.dark .table tbody td { color: #cbd5e1 !important; }
            html.dark .table-zebra tbody tr:nth-child(even) { background: rgba(255,255,255,0.01) !important; }
            html.dark .sil-table-inner tbody tr { border-bottom-color: rgba(255,255,255,0.05); }
            html.dark .sil-table-inner tbody td { color: #cbd5e1; }
            html.dark .sil-table-inner thead { background: #0f172a; border-bottom-color: rgba(255,255,255,0.1); }
            html.dark .input, html.dark .textarea, html.dark .select { background: #0f172a !important; border-color: rgba(255,255,255,0.1) !important; color: #f1f5f9 !important; }
            html.dark .input:focus, html.dark .textarea:focus, html.dark .select:focus { background: #1e293b !important; border-color: var(--sil-green) !important; box-shadow: 0 0 0 3px rgba(22,163,74,0.3) !important; }
            html.dark .sil-user-btn { background: rgba(0,0,0,0.2); border-color: rgba(255,255,255,0.1); }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('admin.layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="sil-header">
                    <div class="max-w-full mx-auto py-4 px-6 lg:px-10">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="pb-10">
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>
