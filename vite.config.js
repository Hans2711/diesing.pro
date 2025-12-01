import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { ViteMinifyPlugin } from "vite-plugin-minify";
import obfuscator from "vite-plugin-javascript-obfuscator";
import viteCompression from "vite-plugin-compression";
import { ViteImageOptimizer } from "vite-plugin-image-optimizer";
import { imagetools } from "vite-imagetools";

export default defineConfig({
    plugins: [
        imagetools(),
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/diff-table.css",
                "resources/js/app.js",
                "resources/js/gradient-scroll.js",
                "resources/js/utils/clipboard.js",
                "resources/js/utils/random-teams-storage.js",
                "resources/js/utils/zenquotes.js",
                "resources/js/utils/editor.js",
                "resources/js/swipe-sidebar.js",
                "resources/js/scroll-to-top.js",
                "resources/js/logo-animation.js",
            ],
            refresh: true,
        }),
        ViteMinifyPlugin({ minify: 'terser' }),
        viteCompression({
            algorithm: 'gzip',
            ext: '.gz',
            threshold: 10240,
            deleteOriginFile: false
        }),
        ViteImageOptimizer({
            // Only run in production builds
            test: /\.(jpe?g|png|gif|tiff|webp|svg|avif)$/i,
            exclude: undefined,
            include: undefined,
            includePublic: true,
            logStats: true,
            ansiColors: true,
            svg: {
                multipass: true,
                plugins: [
                    {
                        name: 'preset-default',
                        params: {
                            overrides: {
                                cleanupNumericValues: false,
                                removeViewBox: false,
                            },
                        },
                    },
                    'sortAttrs',
                    {
                        name: 'addAttributesToSVGElement',
                        params: {
                            attributes: [{ xmlns: 'http://www.w3.org/2000/svg' }],
                        },
                    },
                ],
            },
            png: {
                quality: 80,
            },
            jpeg: {
                quality: 80,
            },
            jpg: {
                quality: 80,
            },
            tiff: {
                quality: 80,
            },
            gif: {},
            webp: {
                lossless: false,
                quality: 80,
            },
            avif: {
                lossless: false,
                quality: 80,
            },
        }),
    ],
    server: {
        hmr: {
            host: "localhost",
        },
    },
});
