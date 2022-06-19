const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './system/**/*.blade.php',
        './plugins/**/*.blade.php',
        './themes/vanchuyen/**/*.blade.php',
        './themes/vanchuyen/**/*.js',
        './themes/vanchuyen/**/*.vue',
    ],
    // purge: false,

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        screens: {
            'error': '0px',
            'selected': '0px',
            'xs': '475px',
            ...defaultTheme.screens,
        }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            tableLayout: ['hover', 'focus'],
            backgroundColor: ['checked', 'focus'],
            borderColor: ['checked'],
            display: ['group-hover'],
        },
    },
    corePlugins: {
        // ...
    },

    plugins: [
        require('@tailwindcss/line-clamp'),
    ],
};
