import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import obfuscatorPlugin from "vite-plugin-javascript-obfuscator";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/notes.js',
                'resources/js/redirects.js',
                'resources/js/parts/password.js',
            ],
            refresh: true,
        }),
        obfuscatorPlugin({
            include: [
                "resources/js/notes.js",
                "resources/js/redirects.js"
            ],
            apply: "build",
            options: { },
        }),
    ],
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
