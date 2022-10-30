module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/views/**/**/*.blade.php',
    './resources/views/**/**/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/*',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
