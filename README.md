# Laravel Locations

A Laravel-based Location Management System with full authentication, CRUD operations, and automated daily data reset.

## Features

- **Authentication**: Login, Logout, Forgot/Reset Password via email
- **Location CRUD**: Create, Read, Update, Delete locations with DataTables server-side API
- **Daily Data Reset**: Automatic location data reset at midnight via Laravel Scheduler
- **UI**: Limitless-inspired Bootstrap 5 dark-sidebar layout
- **Docker**: MySQL 8 + Nginx + MailHog (email testing) via Docker Compose

---

## Requirements

- [Docker](https://www.docker.com/) & Docker Compose v2+
- Git

---

## Quick Start (Docker)

### 1. Clone the project

```bash
git clone <repository-url> laravel-locations
cd laravel-locations
```

### 2. Copy environment file

```bash
cp .env.example .env
```

### 3. (Optional) Configure mail & app settings

Open `.env` and update the following if needed:

| Key | Default | Description |
|-----|---------|-------------|
| `APP_NAME` | `Laravel Locations` | Application name shown in UI |
| `APP_URL` | `http://localhost:8000` | Base URL |
| `DB_DATABASE` | `laravel_locations` | MySQL database name |
| `DB_USERNAME` | `laravel` | MySQL username |
| `DB_PASSWORD` | `secret` | MySQL password |
| `MAIL_HOST` | `mailhog` | SMTP host (`mailhog` for local testing) |
| `MAIL_PORT` | `1025` | SMTP port |
| `MAIL_FROM_ADDRESS` | `noreply@laravel-locations.test` | From email address |

### 4. Build and start containers

```bash
docker compose up -d --build
```

This will:
- Build the PHP 8.3-FPM container
- Start MySQL 8, Nginx, and MailHog
- Run migrations and seed data automatically

### 5. Generate app key (first time only)

```bash
docker compose exec app php artisan key:generate
```

### 6. Access the application

| Service | URL |
|---------|-----|
| **Application** | http://localhost:8000 |
| **MailHog (email UI)** | http://localhost:8025 |

### Default login credentials

| Field | Value |
|-------|-------|
| Email | `admin@example.com` |
| Password | `password` |

---

## Configuration Details

### Database

The application uses **MySQL 8** in Docker. Connection settings in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=db          # Docker service name
DB_PORT=3306
DB_DATABASE=laravel_locations
DB_USERNAME=laravel
DB_PASSWORD=secret
```

### Email (Forgot Password)

By default, **MailHog** is used to catch all outgoing emails locally.

- MailHog Web UI: http://localhost:8025
- Emails sent via "Forgot Password" will appear here

For production, update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.your-provider.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_ENCRYPTION=tls
```

### Daily Data Reset

The location table is automatically reset to initial seed data **every day at midnight** via Laravel Scheduler.

The cron job runs inside the Docker container:
```
* * * * * php artisan schedule:run
```

Scheduled command: `locations:reset --force` (runs at `00:00` daily).

To run manually:
```bash
docker compose exec app php artisan locations:reset --force
```

---

## Development Commands

```bash
# View running containers
docker compose ps

# Access app container
docker compose exec app bash

# Run migrations
docker compose exec app php artisan migrate

# Re-seed database
docker compose exec app php artisan db:seed

# Reset locations data
docker compose exec app php artisan locations:reset --force

# View logs
docker compose logs -f app

# Stop all containers
docker compose down

# Stop and remove volumes (will delete database)
docker compose down -v
```

---

## Project Structure

```
├── app/
│   ├── Console/Commands/ResetLocationsData.php   # Daily reset command
│   ├── Http/Controllers/
│   │   ├── Auth/                                 # Login, ForgotPassword, ResetPassword
│   │   ├── DashboardController.php
│   │   ├── LocationController.php                # CRUD + API endpoint for DataTables
│   │   └── ProfileController.php
│   └── Models/
│       ├── Location.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── LocationSeeder.php                    # 20 Vietnam city locations
│       └── UserSeeder.php
├── resources/views/
│   ├── layouts/app.blade.php                     # Main layout (dark sidebar)
│   ├── layouts/auth.blade.php                    # Auth layout
│   ├── auth/                                     # Login, forgot/reset password views
│   ├── locations/                                # CRUD views
│   ├── profile/                                  # Profile edit view
│   └── index.blade.php                           # Dashboard
├── routes/
│   ├── web.php                                   # All web routes
│   └── console.php                               # Scheduler config
└── docker/
    ├── nginx/default.conf
    ├── php/local.ini
    └── entrypoint.sh
```

---

## Routes Overview

| Method | URL | Name | Auth |
|--------|-----|------|------|
| GET | `/login` | `login` | Guest |
| POST | `/login` | — | Guest |
| POST | `/logout` | `logout` | ✓ |
| GET | `/forgot-password` | `password.request` | Guest |
| POST | `/forgot-password` | `password.email` | Guest |
| GET | `/reset-password/{token}` | `password.reset` | Guest |
| POST | `/reset-password` | `password.update` | Guest |
| GET | `/` | `index` | ✓ |
| GET | `/profile/edit` | `profile.edit` | ✓ |
| PUT | `/profile` | `profile.update` | ✓ |
| GET | `/locations` | `locations.index` | ✓ |
| GET | `/locations/api-data` | `locations.api-data` | ✓ |
| GET | `/locations/create` | `locations.create` | ✓ |
| POST | `/locations` | `locations.store` | ✓ |
| GET | `/locations/{id}/edit` | `locations.edit` | ✓ |
| PUT | `/locations/{id}` | `locations.update` | ✓ |
| DELETE | `/locations/{id}` | `locations.destroy` | ✓ |
