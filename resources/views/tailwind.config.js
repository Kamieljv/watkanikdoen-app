module.exports = {
	mode: "jit",
	content: [
		"./**/*.php",
		"./*.php",
		"./resources/views/assets/**/*.{scss,js,vue}",
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
		require("@tailwindcss/line-clamp"),
	],
	safelist: [
		"-mx-2",
		"-my-2.5",
		"-ml-1.5",
		"-mt-1",
		"animate-pulse",
		"animate-spin",
		"bg-[color:var(--wkid-blue)]",
		"hover:bg-[color:var(--wkid-blue-dark)]",
		"bg-[color:var(--wkid-blue-dark)]",
		"bg-black/50",
		"shrink-0",
		"z-[1001]",
	]
}
