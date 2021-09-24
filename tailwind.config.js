module.exports = {
    mode: 'jit',
    purge: {
        content: [
            './resources/**/*.antlers.html',
            './resources/**/*.blade.php',
            './content/**/*.md'
        ]
    },
    important: true,
    theme: {
        extend: {
            fontFamily: {
                sans: 'Poppins, -apple-system, BlinkMacSystemFont',
            },
        },
    },
    corePlugins: {
        container: false,
    },
    plugins: [
        require("tailwind-bootstrap-grid")({
            containerMaxWidths: {
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                "2xl": "1280px",
            },
            gridGutterWidth: "2rem"
        }),
        require("@tailwindcss/typography"),
        require("@tailwindcss/forms"),

        // eslint-disable-next-line no-undef
        require("tailwindcss-debug-screens"),

        // Flex Gap plugin
        require("./flexgap"),
    ],
}
