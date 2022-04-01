module.exports = {
  content: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './resources/views/app.blade.php'
  ],
  theme: {
    extend: {
      colors: {
        'sharp-blue': '#0070F5',
        'wordle-green': '#6AAA64',
        'nerdle-purple': '#820458'
      },
      maxWidth: {
        '720': '720px',
      }
    }
  },
  plugins: []
}
