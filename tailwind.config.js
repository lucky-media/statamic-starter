module.exports = {
    content: [
        "./resources/**/*.antlers.html",
        "./resources/**/*.blade.php",
        "./content/**/*.md",
    ],
    theme: {
        container: {
            center: true,
            padding: "1rem",
        },
        extend: {
            fontFamily: {
                sans: "Poppins, -apple-system, BlinkMacSystemFont",
            },
        },
    },
    corePlugins: {
        container: false,
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("@tailwindcss/forms"),

        // eslint-disable-next-line no-undef
        require("tailwindcss-debug-screens"),
    ],
};
