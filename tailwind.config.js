/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        yellow: '#ecb222',
        maroon: '#640216',
        accent: '#e6e6e6',
        lightpink:'#E2A3A3',
        zinc: '#D9D9D9',
        customRed: '#89201a',
        customYellow: '#FFFF00',
        dark: '#5c211d',
      },
      screens: {
        'mobileS': '320px',
        'mobileM': '375px',
        'mobileL': '425px',
        'tablet': '768px',
        'laptop': '1024px',
        'desktop' : '1440px',
        lg: "1124px",
          xl: "1124px",
          "2xl": "1124px",
      },
      boxShadow: {
        'lg': '9px 10px 26px 3px rgba(0,0,0,0.4)',
        'menu': '8px 0px 0px 0px rgba(0, 0, 0, 0.25) inset',
      },
      container: {
        center:true,
        padding: "1rem",
      },
    },
  },
  plugins: [],
}

