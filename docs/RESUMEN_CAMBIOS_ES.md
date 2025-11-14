# Resumen de Cambios - Fechas de Salida Múltiples

## Problema Original
Los productos solo podían tener una fecha de salida (`departure_date`), limitando las opciones para tours que se ofrecen en múltiples fechas.

## Solución Implementada

### 1. Base de Datos

#### Nueva Tabla: `departure_dates`
```
+----------------+------------------+
| Campo          | Tipo             |
+----------------+------------------+
| id             | BIGINT UNSIGNED  |
| product_id     | INT UNSIGNED     | (FK -> products.id)
| date           | DATE             |
| created_at     | TIMESTAMP        |
| updated_at     | TIMESTAMP        |
+----------------+------------------+
```

#### Modificación: `shopping` table
- Agregado: `departure_date_id` (FK -> departure_dates.id, nullable)
- Permite almacenar qué fecha seleccionó el cliente

### 2. Modelos (Backend)

#### DepartureDate.php (Nuevo)
- Modelo para gestionar fechas de salida
- Relación `belongsTo` con Product

#### Product.php
- Agregada relación `departureDates()` -> hasMany
- Mantiene compatibilidad con `departure_date` legacy

#### Shopping.php
- Agregada relación `departureDate()` -> belongsTo
- Campo `departure_date_id` en fillable

### 3. Controladores (Backend)

#### ProductController.php
**Cambios en `store()`:**
- Acepta array `departure_dates[]` en el request
- Crea múltiples registros en `departure_dates` table

**Cambios en `modificarProducto()`:**
- Acepta array `departure_dates[]`
- Elimina fechas antiguas y crea nuevas

**Cambios en `obtenerProducto()`:**
- Incluye `->with('departureDates')` para cargar las fechas

#### CartController.php
**Cambios en `reserve()` y `setPayload()`:**
- Acepta `departure_date_id` del request
- Guarda el ID en el registro de Shopping

### 4. Frontend (Vue.js)

#### ProductDetail.vue
**Lógica de Visualización:**
```
Si tiene departure_dates:
  Si hay > 1 fecha: Muestra "Salidas disponibles"
  Si hay 1 fecha: Muestra "Fecha de salida: [fecha formateada]"
Sino:
  Si tiene departure_date legacy: Muestra esa fecha
  Sino: No muestra nada
```

**Computed Properties Agregadas:**
- `hasDepartureDates`: Verifica si hay fechas
- `hasMultipleDepartureDates`: Verifica si hay más de una

#### Checkout/Index.vue
**Nuevos Elementos:**
- Dropdown de selección de fecha (solo si hay múltiples fechas)
- Variable `selectedDepartureDateId` en data
- Método `formatDepartureDate()` para formatear fechas en español
- Computed property `hasDepartureDates`

**Flujo de Checkout:**
```
Paso 1:
  [Dropdown: Fecha de salida] <- Solo si hay multiple fechas
  [Dropdown: Cantidad de pasajeros]
  [Formularios de pasajeros...]
  
  Al confirmar -> Envía departure_date_id al backend
```

## Ejemplo de Uso

### Crear producto con múltiples fechas:
```javascript
POST /productos
{
  "product_name": "Cataratas del Iguazú",
  "product_price": 35000,
  "departure_dates": [
    "2025-12-20",
    "2025-12-27",
    "2026-01-03"
  ]
  // ... otros campos
}
```

### En la ficha del producto:
- Se muestra: "✈️ Salidas disponibles"

### En el checkout:
- Aparece dropdown con opciones:
  - "20 de diciembre de 2025"
  - "27 de diciembre de 2025"
  - "3 de enero de 2026"

### Al reservar:
```javascript
POST /cart/reserve
{
  "id": 1,
  "departure_date_id": 2,  // Segunda fecha seleccionada
  "pasajeros": [...],
  "facturacion": {...}
}
```

## Compatibilidad

✅ **Retrocompatibilidad total:**
- Productos existentes siguen usando `departure_date` (campo legacy)
- Productos nuevos pueden usar `departure_dates` array
- Sistema detecta automáticamente cuál usar
- No se requieren cambios en productos existentes

## Archivos Modificados

**Backend (PHP/Laravel):**
- `app/Models/DepartureDate.php` (NUEVO)
- `app/Models/Product.php`
- `app/Models/Shopping.php`
- `app/Http/Controllers/ProductController.php`
- `app/Http/Controllers/CartController.php`
- `database/migrations/2025_11_14_125818_create_departure_dates_table.php` (NUEVO)
- `database/migrations/2025_11_14_125904_add_departure_date_id_to_shopping_table.php` (NUEVO)

**Frontend (Vue.js):**
- `resources/js/components/productos/ProductDetail.vue`
- `resources/js/components/Checkout/Index.vue`

**Documentación:**
- `docs/MULTIPLE_DEPARTURE_DATES.md` (NUEVO)

## Testing

✅ Sintaxis PHP: Validada sin errores
✅ Build Frontend: Compilado exitosamente
✅ Migraciones: Creadas correctamente

## Próximos Pasos para Deploy

1. Ejecutar migraciones:
   ```bash
   php artisan migrate
   ```

2. Rebuild assets si es necesario:
   ```bash
   npm run prod
   ```

3. Crear productos de prueba con múltiples fechas para verificar funcionamiento
