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
        // Loversnmore brand colors
        'lw-primary': '#4F1DA1', // Primary Purple
        'lw-secondary': '#E78AB0', // Accent Pink
        'lw-lavender': '#F4E9FF', // Lavender Background
        'lw-text-primary': '#2F1E4E', // Main text color
        'lw-gray-inactive': '#9B8AAE', // Muted gray for inactive/secondary
        'lw-white': '#ffffff',
        'lw-light-gray': '#f8f9fc',
        'lw-placeholder': '#C6B9D8', // Input placeholder color
        'lw-shadow': '#E7DFF2', // Card shadow color
        // Legacy support (to be phased out)
        'lw-primary-light': '#7c3aed',
        'lw-primary-dark': '#1e1b4b',
        'lw-gradient-start': '#4F1DA1',
        'lw-gradient-end': '#E78AB0',
        'brandPurple': '#4F1DA1',
        social: {
          facebook: '#4267B2',
          'facebook-hover': '#365899',
          google: '#db4437',
          'google-hover': '#c23321',
        }
      },
      fontFamily: {
        'lw': ['Poppins', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
        'poppins': ['Poppins', 'sans-serif'],
      },
      fontSize: {
        'xs': '12px',
        'sm': '14px', // Body MD - Poppins Regular 14pt
        'base': '16px', // Button SM - Poppins Medium 16pt
        'lg': '18px',
        'xl': '20px', // Subheader LG - Poppins SemiBold 20pt
        '2xl': '24px',
        '3xl': '28px', // Header XL - Poppins Bold 28pt
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
        // Loversnmore brand gradients
        'gradient-lw': 'linear-gradient(135deg, #4F1DA1, #E78AB0)', // Primary gradient
        'gradient-lw-vertical': 'linear-gradient(180deg, #4F1DA1, #E78AB0)', // Sidebar vertical gradient
        'gradient-lw-light': 'linear-gradient(135deg, rgba(79, 29, 161, 0.1), rgba(231, 138, 176, 0.1))',
        'gradient-hover': 'linear-gradient(135deg, #5B2BB5, #F4A5C4)', // Lighter gradient for hover
      },
      boxShadow: {
        // Loversnmore shadow system
        'lw': 'rgba(79, 29, 161, 0.08) 0px 4px 12px', // Standard component shadow
        'lw-light': '0 8px 20px rgba(0, 0, 0, 0.05)',
        'lw-medium': '0 12px 28px rgba(0, 0, 0, 0.15)',
        'lw-heavy': '0 20px 40px rgba(0, 0, 0, 0.25)',
        'lw-card': '0 4px 12px rgba(231, 223, 242, 1)', // Card shadow using #E7DFF2
        'lw-gradient': '0 10px 25px rgba(79, 29, 161, 0.3)',
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
