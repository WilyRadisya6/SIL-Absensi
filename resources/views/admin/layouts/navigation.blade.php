<nav x-data="{ open: false }" class="sil-navbar">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center" title="PT. Sinkona Indonesia Lestari">
                        <img src="{{ asset('img/apple-icon.png') }}" class="h-8 w-auto mr-2" alt="Logo SIL">
                        <span class="font-bold text-white text-lg tracking-wider">SIL</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center gap-1">
                    <a href="{{ route('admin.dashboard') }}"
                       class="sil-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.karyawan') }}"
                       class="sil-nav-link {{ request()->routeIs('admin.karyawan') ? 'active' : '' }}">
                        Data Karyawan
                    </a>
                    <a href="{{ route('admin.departemen') }}"
                       class="sil-nav-link {{ request()->routeIs('admin.departemen') ? 'active' : '' }}">
                        Departemen
                    </a>
                    <a href="{{ route('admin.monitoring-presensi') }}"
                       class="sil-nav-link {{ request()->routeIs('admin.monitoring-presensi') ? 'active' : '' }}">
                        Monitoring
                    </a>
                    <a href="{{ route('admin.laporan.presensi') }}"
                       class="sil-nav-link {{ request()->routeIs('admin.laporan.presensi') ? 'active' : '' }}">
                        Laporan
                    </a>
                    <a href="{{ route('admin.lokasi-kantor') }}"
                       class="sil-nav-link {{ request()->routeIs('admin.lokasi-kantor') ? 'active' : '' }}">
                        Lokasi Kantor
                    </a>
                    <a href="{{ route('admin.jam-kerja') }}"
                       class="sil-nav-link {{ request()->routeIs('admin.jam-kerja') ? 'active' : '' }}">
                        Jam Kerja
                    </a>
                    <a href="{{ route('admin.administrasi-presensi') }}"
                       class="sil-nav-link {{ request()->routeIs('admin.administrasi-presensi') ? 'active' : '' }}">
                        Administrasi
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center gap-4">
                <!-- Theme Toggle Button -->
                <button @click="toggleTheme()" aria-label="Toggle Dark Mode" class="text-white hover:text-gray-200 transition-colors focus:outline-none" style="opacity: 0.85;">
                    <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                    <svg x-show="dark" style="display: none;" :style="dark ? 'display: block;' : 'display: none;'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                </button>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="sil-user-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="hamburger-btn">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden sil-mobile-nav">
        <div class="py-3 px-2 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.karyawan') }}" class="{{ request()->routeIs('admin.karyawan') ? 'active' : '' }}">Data Karyawan</a>
            <a href="{{ route('admin.departemen') }}" class="{{ request()->routeIs('admin.departemen') ? 'active' : '' }}">Data Departemen</a>
            <a href="{{ route('admin.monitoring-presensi') }}" class="{{ request()->routeIs('admin.monitoring-presensi') ? 'active' : '' }}">Monitoring Presensi</a>
            <a href="{{ route('admin.laporan.presensi') }}" class="{{ request()->routeIs('admin.laporan.presensi') ? 'active' : '' }}">Laporan Presensi</a>
            <a href="{{ route('admin.lokasi-kantor') }}" class="{{ request()->routeIs('admin.lokasi-kantor') ? 'active' : '' }}">Lokasi Kantor</a>
            <a href="{{ route('admin.jam-kerja') }}" class="{{ request()->routeIs('admin.jam-kerja') ? 'active' : '' }}">Jam Kerja</a>
            <a href="{{ route('admin.administrasi-presensi') }}" class="{{ request()->routeIs('admin.administrasi-presensi') ? 'active' : '' }}">Administrasi Presensi</a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-3 pb-3 border-t border-yellow-400/30 px-4">
            <div class="font-semibold text-white">{{ Auth::user()->name }}</div>
            <div class="text-sm text-green-200">{{ Auth::user()->email }}</div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                </form>
            </div>
        </div>
    </div>
</nav>

