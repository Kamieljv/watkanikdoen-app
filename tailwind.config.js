module.exports = {
	mode: "jit",
	darkMode: "class",
	content: [
        "./resources/**/*.{blade.php,md,html,vue}",
		"./resources/views/assets/presets/**/*.{js,vue,ts}",
		"./app/Filament/**/*.php",
		"./vendor/filament/**/*.blade.php",
		"./vendor/mwguerra/filemanager/**/*.blade.php",
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
	],
	safelist: [
		"-mx-2",
		"-my-2.5",
		"-ml-1.5",
		"-mt-1",
		"mt-20",
		"my-2",
		"m-3",
		"animate-pulse",
		"animate-spin",
		"bg-[color:var(--wkid-blue)]",
		"bg-[color:var(--wkid-pink)]",
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
		"space-x-2",
		"col-span-3",
		"overflow-scroll"
	],
}
