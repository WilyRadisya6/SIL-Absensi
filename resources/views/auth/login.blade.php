<x-guest-layout>
    <!-- Header -->
    <div class="form-card-header">
        <h2>Selamat Datang</h2>
        <p>Masuk ke sistem presensi <strong style="color: #15803d;">PT. Sinkona Indonesia Lestari</strong></p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div style="background: #dcfce7; border: 1px solid #86efac; color: #15803d; padding: 0.75rem 1rem; border-radius: 0.625rem; font-size: 0.875rem; margin-bottom: 1.25rem;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- NIK -->
        <div style="margin-bottom: 1.25rem;">
            <label class="sil-label" for="login_id">NIK</label>
            <input
                id="login_id"
                type="text"
                name="login_id"
                value="{{ old('login_id') }}"
                class="sil-input"
                placeholder="Masukkan NIK Anda"
                required
                autofocus
                autocomplete="username"
            />
            @error('login_id')
                <div style="color: #dc2626; font-size: 0.78rem; margin-top: 0.35rem; font-weight: 500;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div style="margin-bottom: 1rem;">
            <label class="sil-label" for="password">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                class="sil-input"
                placeholder="Masukkan password"
                required
                autocomplete="current-password"
            />
            @error('password')
                <div style="color: #dc2626; font-size: 0.78rem; margin-top: 0.35rem; font-weight: 500;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Remember Me & Forgot -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
            <label style="display: inline-flex; align-items: center; gap: 0.45rem; cursor: pointer;">
                <input id="remember_me" type="checkbox" class="sil-checkbox" name="remember">
                <span style="font-size: 0.82rem; color: #6b7280; font-weight: 500;">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">
                    Lupa password?
                </a>
            @endif
        </div>

        <hr class="sil-divider">

        <!-- Login Button -->
        <button type="submit" class="sil-btn-login">
            Masuk
        </button>
    </form>
</x-guest-layout>
