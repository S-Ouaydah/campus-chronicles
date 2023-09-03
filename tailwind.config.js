const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/welcome.blade.php',
    ],

    theme: {

        extend: {
            screens: {
                'sm': '640px',
                // => @media (min-width: 640px) { ... }
          
                'md': '768px',
                'mdx': '937px',
        
          
                'lg': '1024px',
                
                // => @media (min-width: 1024px) { ... }
          
                'xl': '1280px',
                // => @media (min-width: 1280px) { ... }
          
                '2xl': '1536px',
                // => @media (min-width: 1536px) { ... }
                '3xl':'2000px',
              },
            colors: {
                'primary': {
                    'light': '#c0ee9b',
                    'base': '#71c719',
                    'dark': '#569614',
                },
                'secondary': '#e0e0e0',
                'card1': '#ffefe2',
                'card2': '#effcef',
                'card3': '#e6f5f9',
                'card4': '#f4f6fa',
            },
            spacing: {
                '1/2': '50%',
                '1/3': '33.333333%',
                '2/3': '66.666667%',
                '1/4': '25%',
                '2/4': '50%',
                '3/4': '75%',
                '1/5': '20%',
                '2/5': '40%',
                '3/5': '60%',
                '4/5': '80%',
                '1/6': '16.666667%',
                '2/6': '33.333333%',
                '3/6': '50%',
                '4/6': '66.666667%',
                '5/6': '83.333333%',
                '1/8': '12.5%',
                '1/12': '8.333333%',
                '2/12': '16.666667%',
                '3/12': '25%',
                '4/12': '33.333333%',
                '5/12': '41.666667%',
                '6/12': '50%',
                '7/12': '58.333333%',
                '8/12': '66.666667%',
                '9/12': '75%',
                '10/12': '83.333333%',
                '11/12': '91.666667%',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
