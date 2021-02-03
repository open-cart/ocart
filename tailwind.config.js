const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            tableLayout: ['hover', 'focus'],
            backgroundColor: ['checked'],
            borderColor: ['checked'],
            backgroundColor: ['focus'],
        },
    },
    corePlugins: {
        // ...
    },

    plugins: [require('@tailwindcss/forms')],
};
