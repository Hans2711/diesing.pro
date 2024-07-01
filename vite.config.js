import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import obfuscatorPlugin from "vite-plugin-javascript-obfuscator";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/notes.js'
            ],
            refresh: true,
        }),
        obfuscatorPlugin({
            include: ["resources/js/notes.js"],
            apply: "build",
            options: {
                // your javascript-obfuscator options
                debugProtection: true,
                // ...  [See more options](https://github.com/javascript-obfuscator/javascript-obfuscator)
            },
        }),
    ],
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
