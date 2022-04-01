const { colors } = require("laravel-mix/src/Log");  

module.exports = {
  mode: 'jit',
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      // fontFamily: {
      //   sans: ['Arial', 'Helvetica', 'sans-serif'],
      // },
      // colors: {
      //   red: colors.red,
      // }
    },
  },
  plugins: [],
}
