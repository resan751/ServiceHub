import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        fontFamily:{
            jakarta: ["Plus Jakarta Sans", 'serif'],
        },

        extend: {
            colors: {
                'admin': 'rgba(255, 159, 64, 0.8)',
                'user': 'rgba(75, 192, 192, 0.8)',
                'black1':'#252321',
                'black2':'#0c0c0c',
                'black3':'#151922',
                'black4':'#323441',
                'gray1':'#1c1c1c',
                'gray2':' #2C374E',
                'white1': '#e0e0e0',
                'white2': '#d1d1d1',
                'white3': '#b1b1b1',
                'white4': '#f8fbf8',
                'white5': '#faf5ef',
                'white6': '#fdfcfa',
                'white7':'#f4f8ff',
            },
          }
      },
    plugins: [],
};
