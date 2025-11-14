# Turismo - Travel Booking Platform

A Laravel + Vue.js travel booking platform with integrated Google Analytics 4 tracking.

## Features

- Travel package browsing and search
- Multi-step checkout process
- Passenger information management
- Integrated payment system
- Google Analytics 4 tracking for traffic and e-commerce events

## Setup

### Prerequisites

- PHP >= 7.3
- Composer
- Node.js & npm
- MySQL or compatible database

### Installation

1. Clone the repository
```bash
git clone <repository-url>
cd turismo
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
```

4. Copy environment file and configure
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Configure your database and Google Analytics in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=turismo
DB_USERNAME=root
DB_PASSWORD=

GOOGLE_ANALYTICS_ID=G-XXXXXXXXXX
```

7. Run migrations
```bash
php artisan migrate
```

8. Build assets
```bash
npm run production
```

9. Start the development server
```bash
php artisan serve
```

## Google Analytics 4 Integration

This project includes comprehensive GA4 tracking for:

- **Traffic Analysis**: All page views and user sessions
- **E-commerce Tracking**: Complete checkout funnel with events:
  - `begin_checkout` - User starts checkout
  - `add_shipping_info` - Passenger information completed
  - `add_payment_info` - Billing information completed  
  - `purchase` - Reservation confirmed

For detailed setup instructions and usage, see [GA4 Implementation Guide](docs/GA4_IMPLEMENTATION.md).

## Development

### Build for development
```bash
npm run dev
```

### Watch for changes
```bash
npm run watch
```

### Build for production
```bash
npm run production
```

## Project Structure

- `app/` - Laravel application logic
- `resources/views/` - Blade templates
- `resources/js/` - Vue.js components and JavaScript
- `resources/js/utils/ga4.js` - Google Analytics 4 utility helper
- `public/` - Public assets
- `routes/` - Application routes
- `docs/` - Project documentation

## License

This project is proprietary software. All rights reserved.
