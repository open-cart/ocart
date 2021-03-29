const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './themes/group/**/*.blade.php',
        './themes/group/**/*.js',
        './themes/group/**/*.vue',
    ],

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
        },
    },
    corePlugins: {
        // ...
    },

    plugins: [
        require('@tailwindcss/line-clamp'),
    ],
};
