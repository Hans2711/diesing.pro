#!/bin/bash

source ~/.bashrc

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"

export PATH="$HOME/.config/composer/vendor/bin:$HOME/bin:/usr/local/bin:$PATH"

# Deploy script for diesing.pro
# This script handles cache clearing and frontend builds without sudo

set -e  # Exit on any error

echo "Starting deployment for diesing.pro..."

# Install/update Composer dependencies
echo "Installing Composer dependencies..."
$HOME/bin/composer install --no-dev --prefer-dist --no-progress --no-interaction --optimize-autoloader

# Install/update Node.js dependencies
echo "Installing Node.js dependencies..."
npm install --production=false

# Build frontend assets with responsive images
echo "Building frontend assets..."
npm run build

# Generate critical CSS for production
echo "Generating critical CSS..."
npm run criticalcss:prod

# Clear application caches
echo "Clearing application caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations (if needed)
echo "Running database migrations..."
php artisan migrate --force

# Restart queue workers if running
echo "Restarting queue workers..."
php artisan queue:restart

echo "Deployment completed successfully!"