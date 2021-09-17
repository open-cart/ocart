const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode: 'media',
    purge: [
        './resources/**/*.blade.php',
        './system/**/*.blade.php',
        './plugins/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    //purge: false,

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
        },
        maxWidth: (theme, { breakpoints }) => ({
            none: 'none',
            0: '0rem',
            '8': '2rem',
            '10': '2.5rem',
            '12': '3rem',
            '14': '3.5rem',
            '16': '4rem',
            '20': '5rem',
            '24': '6rem',
            '28': '7rem',
            '32': '8rem',
            '36': '9rem',
            '40': '10rem',
            '44': '11rem',
            '48': '12rem',
            '52': '13rem',
            '56': '14rem',
            '60': '15rem',
            '64': '16rem',
            '68': '17rem',
            '72': '18rem',
            '76': '19rem',
            xs: '20rem',
            sm: '24rem',
            md: '28rem',
            lg: '32rem',
            xl: '36rem',
            '2xl': '42rem',
            '3xl': '48rem',
            '4xl': '56rem',
            '5xl': '64rem',
            '6xl': '72rem',
            '7xl': '80rem',
            full: '100%',
            min: 'min-content',
            max: 'max-content',
            prose: '65ch',
            ...breakpoints(theme('screens')),
        }),
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
        // require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
