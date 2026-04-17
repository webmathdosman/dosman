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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#eef4ff',
                    100: '#d9e6ff',
                    200: '#bcd3ff',
                    300: '#8fb3ff',
                    400: '#5f8fff',
                    500: '#3b70f2',
                    600: '#2959d6',
                    700: '#2348b4',
                    800: '#233f93',
                    900: '#213876',
                },
            },
        },
    },

    plugins: [forms],
};
