module.exports = {
    theme: {

        container: {
            center: true,
            padding: '2rem',
        },
        extend: {
            colors: {
                background: '#f0f1f2',
            },
        }
    },
    variants: {},
    plugins: [
        require('@tailwindcss/custom-forms')
    ]
}
