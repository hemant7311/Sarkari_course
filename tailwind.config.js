/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    container: {
      center: true,
      padding: "1rem",
    },
    extend: {
      colors: {
        brand: {
          50: "#f3effe",
          100: "#e6ddfd",
          200: "#c9b8fb",
          300: "#a68af5",
          400: "#8a63f0",
          500: "#6b3bec", // primary purple (buttons, links, active states)
          600: "#5b2ce0", // hover / dark accent
          700: "#4a20c2",
          800: "#3a1a99",
          900: "#2d1573",
        },
        ink: {
          900: "#14121f", // headings
          700: "#3a3650",
          500: "#69647f",
          300: "#a8a3bd",
        },
        surface: {
          DEFAULT: "#ffffff",
          soft: "#f7f5fc",
          dark: "#100c22", // footer background
        },
        success: "#16a34a",
        warning: "#f59e0b",
      },
      fontFamily: {
        sans: ["Inter", "ui-sans-serif", "system-ui", "-apple-system", "sans-serif"],
      },
      borderRadius: {
        xl2: "1.25rem",
      },
      boxShadow: {
        card: "0 4px 24px -6px rgba(20, 18, 31, 0.08)",
        "card-hover": "0 12px 32px -8px rgba(20, 18, 31, 0.16)",
        pill: "0 8px 20px -4px rgba(107, 59, 236, 0.35)",
      },
      maxWidth: {
        "8xl": "1280px",
      },
    },
  },
  plugins: [],
};
