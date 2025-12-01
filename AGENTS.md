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
  Note: This automatically generates critical CSS after building. Requires Laravel dev server running.

- **Generate critical CSS only**:
  ```bash
  npm run critical
  ```
  Requires Laravel dev server (`php artisan serve`) to be running.
  
  **Important**: Critical CSS generation requires:
  1. Vite build must complete first (`npm run build` already does this)
  2. Laravel dev server must be running on port 8000
  3. Uses `/de` route for CSS extraction

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
- **Generation**: Automated during `npm run build` via `generate-critical.js`
- **Viewport coverage**: Mobile (375x812), tablet (768x1024), desktop (1300x900)

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

## Notes
- Ensure dependencies are installed: `composer install` and `npm install`.
- For production, use `npm run build` and configure queues with Redis.
- Update this file as new commands are added.