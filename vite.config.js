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
                "resources/js/scroll-to-top.js",
                "resources/js/logo-animation.js",
            ],
            refresh: true,
        }),
        ViteMinifyPlugin({ minify: 'terser' }),
        obfuscator({
            apply: "build",
            options:
            {
                compact: true,
                controlFlowFlattening: false,
                deadCodeInjection: false,
                debugProtection: false,
                debugProtectionInterval: 0,
                disableConsoleOutput: true,
                identifierNamesGenerator: 'hexadecimal',
                log: false,
                numbersToExpressions: false,
                renameGlobals: false,
                selfDefending: true,
                simplify: true,
                splitStrings: false,
                stringArray: true,
                stringArrayCallsTransform: false,
                stringArrayEncoding: [],
                stringArrayIndexShift: true,
                stringArrayRotate: true,
                stringArrayShuffle: true,
                stringArrayWrappersCount: 1,
                stringArrayWrappersChainedCalls: true,
                stringArrayWrappersParametersMaxCount: 2,
                stringArrayWrappersType: 'variable',
                stringArrayThreshold: 0.75,
                unicodeEscapeSequence: false
            }
            ,
        }),
        viteCompression(),
    ],
    server: {
        hmr: {
            host: "localhost",
        },
    },
});
