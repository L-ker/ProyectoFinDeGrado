import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                mono: ['ui-monospace', 'SFMono-Regular'],
            },
            height: {
                "20v":"20vh",
                "65v":"65vh",
                "70v":"70vh",
                "75v":"75vh",
                "80v":"80vh",
                "15v":"15vh",
                "10v":"10vh",
            },
            colors: {
                "neutral1":"#edf2f4",
                "neutral2":"#8d99ae",
                "rojoClaro":"#ef233c",
                "rojoOscuro":"#d90429",
                "acentuar1":"#f48c06",
                "acentuar2":"#e85d04",
                "gris":"#2b2d42",
            },
        },
    },

    plugins: [forms],
};
