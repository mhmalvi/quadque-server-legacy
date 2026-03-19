# Quadque Server Legacy

The original backend server for the **Quadque Technologies** digital platform. This Laravel 8 application served as the first-generation API and web backend before the platform rewrite. It remains available as a reference implementation and for legacy service support.

Part of the **Quadque digital platform ecosystem**.

---

## Features

- RESTful API with Laravel Sanctum authentication
- User agent detection for adaptive responses
- Mailgun-powered transactional email system
- Doctrine DBAL for advanced database operations
- Database schema management with migrations and seeders
- Blade templating engine for server-rendered views
- Laravel UI scaffolding for authentication flows
- Comprehensive test suite with PHPUnit and Mockery

## Tech Stack

| Layer        | Technology                                  |
|--------------|----------------------------------------------|
| Backend      | PHP 7.3+/8.0, Laravel 8                     |
| Auth         | Laravel Sanctum                              |
| Database     | MySQL (via Doctrine DBAL)                    |
| Email        | Symfony Mailgun Mailer                       |
| Views        | Blade Templates, Laravel UI                  |
| Build        | Laravel Mix 6, Webpack                       |
| Testing      | PHPUnit 9, Mockery, Faker                    |

## Getting Started

### Prerequisites

- PHP >= 7.3
- Composer
- Node.js >= 14
- MySQL

### Installation

```bash
git clone https://github.com/mhmalvi/quadque-server-legacy.git
cd quadque-server-legacy
composer install
npm install
```

### Environment Configuration

```bash
cp .env-example .env
php artisan key:generate
```

Update `.env` with your database credentials and mail configuration.

### Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### Development

```bash
php artisan serve
npm run dev
```

## Project Structure

```
quadque-server-legacy/
├── app/                 # Application logic
├── bootstrap/           # Framework bootstrap
├── config/              # Configuration files
├── database/
│   ├── factories/       # Model factories
│   ├── migrations/      # Database migrations
│   └── seeders/         # Database seeders
├── public/              # Public assets
├── resources/
│   ├── views/           # Blade templates
│   └── css/             # Stylesheets
├── routes/
│   ├── api.php          # API routes
│   └── web.php          # Web routes
├── storage/             # Logs and cache
├── tests/               # Test suites
└── webpack.mix.js       # Build configuration
```

## License

Proprietary — Quadque Technologies. All rights reserved.
