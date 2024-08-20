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
            keyframes: {
                'bounce-vertical': {
                  '0%, 100%': { transform: 'translateY(-10%)' },
                  '50%': { transform: 'translateY(10%)' },
                },
              },
              animation: {
                'bounce-vertical': 'bounce-vertical 3s ease-in-out infinite',
              },
        },
    },

    plugins: [forms],
};
