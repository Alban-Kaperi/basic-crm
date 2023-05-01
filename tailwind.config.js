/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            height: {
                forCustomerDetails: 'calc(100vh - 4rem)',
            },
        },
    },
    plugins: [],
}

