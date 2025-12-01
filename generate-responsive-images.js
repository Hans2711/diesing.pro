import sharp from 'sharp';
import { readdir, mkdir, stat } from 'fs/promises';
import { join, extname, basename } from 'path';
import { existsSync } from 'fs';

/**
 * Generate responsive images for production
 * Creates multiple sizes (400w, 800w, 1200w) for each image
 */

const SIZES = [400, 800, 1200]; // Mobile, Tablet, Desktop widths
const SMALL_SIZES = [100, 200, 300]; // For logos and small images

const INPUT_DIR = 'resources/images';
const OUTPUT_DIR = 'public/build/images/responsive';

// Images that should use small sizes (logos, etc.)
const SMALL_IMAGES = ['bkh', 'lessing', 'marien-schule'];

async function generateResponsiveImages() {
    console.log('🖼️  Generating responsive images...\n');
    
    // Create output directory if it doesn't exist
    if (!existsSync(OUTPUT_DIR)) {
        await mkdir(OUTPUT_DIR, { recursive: true });
    }
    
    // Read all images from input directory
    const files = await readdir(INPUT_DIR);
    const imageFiles = files.filter(file => 
        /\.(jpg|jpeg|png|webp)$/i.test(file)
    );
    
    let processedCount = 0;
    let totalSavings = 0;
    
    for (const file of imageFiles) {
        const inputPath = join(INPUT_DIR, file);
        const ext = extname(file);
        const name = basename(file, ext);
        
        // Determine which size set to use
        const isSmallImage = SMALL_IMAGES.some(small => name.includes(small));
        const sizes = isSmallImage ? SMALL_SIZES : SIZES;
        
        try {
            const image = sharp(inputPath);
            const metadata = await image.metadata();
            const fileStats = await stat(inputPath);
            const originalSize = fileStats.size;
            
            console.log(`📸 Processing: ${file} (${(originalSize / 1024).toFixed(2)} KB)`);
            
            // Generate each size
            for (const width of sizes) {
                // Skip if original is smaller than target width
                if (metadata.width && metadata.width < width) continue;
                
                const outputFilename = `${name}-${width}w.webp`;
                const outputPath = join(OUTPUT_DIR, outputFilename);
                
                const outputInfo = await image
                    .clone()
                    .resize(width, null, {
                        withoutEnlargement: true,
                        fit: 'inside'
                    })
                    .webp({ quality: 80 })
                    .toFile(outputPath);
                
                const newSize = outputInfo.size;
                const savings = originalSize - newSize;
                totalSavings += savings;
                
                console.log(`   ✓ ${outputFilename} - ${width}w (${(newSize / 1024).toFixed(2)} KB)`);
            }
            
            processedCount++;
            console.log('');
            
        } catch (error) {
            console.error(`   ✗ Error processing ${file}:`, error.message);
        }
    }
    
    console.log(`\n✨ Generated responsive images for ${processedCount} files`);
    console.log(`💰 Total space optimized: ${(totalSavings / 1024 / 1024).toFixed(2)} MB\n`);
}

generateResponsiveImages().catch(console.error);
