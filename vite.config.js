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
                compact: true,
                controlFlowFlattening: true,
                controlFlowFlatteningThreshold: 0.75,
                deadCodeInjection: true,
                deadCodeInjectionThreshold: 0.4,
                debugProtection: false,
                debugProtectionInterval: 0,
                disableConsoleOutput: false,
                domainLock: [],
                domainLockRedirectUrl: 'about:blank',
                forceTransformStrings: [],
                identifierNamesCache: null,
                identifierNamesGenerator: 'hexadecimal',
                identifiersDictionary: [],
                ignoreImports: false,
                log: false,
                numbersToExpressions: false,
                optionsPreset: 'default',
                renameGlobals: false,
                renameProperties: true,
                renamePropertiesMode: 'safe',
                reservedNames: [],
                reservedStrings: [],
                seed: 25123,
                selfDefending: false,
                simplify: true,
                sourceMap: false,
                sourceMapBaseUrl: '',
                sourceMapFileName: '',
                sourceMapMode: 'separate',
                sourceMapSourcesMode: 'sources-content',
                splitStrings: true,
                splitStringsChunkLength: 10,
                stringArray: true,
                stringArrayCallsTransform: true,
                stringArrayCallsTransformThreshold: 0.5,
                stringArrayEncoding: [],
                stringArrayIndexesType: [
                    'hexadecimal-number'
                ],
                stringArrayIndexShift: true,
                stringArrayRotate: true,
                stringArrayShuffle: true,
                stringArrayWrappersCount: 1,
                stringArrayWrappersChainedCalls: true,
                stringArrayWrappersParametersMaxCount: 2,
                stringArrayWrappersType: 'variable',
                stringArrayThreshold: 0.75,
                target: 'browser',
                transformObjectKeys: false,
                unicodeEscapeSequence: true
            },
        }),
    ],
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
