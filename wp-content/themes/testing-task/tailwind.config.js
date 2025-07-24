/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php", "./src/**/*.{js,jsx,ts,tsx,vue}"],
  theme: {
    extend: {
      container: {
        center: true,
        padding: "1rem",
        screens: {
          sm: "736px",
          md: "1024px",
          lg: "1408px",
          xl: "1552px",
        },
      },
      screens: {
        sm: "640px",
        md: "768px",
        lg: "1024px",
        xl: "1280px",
        "2xl": "1536px",
      },
    },
  },
  plugins: [],
};
