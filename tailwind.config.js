import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primaryGreen: "#283A2C",
                secondaryGreen: "#DADDC5",
                softWhite: "#F1EFEC",
                white: "#FFFFFF",
                oliveGreen: "#808000",
            },
        },
    },

    plugins: [forms],
};
