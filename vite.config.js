import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { ViteMinifyPlugin } from "vite-plugin-minify";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/contact.css",
                "resources/css/diff-table.css",
                "resources/js/app.js",
                "resources/js/parts/header.js",
                "resources/js/contact.js",
                "resources/js/utils/clipboard.js",
            ],
            refresh: true,
        }),
        ViteMinifyPlugin({}),
    ],
    server: {
        hmr: {
            host: "localhost",
        },
    },
});
