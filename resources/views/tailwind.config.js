module.exports = {
	mode: "jit",
	content: require('fast-glob').sync([
        './**/*.{blade.php,md,html,vue}'
	],{ dot: true }),
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
		"mt-20",
		"my-2",
		"animate-pulse",
		"animate-spin",
		"bg-[color:var(--wkid-blue)]",
		"hover:bg-[color:var(--wkid-blue-dark)]",
		"bg-[color:var(--wkid-blue-dark)]",
		"bg-[color:var(--wkid-yellow)]",
		"bg-black/50",
		"text-[color:var(--wkid-pink)]",
		"shrink-0",
		"z-[1001]",
		"translate-x-full",
		"translate-x-0",
		"overflow-auto",
		"justify-end",
		"divide-x",
		"divide-y",
		"col-span-3",
		"overflow-scroll"
	]
}
