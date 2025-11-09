module.exports = {
  content: ["./**/*.php", "./app/js/**/*.js"],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: "0rem",
        sm: "0rem",
        md: "0rem",
        lg: "0rem",
        xl: "0rem"
      }
    },
    extend: {
            height: {
        'screen-9': '9.5vh',
        'screen-80': '79vh',
        'screen-95px': '95px',
        'screen-928px': '928px',
      },
      minHeight: {
        'screen-9': '9.5vh',
        'screen-80': '80vh',
        'screen-95px': '95px',
        'screen-928px': '928px',
      },
      lineHeight: {
        tightest: '0.4', 
      },
      zIndex: {
        '60': '60',
        '70': '70',
      },
      maxWidth: { 
        page: "1728px" 
      },
      fontFamily: {
        metro: ['Metrophobic', 'system-ui', 'sans-serif'],
        mono: ['Ubuntu Mono', 'ui-monospace', 'monospace']
      },
      colors: {
        ink: '#000000',
        paper: '#ffffff',
        hypergreen: '#4DFF26',
        pinkbytes: '#ff00fa',
      }
    }
  },
  plugins: [require('@tailwindcss/typography')],
};