/**
 * Global Theme Management & Alpine Data
 * Sinkronisasi tema Dark/Light mode secara real-time & konsisten di seluruh halaman
 */

(function () {
    // Fungsi sinkronisasi class dan atribut tema pada elemen root (HTML)
    window.__applyTheme = function (isDark) {
        const root = document.documentElement;
        if (isDark) {
            root.classList.add('dark');
            root.setAttribute('data-theme', 'dark');
        } else {
            root.classList.remove('dark');
            root.setAttribute('data-theme', 'light');
        }
    };

    // Fungsi membaca preferensi tema dari localStorage atau prefers-color-scheme
    window.__getIsDark = function () {
        try {
            const storedTheme = window.localStorage.getItem('theme');
            const storedDark = window.localStorage.getItem('dark');
            if (storedTheme !== null) {
                return storedTheme === 'dark';
            }
            if (storedDark !== null) {
                return storedDark === 'true';
            }
            return (
                !!window.matchMedia &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            );
        } catch (e) {
            return false;
        }
    };

    // Terapkan tema segera saat script ini dimuat
    window.__applyTheme(window.__getIsDark());

    // Fungsi menyimpan tema ke localStorage dan trigger event
    window.__setTheme = function (isDark) {
        try {
            window.localStorage.setItem('theme', isDark ? 'dark' : 'light');
            window.localStorage.setItem('dark', isDark ? 'true' : 'false');
        } catch (e) {}

        window.__applyTheme(isDark);
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: { dark: isDark } }));
    };

    // Dengarkan perubahan localStorage dari tab lain (storage event)
    window.addEventListener('storage', function (e) {
        if (e.key === 'theme' || e.key === 'dark') {
            const isDark = window.__getIsDark();
            window.__applyTheme(isDark);
            window.dispatchEvent(new CustomEvent('theme-changed', { detail: { dark: isDark } }));
        }
    });
})();

function data() {
    return {
        dark: window.__getIsDark ? window.__getIsDark() : false,
        init() {
            // Pastikan state Alpine sinkron dengan tema aktif
            this.dark = window.__getIsDark();
            window.__applyTheme(this.dark);

            // Listener untuk update reaktif jika tema diubah dari komponen/tab lain
            window.addEventListener('theme-changed', (e) => {
                if (e.detail && typeof e.detail.dark !== 'undefined') {
                    this.dark = e.detail.dark;
                } else {
                    this.dark = window.__getIsDark();
                }
            });
        },
        toggleTheme() {
            this.dark = !this.dark;
            window.__setTheme(this.dark);
        },
    };
}

// Daftarkan ke Alpine jika Alpine sudah siap atau saat alpine:init
if (window.Alpine) {
    window.Alpine.data('data', data);
} else {
    document.addEventListener('alpine:init', () => {
        window.Alpine.data('data', data);
    });
}

