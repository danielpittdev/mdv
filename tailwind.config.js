/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue',
		'./storage/framework/views/*.php',
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
	],
	theme: {
		extend: {
			fontFamily: {
				sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
			},
		},
	},
	darkMode: 'class', // 👈 activa el uso de .dark en el HTML
	plugins: [require('daisyui')],
	daisyui: {
		themes: ['light', 'dark'], // Puedes añadir más: ['light', 'dark', 'cupcake', ...]
	},
};
