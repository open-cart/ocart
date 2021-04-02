const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './system/**/*.blade.php',
        './plugins/**/*.blade.php',
        './themes/tanaco/**/*.blade.php',
        './themes/tanaco/**/*.js',
        './themes/tanaco/**/*.vue',
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
