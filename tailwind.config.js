/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./public/**/*.html",
  ],
  theme: {
    extend: {
      colors: {
        'lw-primary': '#33196b',
        'lw-secondary': '#645290',
        'lw-primary-light': '#7c3aed',
        'lw-primary-dark': '#1e1b4b',
        'lw-gradient-start': '#c53e8d',
        'lw-gradient-end': '#8b5cf6',
        'lw-white': '#ffffff',
        'lw-light-gray': '#f8f9fc',
        social: {
          facebook: '#4267B2',
          'facebook-hover': '#365899',
          google: '#db4437',
          'google-hover': '#c23321',
        }
      },
      fontFamily: {
        'lw': ['Lexend', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
      },
      fontSize: {
        'xs': '12px',
        'sm': '14px',
        'base': '16px',
        'lg': '18px',
        'xl': '20px',
        '2xl': '24px',
        '3xl': '30px',
        '4xl': '36px',
        '5xl': '48px',
      },
      spacing: {
        'xs': '4px',
        'sm': '8px', 
        'md': '16px',
        'lg': '24px',
        'xl': '32px',
        '2xl': '48px',
        '3xl': '64px',
        '15': '60px', // Custom height for form inputs
        '32': '128px', // Custom min-height for textareas
      },
      height: {
        '15': '60px', // Custom height for form inputs
        '32': '128px', // Custom height for textareas
      },
      borderRadius: {
        'sm': '8px',
        'md': '12px', 
        'lg': '16px',
        'xl': '20px',
        'full': '9999px',
      },
      backgroundImage: {
        'gradient-lw': 'linear-gradient(135deg, #c53e8d, #8b5cf6)',
        'gradient-lw-light': 'linear-gradient(135deg, rgba(197, 62, 141, 0.1), rgba(139, 92, 246, 0.1))',
      },
      boxShadow: {
        'lw': '0 20px 40px rgba(0, 0, 0, 0.1)',
        'lw-light': '0 8px 20px rgba(0, 0, 0, 0.05)',
        'lw-medium': '0 12px 28px rgba(0, 0, 0, 0.15)',
        'lw-heavy': '0 20px 40px rgba(0, 0, 0, 0.25)',
        'lw-gradient': '0 10px 25px rgba(197, 62, 141, 0.3)',
        'lw-facebook': '0 8px 20px rgba(66, 103, 178, 0.4)',
        'lw-google': '0 8px 20px rgba(219, 68, 55, 0.4)',
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-up': 'slideUp 0.3s ease-out',
        'bounce-gentle': 'bounceGentle 2s infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(10px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        bounceGentle: {
          '0%, 100%': { transform: 'translateY(-5%)' },
          '50%': { transform: 'translateY(0)' },
        },
      },
      backdropBlur: {
        'lw': '20px',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
