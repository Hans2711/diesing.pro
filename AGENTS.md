# AGENTS.md

This file documents useful commands and scripts for development, testing, and maintenance of the diesing.pro project.

## Development Commands

- **Start Laravel development server**:
  ```bash
  php artisan serve
  ```

- **Watch and build frontend assets**:
  ```bash
  npm run dev
  ```

- **Build production assets**:
  ```bash
  npm run build
  ```
  This automatically generates responsive images and builds Vite assets.

- **Build production assets**:
  ```bash
  npm run build
  ```
  This automatically generates responsive images and builds Vite assets.

- **Generate responsive images only**:
  ```bash
  npm run responsive
  ```
  Creates multiple sizes (400w, 800w, 1200w) of all images in WebP format.

- **Generate critical CSS (development)**:
  ```bash
  npm run criticalcss:dev
  ```
  Requires Laravel dev server (`php artisan serve`) to be running on port 8000.
  Uses `http://127.0.0.1:8000/de` for CSS extraction.

- **Generate critical CSS (production)**:
  ```bash
  npm run criticalcss:prod
  ```
  Uses `https://diesing.pro/de` for CSS extraction.
  Requires the production site to be accessible.

## Testing & Quality

- **Run PHPUnit tests**:
  ```bash
  php artisan test
  ```

- **Lint PHP code with Pint**:
  ```bash
  ./vendor/bin/pint
  ```

- **Check code style**:
  ```bash
  ./vendor/bin/pint --test
  ```

## Database & Migrations

- **Run migrations**:
  ```bash
  php artisan migrate
  ```

- **Rollback migrations**:
  ```bash
  php artisan migrate:rollback
  ```

- **Seed database**:
  ```bash
  php artisan db:seed
  ```

## Queue & Jobs

- **Run queue worker**:
  ```bash
  php artisan queue:work
  ```

- **Run specific queue**:
  ```bash
  php artisan queue:work --queue=default
  ```

## Cache & Optimization

- **Clear application cache**:
  ```bash
  php artisan cache:clear
  ```

- **Clear config cache**:
  ```bash
  php artisan config:clear
  ```

- **Clear route cache**:
  ```bash
  php artisan route:clear
  ```

- **Clear view cache**:
  ```bash
  php artisan view:clear
  ```

- **Optimize for production**:
  ```bash
  php artisan optimize
  ```

## Other Utilities

- **Generate application key**:
  ```bash
  php artisan key:generate
  ```

- **Publish vendor assets**:
  ```bash
  php artisan vendor:publish
  ```

- **Generate IDE helper**:
  ```bash
  php artisan ide-helper:generate
  ```

- **Check Redis connection**:
  ```bash
  ./check_redis.sh
  ```

## Performance Optimization

### Critical CSS
The project uses critical CSS for optimal page load performance:
- **Location**: `public/critical.css` (generated, not versioned)
- **Inlined**: Automatically included in `<head>` via `resources/views/global/head/critical-css.blade.php`
- **Full CSS**: Loaded deferred (non-blocking) via print media swap in `resources/views/layouts/app.blade.php`
- **Generation**: Run separately via `npm run criticalcss:dev` or `npm run criticalcss:prod`
- **Viewport coverage**: Mobile (375x812), tablet (768x1024), desktop (1300x900)
- **Workflow**:
  1. Build assets: `npm run build`
  2. Generate critical CSS: `npm run criticalcss:dev` (or `criticalcss:prod` for production)
  3. Deploy both `public/build/` and `public/critical.css`

### Asset Loading Strategy
All assets are optimized for maximum performance with no render-blocking resources:

- **Critical CSS** (13 KB): Inlined in `<head>` for immediate above-the-fold rendering
  - Includes: fonts (@font-face), Tailwind reset, layout utilities, responsive breakpoints
- **Main CSS** (102 KB): Deferred load via print media swap (non-blocking)
  - Loaded asynchronously after initial render
- **Fonts**: Defined in critical CSS via @font-face (no preload needed)
  - Browser automatically fetches only used font weights
- **JavaScript**: ES6 module scripts (automatically deferred by browser)
  - All Vite-generated scripts use `type="module"` for optimal loading
  - Chunks loaded on-demand
- **Google Analytics**: Asynchronously injected after page load (production only)
- **Images**: Lazy-loaded via native browser behavior where appropriate

### Responsive Images
The project uses responsive images with srcset for optimal delivery based on viewport size:
- **Generation**: Automatically generated during `npm run build` via `generate-responsive-images.js`
- **Sizes**: Creates 3 variants per image
  - Large images (hero/content): 400w, 800w, 1200w
  - Small images (logos): 100w, 200w, 300w
- **Format**: All responsive variants are converted to WebP at 80% quality
- **Output**: `public/build/images/responsive/`
- **Usage**: Use the `<x-responsive-image>` Blade component for automatic srcset
  ```blade
  <x-responsive-image 
      src="resources/images/kontakt.webp" 
      alt="Contact" 
      title="Contact"
      class="w-full h-auto"
      loading="lazy"
  />
  ```
- **Benefits**: 
  - Mobile devices load ~90% smaller images (e.g., kontakt.webp: 305 KB → 3.4 KB at 400w)
  - Tablet devices load ~70% smaller images  (e.g., kontakt.webp: 305 KB → 9.6 KB at 800w)
  - Total savings: ~5.3 MB for all images

## Notes
- Ensure dependencies are installed: `composer install` and `npm install`.
- For production, use `npm run build` and configure queues with Redis.
- Update this file as new commands are added.