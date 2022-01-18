module.exports = {
    mode: "jit",
    content: [
    "./**/*.php",
    "./*.php",
    "./resources/views/themes/custom/assets/**/*.{scss,js,vue}",
    ],
    theme: {
        //
    },
    variants: {
        //
    },
    plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
    require("@tailwindcss/line-clamp")
    ]
}
