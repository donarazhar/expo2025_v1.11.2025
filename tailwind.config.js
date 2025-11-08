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
        'azhar-blue': {
          DEFAULT: '#0053C5',
          50: '#E6F0FF',
          100: '#CCE0FF',
          200: '#99C2FF',
          300: '#66A3FF',
          400: '#3385FF',
          500: '#0053C5',
          600: '#0042A0',
          700: '#003278',
          800: '#002150',
          900: '#001128',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        heading: ['Poppins', 'Inter', 'sans-serif'],
      },
      boxShadow: {
        'azhar': '0 4px 20px rgba(0, 83, 197, 0.15)',
        'azhar-lg': '0 8px 30px rgba(0, 83, 197, 0.2)',
      },
      borderRadius: {
        'azhar': '12px',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}