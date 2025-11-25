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

## Notes
- Ensure dependencies are installed: `composer install` and `npm install`.
- For production, use `npm run build` and configure queues with Redis.
- Update this file as new commands are added.