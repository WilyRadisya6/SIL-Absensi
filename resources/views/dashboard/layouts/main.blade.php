<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}" :class="{ 'dark': dark }" :data-theme="dark ? 'dark' : 'light'" x-data="data()" class="scroll-smooth">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title }}</title>

        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}" />
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

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

        @include("dashboard.layouts.link")
        @yield("css")
        @vite(["resources/css/app.css", "resources/js/app.js"])
        
        <style>
            /* Fix SweetAlert2 Button Tailwind Conflict */
            div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
                background-color: #16a34a !important; /* warna hijau SIL */
                color: #ffffff !important;
            }

            /* SIL THEME GLOBAL OVERRIDES */
            :root {
                --sil-green: #16a34a;
                --sil-green-dark: #15803d;
                --sil-green-deeper: #14532d;
                --sil-yellow: #facc15;
                --sil-yellow-dark: #eab308;
            }

            * { font-family: 'Inter', sans-serif !important; }

            /* Buttons */
            .btn-primary { background: var(--sil-green) !important; border-color: var(--sil-green-dark) !important; color: white !important; font-weight: 600; }
            .btn-primary:hover { background: var(--sil-green-dark) !important; }
            .btn-warning { background: var(--sil-yellow) !important; border-color: var(--sil-yellow-dark) !important; color: #14532d !important; font-weight: 700; }
            .btn-warning:hover { background: var(--sil-yellow-dark) !important; }
            .btn-error { background: #ef4444 !important; border-color: #dc2626 !important; color: white !important; font-weight: 600; }
            .btn-error:hover { background: #dc2626 !important; }

            /* Forms */
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

            /* Tables */
            .bg-slate-200 { background: transparent !important; box-shadow: none !important; border: none !important; border-radius: 0 !important; padding: 0 !important; }
            .table { background: white !important; border-radius: 1rem !important; overflow: hidden !important; box-shadow: 0 4px 24px rgba(22, 163, 74, 0.1) !important; border: 1px solid rgba(22, 163, 74, 0.12) !important; border-collapse: separate !important; border-spacing: 0 !important; width: 100% !important; }
            .dark .table { background: #1e293b !important; border: 1px solid rgba(255, 255, 255, 0.1) !important; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.2) !important; }
            .table thead tr th, .table thead th { background: linear-gradient(135deg, #15803d 0%, #16a34a 100%) !important; color: white !important; font-weight: 600 !important; font-size: 0.75rem !important; letter-spacing: 0.06em !important; text-transform: uppercase !important; padding: 0.9rem 1rem !important; border: none !important; white-space: nowrap; }
            .table tbody tr { background: white !important; border-bottom: 1px solid rgba(22, 163, 74, 0.06) !important; transition: background 0.15s ease, transform 0.1s ease; }
            .dark .table tbody tr { background: #1e293b !important; border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important; }
            .table tbody tr:last-child { border-bottom: none !important; }
            .table tbody tr:hover, .table tbody tr.hover:hover { background: rgba(22, 163, 74, 0.035) !important; }
            .dark .table tbody tr:hover, .dark .table tbody tr.hover:hover { background: rgba(255, 255, 255, 0.05) !important; }
            .table td, .table tbody td { color: #1f2937 !important; font-size: 0.875rem !important; padding: 0.8rem 1rem !important; vertical-align: middle !important; border: none !important; }
            .dark .table td, .dark .table tbody td { color: #cbd5e1 !important; }
            .table :is(td, th) { border-color: transparent !important; }
            .table-zebra tbody tr:nth-child(even) { background: rgba(22, 163, 74, 0.02) !important; }
            .dark .table-zebra tbody tr:nth-child(even) { background: rgba(255, 255, 255, 0.02) !important; }
        </style>
    </head>

    <body class="leading-default m-0 bg-gray-50 font-sans text-base font-normal text-slate-500 antialiased dark:bg-slate-900">
        <div class="min-h-75 absolute w-full bg-green-700 bg-y-50 top-0 min-h-75 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] dark:bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')]">
            <span class="absolute top-0 left-0 w-full h-full bg-green-700 opacity-70"></span>
        </div>

        @include("dashboard.layouts.sidebar")

        <main class="xl:ml-68 relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out">
            @include("dashboard.layouts.navbar")

            <div class="mx-auto w-full px-6 py-6">
                @yield("container")
                @include("dashboard.layouts.footer")
            </div>
        </main>

        @include("dashboard.layouts.script")
        @yield("js")
    </body>

</html>
