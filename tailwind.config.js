import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'landing-page': "url('/images/background-hd.jpeg')",
                'logo-image': "url('/images/indobeach-logo.png')",
            },
        },
    },
    plugins: [
        require('daisyui'),
        require('@tailwindcss/aspect-ratio'),
    ],
    daisyui: {
        themes: ["light", "dark"],
    },
};
