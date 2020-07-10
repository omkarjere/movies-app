module.exports = {
  purge: [],
  theme: {
      spinner: (theme) => ({
        default: {
          color: '#dae1e7', // color you want to make the spinner dae1e7
          size: '1em', // size of the spinner (used for both width and height)
          border: '2px', // border-width of the spinner (shouldn't be bigger than half the spinner's size)
          speed: '500ms', // the speed at which the spinner should rotate
        },
      }),
  },
  extend: {
      width: {
          '96' : '24rem',
      }
  },

  variants: {
    spinner: ['responsive'],
  },

  plugins: [
      require('tailwindcss-spinner')(),
  ],
}
