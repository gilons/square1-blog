const defaultTheme =  require('tailwindcss/defaultTheme')
//console.warn(defaultTheme)
module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        sans: [
          'Lato',
          ...defaultTheme.fontFamily.sans
        ]
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
