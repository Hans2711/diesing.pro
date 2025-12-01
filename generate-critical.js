/**
 * Generate Critical CSS
 * 
 * This script extracts critical (above-the-fold) CSS from built assets
 * and writes it to public/critical.css for inline rendering in the <head>.
 * 
 * Usage:
 *   node generate-critical.js [url]
 * 
 * Example:
 *   node generate-critical.js http://127.0.0.1:8000/de
 * 
 * Requirements:
 *   - Laravel dev server must be running (php artisan serve)
 *   - Vite build must be complete (npm run build) BEFORE running this
 * 
 * The critical CSS improves First Contentful Paint (FCP) and Largest Contentful Paint (LCP)
 * by inlining essential styles, while the full stylesheet is loaded deferred.
 */

import { generate } from 'critical';
import { writeFileSync, readdirSync } from 'fs';
import { join } from 'path';

const url = process.argv[2] || 'http://127.0.0.1:8000/de';

// Find the built CSS file
const buildDir = 'public/build/assets';
let cssFile = null;

try {
    const files = readdirSync(buildDir);
    cssFile = files.find(f => f.startsWith('app-') && f.endsWith('.css'));
    
    if (!cssFile) {
        console.error('❌ No built CSS file found. Run "npm run build" first.');
        process.exit(1);
    }
    
    console.log(`📦 Using CSS file: ${cssFile}`);
} catch (err) {
    console.error('❌ Build directory not found. Run "npm run build" first.');
    process.exit(1);
}

generate({
    base: 'public/',
    src: url,
    css: [join(buildDir, cssFile)],
    target: {
        css: 'public/critical.css',
    },
    inline: false,
    extract: false,
    width: 1300,
    height: 900,
    dimensions: [
        {
            width: 375,
            height: 812,
        },
        {
            width: 768,
            height: 1024,
        },
        {
            width: 1300,
            height: 900,
        },
    ],
    penthouse: {
        timeout: 90000,
        renderWaitTime: 2000,
        blockJSRequests: false,
        puppeteer: {
            args: [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-dev-shm-usage',
                '--disable-accelerated-2d-canvas',
                '--disable-gpu',
            ],
        },
    },
})
.then((output) => {
    console.log('✓ Critical CSS generated successfully');
    if (output.css) {
        writeFileSync('public/critical.css', output.css);
        const size = Math.round(output.css.length / 1024);
        console.log(`✓ Written to public/critical.css (${size} KB)`);
    }
})
.catch((err) => {
    console.error('❌ Error generating critical CSS:', err.message);
    process.exit(1);
});
