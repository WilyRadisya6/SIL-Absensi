import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: "class",

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        require("daisyui"),
    ],
    
    daisyui: {
        themes: [
            "light",
            {
                dark: {
                    ...require("daisyui/src/theming/themes")["dark"],
                    "base-100": "#051139", // Matches Argon's dark:bg-slate-900
                    "base-200": "#111c44", // Matches Argon's dark:bg-slate-850
                    "base-300": "#1a2352", // Slightly lighter for contrast
                },
            },
        ],
    },
};
