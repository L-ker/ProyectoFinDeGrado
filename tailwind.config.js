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
                "25v":"20vh",
                "30v":"30vh",
                "35v":"35vh",
                "45v":"45vh",
                "65v":"65vh",
                "70v":"70vh",
                "75v":"75vh",
                "80v":"80vh",
                "15v":"15vh",
                "10v":"10vh",
            },
            width: {
                "20v":"20vh",
                "65v":"65vh",
                "70v":"70vh",
                "75v":"75vh",
                "80v":"80vh",
                "15v":"15vh",
                "10v":"10vh",
                "175v":"175vh",
                "200v":"200vh",
                "250v":"250vh",
            },
            colors: {
                "neutral1":"#edf2f4",
                "neutral2":"#8d99ae",
                "rojoClaro":"#ef233c",
                "rojoOscuro":"#d90429",
                "acentuar1":"#FE8361",
                "acentuar2":"#e85d04",
                "gris":"#2b2d42",
            },
        },
    },
    plugins: [
        require('tailwind-scrollbar-hide'),
        forms
      ],
};
