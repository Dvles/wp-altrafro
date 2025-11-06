module.exports = {
  content: ["./**/*.php", "./app/js/**/*.js"],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: "1rem",
        md: "1.5rem",
        lg: "2rem"
      }
    },
    extend: {
      // Set your max working width so grid stays centered on super-wide screens
      screens: {
        '2xl': '1728px'      // feel free to bump to 1728/1800 if you prefer
      },
      maxWidth: {
        'page': '1728px'     // used by wrapper
      },
      fontFamily: {
        metro: ['Metrophobic', 'system-ui', 'sans-serif'],
        mono: ['Ubuntu Mono', 'ui-monospace', 'SFMono-Regular', 'monospace']
      },
      colors: {
        ink: '#000000',
        paper: '#ffffff',
        hypergreen: '#4DFF26',
        pinkbytes: '#ff00fa',
      }
    }
  },
  plugins: [require('@tailwindcss/typography')]
};
