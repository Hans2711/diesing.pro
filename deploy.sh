#!/bin/bash

source ~/.bashrc

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"

export PATH="$HOME/.config/composer/vendor/bin:$HOME/bin:/usr/local/bin:$PATH"

# Install dependencies
echo "Installing PHP dependencies..."
$HOME/bin/composer install --no-dev --optimize-autoloader

# Install/update Node.js dependencies
echo "Installing Node.js dependencies..."
npm install

# Build frontend assets with responsive images
echo "Building front-end assets..."
npm run build

# Generate critical CSS for performance optimization
echo "Generating critical CSS..."
npm run critical:prod

php artisan migrate --force

php artisan optimize:clear
php artisan optimize

# Clear and cache configurations
echo "Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Stop and restart SSR server
echo "Restarting SSR server..."
php artisan inertia:stop-ssr || true
nohup php artisan inertia:start-ssr > /dev/null 2>&1 &

echo "Deployment complete!"