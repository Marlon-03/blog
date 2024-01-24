/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./resources/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      maxWidth: {
        'custom': '1240px',
      },
      fontFamily: {
        'istok-web': ['Istok Web'],
        'kadwa': ['Kadwa'],

      }
    },
  },
  plugins: [],
}

