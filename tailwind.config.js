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
            colors: {
                'villa-charcoal': '#1a1714',
                'villa-espresso': '#2d2520',
                'villa-coffee': '#3d3530',
                'villa-ember': '#c45c26',
                'villa-flame': '#e8723a',
                'villa-gold': '#c9a962',
                'villa-cream': '#f5f0e8',
                'villa-smoke': '#8a8279',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Cormorant Garamond', 'serif'],
                body: ['Montserrat', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
