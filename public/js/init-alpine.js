function data() {
    function getThemeFromLocalStorage() {
        // if user already changed the theme, use it
        if (window.localStorage.getItem('dark')) {
            return JSON.parse(window.localStorage.getItem('dark'))
        }

        // else return their preferences
        return (
            !!window.matchMedia &&
            window.matchMedia('(prefers-color-scheme: dark)').matches
        )
    }

    function setThemeToLocalStorage(value) {
        window.localStorage.setItem('dark', value)

        const html = document.querySelector('html');
        if (JSON.parse(window.localStorage.getItem('dark')) == true) {
            html.classList.add('dark');
            html.setAttribute('data-theme', 'dark'); // Sinkronisasi dengan DaisyUI
            window.localStorage.setItem('theme', 'dark');
        } else {
            html.classList.remove('dark');
            html.setAttribute('data-theme', 'light'); // Sinkronisasi dengan DaisyUI
            window.localStorage.setItem('theme', 'light');
        }
    }

    return {
        dark: getThemeFromLocalStorage(),
        toggleTheme() {
            this.dark = !this.dark
            setThemeToLocalStorage(this.dark)
        },
    }
}
