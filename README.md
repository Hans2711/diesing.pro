# diesing.pro

This repository contains the source code for [diesing.pro](https://www.diesing.pro/), a personal portfolio website for HP Diesing featuring interactive tools and professional content.

## Website

Visit: <https://www.diesing.pro/>

The site is available in English and German. It provides both public pages and a private account area for registered users. The displayed language is automatically selected based on the visitor's region when possible.

## Features

### Public Pages
- **Home page** – Overview with links to main sections, including portfolio highlights.
- **Contact** – Secure contact form to send messages to predefined recipients, with email confirmations.
- **CV** – Static resume displaying qualifications, professional experience, programming skills, and contact information.
- **Real-Time Share** – Peer-to-peer tool for beaming text and files directly to other devices via WebRTC, without server storage.
- **Random Teams Generator** – Interactive tool to create fair, balanced random teams from player lists, with support for multiple games, win tracking, and state persistence.
- **Legal pages** – Imprint and Data Protection information for compliance.

### Account Area (Private Tools)
Requires user registration and login:
- **Notes** – Create, edit, and manage private notes with optional public sharing (password-protected). Accessible via unique URLs (`/n/{slug}`).
- **Redirects** – Set up custom URL redirects (301/302/307) with hit tracking and analytics. Public redirects via unique URLs (`/r/{slug}`).

### Additional Features
- **RSS Feed** – Syndicated content feed.
- **Quote API** – Random quote endpoint (`/quote/rand`) for external use.
- **Multi-language Support** – Full localization in German and English.
- **SEO Enhancements** – JSON-LD structured data, Open Graph metadata, and optimized titles/descriptions.
- **Email System** – Queued background jobs for contact form submissions and confirmations.
- **Permissions** – Granular access control for notes and redirects; admin privileges.

All content is located within the `resources` folder, and routing logic is under `routes/`.

## Tech Stack

- **Backend**: Laravel 11 with Livewire 3 for reactive components.
- **Frontend**: Tailwind CSS, Alpine.js, Quill editor, Dropzone for uploads.
- **Database**: MySQL/SQLite with migrations for users, notes, redirects, teams state, and analytics.
- **Queue**: Redis/Laravel queues for email jobs.
- **Other**: WebRTC for real-time sharing, FingerprintJS for device identification, Laravel Pint for code linting.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Hans2711/diesing.pro.git
   cd diesing.pro
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node.js dependencies:
   ```bash
   npm install
   ```

4. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Run migrations:
   ```bash
   php artisan migrate
   ```

6. Build assets:
   ```bash
   npm run build
   ```

7. (Optional) Seed database:
   ```bash
   php artisan db:seed
   ```

## Development

- Start development server:
  ```bash
  php artisan serve
  ```

- Watch assets:
  ```bash
  npm run dev
  ```

- Run tests:
  ```bash
  php artisan test
  ```

- Lint code:
  ```bash
  ./vendor/bin/pint
  ```

## Queue Workers

Background jobs rely on Laravel's queue system. For faster processing, configure a Redis queue connection and run multiple workers:

```bash
php artisan queue:work --queue=default --tries=3
```

Using several workers allows asynchronous email sending to complete more quickly.

## Recent Updates

- Enhanced German localization for random teams descriptions.
- Updated CV with detailed programming skills and translations.
- Added JSON-LD structured data for improved SEO.
- Refactored views for better semantic structure and Open Graph metadata.
- Made contact form recipients static.
- Added GitHub link to footer.
- Various configuration and dependency updates.

