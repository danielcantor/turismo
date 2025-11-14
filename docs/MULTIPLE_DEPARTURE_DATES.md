# Multiple Departure Dates Feature

## Overview
This feature allows products to have multiple departure dates instead of just one. When a product has multiple dates, customers can select their preferred date during checkout.

## Database Schema

### New Table: `departure_dates`
- `id` - Primary key
- `product_id` - Foreign key to products table
- `date` - The departure date
- `created_at` / `updated_at` - Timestamps

### Modified Table: `shopping`
- Added `departure_date_id` - Foreign key to departure_dates table (nullable)

## Usage

### Creating/Updating Products with Multiple Dates

When creating or updating a product via the API, you can now send an array of departure dates:

```javascript
// Example POST to /productos or /modificarProducto/{id}
{
  "product_name": "Viaje a Bariloche",
  "product_description": "...",
  "product_type": 1,
  "product_price": 50000,
  "days": 5,
  "nights": 4,
  "departure_dates": [
    "2025-12-15",
    "2025-12-22",
    "2026-01-05",
    "2026-01-12"
  ]
}
```

### Frontend Display

#### Product Detail Page
- **Single Date**: Shows "Fecha de salida: 15 de diciembre de 2025"
- **Multiple Dates**: Shows "Salidas disponibles"
- **No Dates**: Falls back to legacy `departure_date` field if present

#### Checkout Page
- If product has multiple departure dates, a dropdown appears in Step 1
- Customer must select a departure date before proceeding
- The selected date is saved with the reservation

### Retrieving Product Data

When fetching a product, the API now includes departure dates:

```javascript
// GET /obtenerProducto/{id}
{
  "id": 1,
  "product_name": "Viaje a Bariloche",
  "departure_dates": [
    {
      "id": 1,
      "product_id": 1,
      "date": "2025-12-15"
    },
    {
      "id": 2,
      "product_id": 1,
      "date": "2025-12-22"
    }
  ]
}
```

### Making a Reservation

When submitting a reservation, include the selected departure date ID:

```javascript
// POST /cart/reserve
{
  "id": 1,
  "departure_date_id": 2,  // The selected date ID
  "price": 50000,
  "pasajeros": [...],
  "facturacion": {...}
}
```

## Backward Compatibility

- The legacy `departure_date` field on the products table is still supported
- Products without departure dates continue to work as before
- UI gracefully handles products with no dates, single date, or multiple dates

## Migration

To apply the changes to your database:

```bash
php artisan migrate
```

This will create:
1. The `departure_dates` table
2. Add `departure_date_id` column to `shopping` table
