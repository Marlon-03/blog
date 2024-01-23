/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./resources/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      fontFamily: {
        'kadwa': ['Kadwa', 'sans-serif'],
        'istok-web': ['Istok Web', 'sans-serif']
      }
    },
  },
  plugins: [],
}

