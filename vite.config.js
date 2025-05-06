import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { ViteMinifyPlugin } from "vite-plugin-minify";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/diff-table.css",
                "resources/js/app.js",
                "resources/js/utils/clipboard.js",
                "resources/js/utils/editor.js",
                "resources/js/utils/zenquotes.js",
            ],
            refresh: true,
        }),
        ViteMinifyPlugin({ minify: 'terser' }),
    ],
    server: {
        hmr: {
            host: "localhost",
        },
    },
});
