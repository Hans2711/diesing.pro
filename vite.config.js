import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { ViteMinifyPlugin } from "vite-plugin-minify";
import obfuscator from "vite-plugin-javascript-obfuscator";
import viteCompression from "vite-plugin-compression";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/diff-table.css",
                "resources/js/app.js",
                "resources/js/gradient-scroll.js",
                "resources/js/utils/clipboard.js",
                "resources/js/utils/zenquotes.js",
                "resources/js/utils/editor.js",
                "resources/js/swipe-sidebar.js",
            ],
            refresh: true,
        }),
        ViteMinifyPlugin({ minify: 'terser' }),
        obfuscator(),
        viteCompression(),
        viteCompression({ algorithm: 'brotliCompress', ext: '.br' }),
    ],
    server: {
        hmr: {
            host: "localhost",
        },
    },
});
