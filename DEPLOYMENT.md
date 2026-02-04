# Docker Deployment Guide for Flash PTSP

This guide explains how to deploy the Flash PTSP application using Docker.

## Prerequisites

- Docker and Docker Compose installed on the server/machine.

## Structure

- `Dockerfile`: Defines the application image (PHP 8.2 + Extensions + Composer + NodeJS).
- `docker-compose.yml`: Orchestrates services (App, Nginx, MySQL, Redis).
- `docker/`: Configuration files for Nginx and PHP.

## Setup Instructions

### 1. Environment Configuration

1. Copy `.env.example` to `.env` (if not already done).
   ```bash
   cp .env.example .env
   ```
2. Update `.env` to match Docker service names:
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=db  <-- Important: Use the service name 'db' default from docker-compose
   DB_PORT=3306
   DB_DATABASE=flash_ptsp
   DB_USERNAME=root
   DB_PASSWORD=your_secret_password

   REDIS_HOST=redis <-- Important: Use the service name 'redis'
   ```

### 2. Building and Running

Run the following command to build and start the containers:

```bash
docker-compose up -d --build
```

- `-d`: Detached mode (runs in background).
- `--build`: Forces rebuilding of the image.

### 3. Post-Deployment Steps

Once containers are up, run the following commands to initialize the application:

```bash
# Install dependencies (if volume mounted) and run migrations
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
docker-compose exec app php artisan filament:optimize
docker-compose exec app npm install
docker-compose exec app npm run build
```

### 4. Accessing the Application

The application should now be accessible at `http://localhost:8000` (or your server IP).

## Production Notes

The `Dockerfile` provided is optimized for production readiness:
- It installs Opcache for performance.
- It copies the source code into the image.

**Important for Production Cache:**
The `docker/php/conf.d/opcache.ini` is set with `opcache.validate_timestamps=1` which checks for file changes. For maximum performance in a static production environment, change this to `0`.

**Volume Mounting:**
The default `docker-compose.yml` mounts the current directory (`./:/var/www`). This is great for development or simple deployments where you `git pull` on the server.
If you prefer a strictly immutable container deployment, remove the volume mount for `/var/www` in `docker-compose.yml` so that it uses the code baked into the Dockerfile.

## Troubleshooting

- **Permissions**: If you encounter permission errors, run:
  ```bash
  docker-compose exec app chown -R www-data:www-data /var/www/storage
  ```
- **Nginx 404**: Ensure the `public` directory contains `index.php`.
- **Database Connection**: Verify `DB_HOST=db` in `.env`.
