import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import obfuscatorPlugin from "vite-plugin-javascript-obfuscator";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/contact.css",
                "resources/css/diff-table.css",
                "resources/js/app.js",
                "resources/js/notes.js",
                "resources/js/redirects.js",
                "resources/js/files.js",
                "resources/js/parts/password.js",
                "resources/js/parts/header.js",
                "resources/js/contact.js",
                "resources/js/fingerprinting.js",
                "resources/js/utils/iphone-paralax.js",
                "resources/js/utils/clipboard.js",
            ],
            refresh: true,
        }),
        obfuscatorPlugin({
            include: [
                "resources/js/notes.js",
                "resources/js/redirects.js",
                "resources/js/contact.js",
                "resources/js/parts/password.js",
            ],
            apply: "build",
            options: {},
        }),
    ],
    server: {
        hmr: {
            host: "localhost",
        },
    },
});
