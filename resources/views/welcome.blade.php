    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': dark }" :data-theme="dark ? 'dark' : 'light'" x-data="data()">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PT. Sinkona Indonesia Lestari</title>
        <meta name="description" content="Sistem presensi karyawan PT. Sinkona Indonesia Lestari yang modern, akurat, dan efisien.">
        <link rel="icon" href="{{ asset('img/apple-icon.png') }}" type="image/png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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

        <style>
            *,
            *::before,
            *::after {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            :root {
                --green-dark: #14532d;
                --green-main: #15803d;
                --green-mid: #16a34a;
                --green-light: #f0fdf4;
                --green-border: #d1fae5;
                --yellow-main: #facc15;
                --yellow-dark: #eab308;
                --slate-400: #94a3b8;
                --slate-500: #64748b;
                --slate-700: #334155;
                --slate-800: #1e293b;
            }

            /* DARK MODE VARIANTS */
            html.dark {
                --green-light: #0f172a;
                --slate-800: #f8fafc;
                --slate-700: #e2e8f0;
                --slate-500: #94a3b8;
                --green-border: #1e293b;
            }

            html.dark .hero-badge {
                background: rgba(22, 163, 74, 0.2);
                border-color: rgba(34, 197, 94, 0.4);
                color: #4ade80;
            }

            html.dark body {
                background: var(--green-light);
                color: var(--slate-700);
            }

            html.dark .navbar {
                background: linear-gradient(135deg, #064e3b, #065f46);
            }

            html.dark .hero-title {
                color: var(--slate-800);
            }

            html.dark .visual-card,
            html.dark .stats,
            html.dark .feat-card {
                background: #1e293b;
                border-color: rgba(255, 255, 255, 0.05);
            }

            html.dark .stat-box {
                background: #0f172a;
                border-color: rgba(255, 255, 255, 0.05);
            }

            html.dark .att-item {
                border-bottom-color: rgba(255, 255, 255, 0.05);
            }

            html.dark .vc-title,
            html.dark .att-name,
            html.dark .feat-title,
            html.dark .sec-title {
                color: #f8fafc;
            }

            html.dark .s-num {
                color: #86efac;
            }

            html.dark .cta {
                background: linear-gradient(160deg, #064e3b, #065f46);
            }

            html.dark .footer {
                background: #022c22;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: var(--green-light);
                color: var(--slate-700);
                min-height: 100vh;
                overflow-x: hidden;
                transition: background 0.3s, color 0.3s;
            }

            /* NAVBAR */
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 100;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 2.5rem;
                height: 64px;
                background: linear-gradient(135deg, #14532d, #15803d 60%, #16a34a);
                box-shadow: 0 2px 20px rgba(21, 128, 61, 0.25);
            }

            .navbar-brand {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                text-decoration: none;
            }

            .logo-badge {
                background: var(--yellow-main);
                color: var(--green-dark);
                font-size: 1rem;
                font-weight: 900;
                padding: 0.35rem 0.75rem;
                border-radius: 8px;
                letter-spacing: 0.05em;
                box-shadow: 0 2px 8px rgba(250, 204, 21, 0.4);
            }

            .brand-name {
                font-size: 1rem;
                font-weight: 700;
                color: white;
            }

            .brand-name span {
                color: var(--yellow-main);
                font-weight: 400;
            }

            .btn-nav {
                padding: 0.5rem 1.4rem;
                background: var(--yellow-main);
                color: var(--green-dark);
                border: none;
                border-radius: 8px;
                font-size: 0.875rem;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.2s;
                box-shadow: 0 2px 8px rgba(250, 204, 21, 0.4);
            }

            .btn-nav:hover {
                background: var(--yellow-dark);
                transform: translateY(-1px);
            }

            /* HERO */
            .hero {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 6rem 2rem 4rem;
                position: relative;
                overflow: hidden;
            }

            .hero::before {
                content: '';
                position: absolute;
                top: -100px;
                right: -80px;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(22, 163, 74, 0.08), transparent 70%);
                border-radius: 50%;
                pointer-events: none;
            }

            .hero::after {
                content: '';
                position: absolute;
                bottom: -80px;
                left: -80px;
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, rgba(250, 204, 21, 0.06), transparent 70%);
                border-radius: 50%;
                pointer-events: none;
            }

            .hero-grid {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                max-width: 820px;
                width: 100%;
                margin: 0 auto;
                position: relative;
                z-index: 1;
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: rgba(22, 163, 74, 0.08);
                border: 1px solid rgba(22, 163, 74, 0.2);
                color: var(--green-main);
                padding: 0.35rem 0.9rem;
                border-radius: 100px;
                font-size: 0.8rem;
                font-weight: 600;
                margin-bottom: 1.5rem;
            }

            .dot {
                width: 6px;
                height: 6px;
                background: var(--green-mid);
                border-radius: 50%;
                animation: blink 2s infinite;
            }

            @keyframes blink {

                0%,
                100% {
                    opacity: 1;
                    transform: scale(1)
                }

                50% {
                    opacity: 0.4;
                    transform: scale(1.4)
                }
            }

            .hero-title {
                font-size: 3.4rem;
                font-weight: 800;
                color: var(--slate-800);
                line-height: 1.15;
                letter-spacing: -1.5px;
                margin-bottom: 1.25rem;
            }

            .hero-title .hl {
                color: var(--green-main);
            }

            .hero-desc {
                font-size: 1.05rem;
                color: var(--slate-500);
                line-height: 1.75;
                margin-bottom: 2rem;
                max-width: 620px;
            }

            .btn-hero {
                display: inline-flex;
                align-items: center;
                padding: 0.9rem 2.4rem;
                background: linear-gradient(135deg, #15803d, #16a34a);
                color: white;
                border: none;
                border-radius: 12px;
                font-size: 0.95rem;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.25s;
                box-shadow: 0 4px 20px rgba(22, 163, 74, 0.35);
            }

            .btn-hero:hover {
                background: linear-gradient(135deg, #14532d, #15803d);
                transform: translateY(-2px);
                box-shadow: 0 8px 28px rgba(22, 163, 74, 0.45);
            }

            .hero-visual {
                display: flex;
                justify-content: center;
            }

            .visual-card {
                background: white;
                border-radius: 20px;
                padding: 1.5rem;
                box-shadow: 0 20px 60px rgba(22, 163, 74, 0.12), 0 4px 16px rgba(0, 0, 0, 0.05);
                width: 100%;
                max-width: 420px;
                border: 1px solid var(--green-border);
                animation: float 4s ease-in-out infinite;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0)
                }

                50% {
                    transform: translateY(-10px)
                }
            }

            .vc-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 1.25rem;
            }

            .vc-title {
                font-size: 0.875rem;
                font-weight: 700;
                color: var(--slate-700);
            }

            .vc-badge {
                font-size: 0.7rem;
                font-weight: 600;
                background: rgba(22, 163, 74, 0.1);
                color: var(--green-mid);
                padding: 0.25rem 0.65rem;
                border-radius: 100px;
                border: 1px solid rgba(22, 163, 74, 0.2);
            }

            .stat-row {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 0.75rem;
                margin-bottom: 1.25rem;
            }

            .stat-box {
                background: var(--green-light);
                border-radius: 12px;
                padding: 0.85rem;
                text-align: center;
                border: 1px solid var(--green-border);
            }

            .stat-val {
                font-size: 1.4rem;
                font-weight: 800;
                line-height: 1;
                margin-bottom: 0.25rem;
            }

            .stat-val.g {
                color: var(--green-mid);
            }

            .stat-val.r {
                color: #dc2626;
            }

            .stat-lbl {
                font-size: 0.68rem;
                color: var(--slate-500);
                font-weight: 500;
            }

            .att-item {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.6rem 0;
                border-bottom: 1px solid var(--green-border);
            }

            .att-item:last-child {
                border-bottom: none;
            }

            .av {
                width: 34px;
                height: 34px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.7rem;
                font-weight: 700;
                color: white;
                flex-shrink: 0;
            }

            .av.a {
                background: linear-gradient(135deg, #15803d, #16a34a)
            }

            .av.b {
                background: linear-gradient(135deg, #16a34a, #65a30d)
            }

            .av.c {
                background: linear-gradient(135deg, #eab308, #facc15);
                color: #14532d
            }

            .av.d {
                background: linear-gradient(135deg, #14532d, #15803d)
            }

            .att-info {
                flex: 1;
            }

            .att-name {
                font-size: 0.8rem;
                font-weight: 600;
                color: var(--slate-700);
                line-height: 1;
                margin-bottom: 2px;
            }

            .att-time {
                font-size: 0.7rem;
                color: var(--slate-400);
            }

            .att-status {
                font-size: 0.68rem;
                font-weight: 600;
                padding: 0.2rem 0.55rem;
                border-radius: 100px;
            }

            .s-hadir {
                background: rgba(22, 163, 74, 0.1);
                color: #15803d;
                border: 1px solid rgba(22, 163, 74, 0.2);
            }

            .s-izin {
                background: rgba(234, 179, 8, 0.1);
                color: #a16207;
                border: 1px solid rgba(234, 179, 8, 0.2);
            }

            /* STATS */
            .stats {
                padding: 4rem 2rem;
                background: white;
                border-top: 1px solid var(--green-border);
                border-bottom: 1px solid var(--green-border);
            }

            .stats-grid {
                max-width: 1100px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 2rem;
                text-align: center;
            }

            .s-num {
                font-size: 2.5rem;
                font-weight: 800;
                color: var(--green-main);
                line-height: 1;
                margin-bottom: 0.4rem;
            }

            .s-lbl {
                font-size: 0.875rem;
                color: var(--slate-500);
                font-weight: 500;
            }

            /* FEATURES */
            .features {
                padding: 5rem 2rem;
                background: var(--green-light);
            }

            .sec-head {
                text-align: center;
                margin-bottom: 3rem;
            }

            .sec-sub {
                font-size: 0.8rem;
                font-weight: 700;
                color: var(--green-mid);
                letter-spacing: 1.5px;
                text-transform: uppercase;
                margin-bottom: 0.75rem;
            }

            .sec-title {
                font-size: 2rem;
                font-weight: 800;
                color: var(--slate-800);
                letter-spacing: -0.8px;
                line-height: 1.2;
            }

            .feat-grid {
                max-width: 1100px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }

            .feat-card {
                background: white;
                border-radius: 16px;
                padding: 1.75rem;
                border: 1px solid var(--green-border);
                box-shadow: 0 2px 12px rgba(22, 163, 74, 0.06);
                transition: all 0.3s;
            }

            .feat-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 30px rgba(22, 163, 74, 0.12);
                border-color: rgba(22, 163, 74, 0.3);
            }

            .feat-icon {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1rem;
                background: rgba(22, 163, 74, 0.08);
                border: 1px solid rgba(22, 163, 74, 0.12);
            }

            .feat-title {
                font-size: 1rem;
                font-weight: 700;
                color: var(--slate-800);
                margin-bottom: 0.5rem;
            }

            .feat-desc {
                font-size: 0.875rem;
                color: var(--slate-500);
                line-height: 1.65;
            }

            /* CTA */
            .cta {
                padding: 5rem 2rem;
                background: linear-gradient(160deg, #14532d, #15803d 50%, #16a34a);
                position: relative;
                overflow: hidden;
            }

            .cta::before {
                content: '';
                position: absolute;
                top: -40%;
                right: -5%;
                width: 450px;
                height: 450px;
                background: radial-gradient(circle, rgba(250, 204, 21, 0.1), transparent 70%);
                border-radius: 50%;
            }

            .cta-inner {
                max-width: 680px;
                margin: 0 auto;
                text-align: center;
                position: relative;
                z-index: 1;
            }

            .cta-title {
                font-size: 2.2rem;
                font-weight: 800;
                color: white;
                letter-spacing: -0.8px;
                margin-bottom: 1rem;
                line-height: 1.2;
            }

            .cta-desc {
                font-size: 1rem;
                color: rgba(255, 255, 255, 0.65);
                line-height: 1.7;
                margin-bottom: 2.5rem;
            }

            .btn-cta {
                display: inline-flex;
                align-items: center;
                padding: 1rem 2.8rem;
                background: var(--yellow-main);
                color: var(--green-dark);
                border: none;
                border-radius: 12px;
                font-size: 1rem;
                font-weight: 800;
                text-decoration: none;
                transition: all 0.25s;
                box-shadow: 0 4px 20px rgba(250, 204, 21, 0.4);
            }

            .btn-cta:hover {
                background: white;
                color: var(--green-main);
                transform: translateY(-2px);
                box-shadow: 0 8px 32px rgba(250, 204, 21, 0.5);
            }

            /* FOOTER */
            .footer {
                background: var(--green-dark);
                border-top: 1px solid rgba(255, 255, 255, 0.06);
                padding: 1.75rem 2rem;
                text-align: center;
            }

            .footer p {
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.35);
            }

            @media (max-width: 900px) {
                .hero-title {
                    font-size: 2.4rem;
                }

                .hero-desc {
                    max-width: 100%;
                }

                .stats-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .feat-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 600px) {
                .navbar {
                    padding: 0 1rem;
                }

                .hero {
                    padding: 6rem 1.25rem 3rem;
                }

                .hero-title {
                    font-size: 2rem;
                }

                .stats-grid {
                    grid-template-columns: 1fr 1fr;
                    gap: 1.25rem;
                }

                .s-num {
                    font-size: 2rem;
                }

                .feat-grid {
                    grid-template-columns: 1fr;
                }

                .cta-title {
                    font-size: 1.7rem;
                }

                .btn-nav {
                    padding: 0.4rem 1rem;
                    font-size: 0.8rem;
                }

                .brand-name {
                    font-size: 0.85rem;
                }
            }

            @media (max-width: 400px) {
                .brand-name {
                    display: none;
                }

                .stats-grid {
                    grid-template-columns: 1fr;
                }

                .hero-title {
                    font-size: 1.75rem;
                }
            }
        </style>
    </head>

    <body>

        <nav class="navbar">
            <a href="/" class="navbar-brand">
                <div class="logo-badge" style="width: 48px; height: 48px; flex-shrink: 0; overflow: hidden; display: flex; align-items: center; justify-content: center; border-radius: 12px;"><img src="{{ asset('img/favicon.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; transform: scale(1.5);"></div>
                <div class="brand-name">SIL<span>Presensi</span></div>
            </a>
            <div style="display: flex; align-items: center; gap: 1.25rem;">
                <button @click="toggleTheme()" aria-label="Toggle Dark Mode" style="background: none; border: none; color: white; cursor: pointer; display: flex; align-items: center; opacity: 0.8; transition: 0.2s;">
                    <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    <svg x-show="dark" style="display: none;" :style="dark ? 'display: block;' : 'display: none;'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </button>
                @auth
                <a href="{{ url('/admin/dashboard') }}" class="btn-nav">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="btn-nav">Masuk</a>
                @endauth
            </div>
        </nav>

        <section class="hero">
            <div class="hero-grid">
                <div class="hero-badge"><span class="dot"></span> Sistem Presensi Digital PT. SIL</div>
                <h1 class="hero-title">Kelola Presensi Karyawan<br>dengan <span class="hl">Mudah dan Akurat</span></h1>
                <p class="hero-desc">Pantau kehadiran, izin, dan laporan karyawan secara real-time. Dirancang untuk HR dan manajemen PT. Sinkona Indonesia Lestari yang ingin efisiensi lebih tinggi.</p>
                <a href="{{ route('login') }}" class="btn-hero">Masuk ke Sistem</a>
            </div>
        </section>

        <section class="stats">
            <div class="stats-grid">
                <div>
                    <div class="s-num">500+</div>
                    <div class="s-lbl">Karyawan Terdaftar</div>
                </div>
                <div>
                    <div class="s-num">98%</div>
                    <div class="s-lbl">Akurasi Data</div>
                </div>
                <div>
                    <div class="s-num">12</div>
                    <div class="s-lbl">Departemen Aktif</div>
                </div>
                <div>
                    <div class="s-num">24/7</div>
                    <div class="s-lbl">Akses Real-time</div>
                </div>
            </div>
        </section>

        <section class="features">
            <div class="sec-head">
                <div class="sec-sub">Fitur Unggulan</div>
                <h2 class="sec-title">Semua yang Anda Butuhkan,<br>Ada di Sini</h2>
            </div>
            <div class="feat-grid">
                <div class="feat-card">
                    <div class="feat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg></div>
                    <div class="feat-title">Presensi Real-time</div>
                    <div class="feat-desc">Rekam kehadiran karyawan secara langsung dengan validasi lokasi kantor yang akurat.</div>
                </div>
                <div class="feat-card">
                    <div class="feat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg></div>
                    <div class="feat-title">Manajemen Karyawan</div>
                    <div class="feat-desc">Kelola data karyawan per departemen, jabatan, dan informasi kontak dengan mudah.</div>
                </div>
                <div class="feat-card">
                    <div class="feat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                        </svg></div>
                    <div class="feat-title">Laporan Otomatis</div>
                    <div class="feat-desc">Generate laporan kehadiran mingguan dan bulanan secara otomatis dalam format PDF.</div>
                </div>
                <div class="feat-card">
                    <div class="feat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg></div>
                    <div class="feat-title">Validasi Lokasi GPS</div>
                    <div class="feat-desc">Pastikan karyawan absen dari lokasi kantor yang telah ditentukan dengan radius GPS.</div>
                </div>
                <div class="feat-card">
                    <div class="feat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                        </svg></div>
                    <div class="feat-title">Pengajuan Izin</div>
                    <div class="feat-desc">Karyawan dapat mengajukan izin atau sakit langsung dari sistem dengan persetujuan admin.</div>
                </div>
                <div class="feat-card">
                    <div class="feat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2">
                            <rect x="1" y="3" width="15" height="13" />
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                            <circle cx="5.5" cy="18.5" r="2.5" />
                            <circle cx="18.5" cy="18.5" r="2.5" />
                        </svg></div>
                    <div class="feat-title">Monitoring Admin</div>
                    <div class="feat-desc">Dashboard admin yang komprehensif untuk memantau seluruh aktivitas presensi karyawan.</div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="cta-inner">
                <h2 class="cta-title">Siap untuk Memulai?</h2>
                <p class="cta-desc">Masuk menggunakan akun Anda. Sistem akan mengarahkan secara otomatis sesuai hak akses - Admin atau Karyawan.</p>
                <a href="{{ route('login') }}" class="btn-cta">Masuk ke Sistem</a>
            </div>
        </section>

        <footer class="footer">
            <p>&copy; {{ date('Y') }} PT. Sinkona Indonesia Lestari &mdash; Sistem Presensi Karyawan</p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    </body>

    </html>