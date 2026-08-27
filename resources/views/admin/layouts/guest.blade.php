<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sinkona Indonesia Lestari — Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { font-family: 'Inter', sans-serif !important; box-sizing: border-box; }

            body {
                margin: 0;
                min-height: 100vh;
                display: flex;
                background: #f0fdf4;
            }

            /* ===== SPLIT LAYOUT ===== */
            .login-wrapper {
                display: flex;
                width: 100%;
                min-height: 100vh;
            }

            /* ===== LEFT PANEL — Brand ===== */
            .brand-panel {
                width: 45%;
                background: linear-gradient(160deg, #14532d 0%, #15803d 45%, #16a34a 75%, #15803d 100%);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 3rem 2.5rem;
                position: relative;
                overflow: hidden;
            }

            /* Dekorasi latar */
            .brand-panel::before {
                content: '';
                position: absolute;
                top: -80px; right: -80px;
                width: 320px; height: 320px;
                border-radius: 50%;
                background: rgba(250, 204, 21, 0.08);
                border: 2px solid rgba(250,204,21,0.12);
            }
            .brand-panel::after {
                content: '';
                position: absolute;
                bottom: -100px; left: -60px;
                width: 280px; height: 280px;
                border-radius: 50%;
                background: rgba(250, 204, 21, 0.06);
                border: 2px solid rgba(250,204,21,0.1);
            }

            .brand-logo {
                width: 140px;
                height: 140px;
                margin-bottom: 2rem;
                position: relative;
                z-index: 1;
                filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));
            }

            .brand-title {
                color: white;
                font-size: 1.875rem;
                font-weight: 800;
                text-align: center;
                line-height: 1.25;
                margin-bottom: 0.75rem;
                position: relative; z-index: 1;
            }
            .brand-subtitle {
                color: rgba(255,255,255,0.65);
                font-size: 0.9rem;
                text-align: center;
                line-height: 1.6;
                max-width: 280px;
                position: relative; z-index: 1;
            }

            /* Ornamen dots */
            .brand-dots {
                display: flex; gap: 0.5rem; margin-top: 2.5rem;
                position: relative; z-index: 1;
            }
            .brand-dots span {
                width: 8px; height: 8px; border-radius: 50%;
                background: rgba(255,255,255,0.3);
            }
            .brand-dots span:first-child {
                background: #facc15;
                width: 24px; border-radius: 4px;
            }

            /* ===== RIGHT PANEL — Form ===== */
            .form-panel {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
                background: #f0fdf4;
            }

            .form-card {
                width: 100%;
                max-width: 420px;
                background: white;
                border-radius: 1.5rem;
                border: 1px solid rgba(22, 163, 74, 0.15);
                box-shadow: 0 10px 40px rgba(22, 163, 74, 0.12);
                padding: 2.5rem;
            }

            .form-card-header {
                margin-bottom: 2rem;
            }
            .form-card-header h2 {
                font-size: 1.5rem;
                font-weight: 800;
                color: #15803d;
                margin: 0 0 0.35rem 0;
            }
            .form-card-header p {
                font-size: 0.875rem;
                color: #9ca3af;
                margin: 0;
            }

            /* ===== FORM ELEMENTS ===== */
            .sil-label {
                display: block;
                font-size: 0.8rem;
                font-weight: 600;
                color: #374151;
                margin-bottom: 0.4rem;
                letter-spacing: 0.02em;
            }

            .sil-input {
                width: 100%;
                padding: 0.7rem 1rem;
                border: 1.5px solid #d1fae5;
                border-radius: 0.625rem;
                background: #f0fdf4;
                color: #15803d;
                font-size: 0.9rem;
                font-weight: 500;
                transition: all 0.2s ease;
                outline: none;
            }
            .sil-input::placeholder { color: #9ca3af; font-weight: 400; }
            .sil-input:focus {
                border-color: #16a34a;
                background: white;
                box-shadow: 0 0 0 3px rgba(22,163,74,0.12);
            }

            .sil-input-group {
                position: relative;
            }
            .sil-input-icon {
                position: absolute;
                left: 0.875rem;
                top: 50%;
                transform: translateY(-50%);
                color: #86efac;
                font-size: 1rem;
                pointer-events: none;
            }
            .sil-input-group .sil-input {
                padding-left: 2.5rem;
            }

            /* ===== CHECKBOX ===== */
            .sil-checkbox {
                accent-color: #16a34a;
                width: 1rem; height: 1rem;
                cursor: pointer;
            }

            /* ===== BUTTONS ===== */
            .sil-btn-login {
                width: 100%;
                padding: 0.8rem;
                background: linear-gradient(135deg, #15803d 0%, #16a34a 100%);
                color: white;
                font-weight: 700;
                font-size: 0.95rem;
                border: none;
                border-radius: 0.75rem;
                cursor: pointer;
                transition: all 0.2s ease;
                box-shadow: 0 4px 15px rgba(22,163,74,0.35);
                letter-spacing: 0.025em;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
            }
            .sil-btn-login:hover {
                background: linear-gradient(135deg, #14532d 0%, #15803d 100%);
                box-shadow: 0 6px 20px rgba(22,163,74,0.45);
                transform: translateY(-1px);
            }
            .sil-btn-login:active { transform: translateY(0); }

            /* ===== FORGOT LINK ===== */
            .forgot-link {
                color: #16a34a;
                font-size: 0.8rem;
                font-weight: 500;
                text-decoration: none;
                transition: color 0.2s;
            }
            .forgot-link:hover { color: #14532d; text-decoration: underline; }

            /* ===== DIVIDER ===== */
            .sil-divider {
                border: none;
                border-top: 1px solid #d1fae5;
                margin: 1.5rem 0;
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 768px) {
                .brand-panel { display: none; }
                .form-panel { padding: 1.5rem; }
                .form-card { padding: 2rem 1.5rem; }
            }
            
            /* DARK MODE VARIANTS */
            html.dark body, html.dark .form-panel { background: #0f172a; }
            html.dark .form-card { background: #1e293b; border-color: rgba(255,255,255,0.05); box-shadow: 0 10px 40px rgba(0,0,0,0.3); }
            html.dark .brand-panel { background: linear-gradient(160deg, #022c22 0%, #064e3b 45%, #065f46 75%, #064e3b 100%); }
            html.dark .form-card-header h2 { color: #86efac; }
            html.dark .sil-label { color: #cbd5e1; }
            html.dark .sil-input { background: #0f172a; border-color: rgba(255,255,255,0.1); color: #f1f5f9; }
            html.dark .sil-input:focus { background: #1e293b; border-color: #16a34a; box-shadow: 0 0 0 3px rgba(22,163,74,0.3); }
            html.dark .sil-divider { border-top-color: rgba(255,255,255,0.05); }
            html.dark .forgot-link { color: #4ade80; }
            html.dark .forgot-link:hover { color: #22c55e; }
            
            /* Theme Toggle Button */
            .theme-toggle-btn {
                position: absolute;
                top: 1.5rem;
                right: 2rem;
                z-index: 100;
                background: rgba(255,255,255,0.2);
                border: 1px solid rgba(255,255,255,0.3);
                border-radius: 50%;
                width: 2.5rem;
                height: 2.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #374151;
                cursor: pointer;
                transition: all 0.2s ease;
                box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            }
            .theme-toggle-btn:hover {
                background: rgba(255,255,255,0.5);
                transform: scale(1.05);
            }
            html.dark .theme-toggle-btn {
                background: rgba(0,0,0,0.3);
                border-color: rgba(255,255,255,0.1);
                color: #f1f5f9;
            }
            html.dark .theme-toggle-btn:hover {
                background: rgba(0,0,0,0.5);
            }
        </style>
    </head>
    <body x-data="data()">
        <button @click="toggleTheme()" aria-label="Toggle Dark Mode" class="theme-toggle-btn">
            <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
            <svg x-show="dark" style="display: none;" :style="dark ? 'display: block;' : 'display: none;'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
        </button>
        <div class="login-wrapper">
            <!-- Left Brand Panel -->
            <div class="brand-panel">
                <img src="{{ asset('img/apple-icon.png') }}" alt="Logo" class="brand-logo">
                <div class="brand-title">Sinkona Indonesia<br>Lestari</div>
                <div class="brand-subtitle">Platform manajemen kehadiran karyawan PT. Sinkona Indonesia Lestari yang modern, efisien, dan terpercaya.</div>
                <div class="brand-dots">
                    <span></span><span></span><span></span><span></span>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="form-panel">
                <div class="form-card">
                    {{ $slot }}
                </div>
            </div>
        </div>
        <script src="{{ asset('js/init-alpine.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    </body>
</html>

