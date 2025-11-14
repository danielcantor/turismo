# Migración de Fechas de Salida - Guía de Deployment

## Resumen

Este documento explica cómo migrar las fechas de salida del campo legacy `departure_date` en la tabla `products` a la nueva tabla `departure_dates`, y luego eliminar el campo antiguo.

## Pasos para la Migración

### 1. Aplicar las Migraciones de la Nueva Tabla

Primero, aplica las migraciones para crear la tabla `departure_dates` y agregar la columna `departure_date_id` a la tabla `shopping`:

```bash
php artisan migrate
```

Esto creará:
- Tabla `departure_dates` con columnas: `id`, `product_id`, `date`, `created_at`, `updated_at`
- Columna `departure_date_id` en la tabla `shopping` (FK a `departure_dates.id`)

**IMPORTANTE:** No ejecutes todas las migraciones juntas. Detente aquí antes de ejecutar la migración que elimina el campo `departure_date`.

### 2. Ejecutar el Seeder de Migración de Datos

Una vez creadas las nuevas tablas, ejecuta el seeder para migrar los datos existentes:

```bash
php artisan db:seed --class=MigrateDepartureDatesToNewTableSeeder
```

Este seeder:
- ✅ Lee todos los productos que tienen `departure_date` no nulo
- ✅ Crea registros correspondientes en la tabla `departure_dates`
- ✅ Verifica duplicados antes de insertar
- ✅ Muestra un resumen de productos migrados y omitidos

**Ejemplo de salida:**
```
Starting migration of departure dates...
Found 15 products with departure dates.
✓ Migrated product ID 1: Bariloche Tour - 2025-12-15
✓ Migrated product ID 2: Cataratas - 2025-11-20
...
Migration complete!
Migrated: 15 products
```

### 3. Verificar los Datos Migrados

Verifica que los datos se migraron correctamente:

```sql
-- Ver productos con sus fechas migradas
SELECT p.id, p.product_name, p.departure_date as old_date, dd.date as new_date
FROM products p
LEFT JOIN departure_dates dd ON dd.product_id = p.id
WHERE p.departure_date IS NOT NULL;

-- Contar productos migrados
SELECT COUNT(*) as products_with_old_date,
       (SELECT COUNT(DISTINCT product_id) FROM departure_dates) as products_with_new_dates
FROM products
WHERE departure_date IS NOT NULL;
```

Los números deben coincidir. Si todo está correcto, procede al siguiente paso.

### 4. Aplicar la Migración de Eliminación del Campo Legacy

Una vez verificados los datos, ejecuta la migración para eliminar el campo `departure_date`:

```bash
php artisan migrate
```

Esto ejecutará la migración `RemoveDepartureDateFromProductsTable` que elimina la columna `departure_date` de la tabla `products`.

### 5. Verificación Final

Verifica que todo funciona correctamente:

```bash
# Verificar estructura de la tabla
php artisan migrate:status

# Probar la aplicación
php artisan serve
```

Navega a la ficha de un producto y verifica que:
- ✅ Se muestran las fechas de salida correctamente
- ✅ "Salidas disponibles" aparece para productos con múltiples fechas
- ✅ La fecha específica aparece para productos con una sola fecha

## Rollback (En caso de problemas)

Si necesitas revertir los cambios:

```bash
# Esto recreará la columna departure_date
php artisan migrate:rollback

# Los datos en departure_dates permanecen intactos
```

Para restaurar los datos del campo `departure_date` desde `departure_dates`:

```sql
UPDATE products p
SET departure_date = (
    SELECT date 
    FROM departure_dates dd 
    WHERE dd.product_id = p.id 
    LIMIT 1
)
WHERE EXISTS (
    SELECT 1 
    FROM departure_dates dd 
    WHERE dd.product_id = p.id
);
```

## Archivos Modificados

### Backend
- ✅ `app/Models/Product.php` - Removido `departure_date` de fillable
- ✅ `app/Http/Controllers/ProductController.php` - Removida lógica de `departure_date`
- ✅ `database/seeders/MigrateDepartureDatesToNewTableSeeder.php` (NUEVO)
- ✅ `database/migrations/2025_11_14_132320_remove_departure_date_from_products_table.php` (NUEVO)

### Frontend
- ✅ `resources/js/components/productos/ProductDetail.vue` - Removido fallback a `departure_date`

## Notas Importantes

⚠️ **IMPORTANTE**: Ejecuta estos pasos en orden:
1. Migrar nuevas tablas
2. Ejecutar seeder
3. Verificar datos
4. Eliminar campo legacy

⚠️ **BACKUP**: Siempre haz un backup de tu base de datos antes de ejecutar migraciones en producción.

⚠️ **TESTING**: Prueba este proceso en un ambiente de desarrollo o staging antes de ejecutarlo en producción.

## Verificación Post-Migración

Después de completar la migración, verifica:

- [ ] Todos los productos que tenían `departure_date` ahora tienen registros en `departure_dates`
- [ ] La UI muestra correctamente las fechas de salida
- [ ] El checkout permite seleccionar fechas cuando hay múltiples opciones
- [ ] Las reservas guardan correctamente el `departure_date_id` seleccionado
- [ ] No hay errores en los logs de la aplicación

## Soporte

Si encuentras algún problema durante la migración, revisa:
1. Los logs de Laravel: `storage/logs/laravel.log`
2. Los errores de la base de datos
3. El output del seeder para ver qué productos fallaron

Para preguntas adicionales, contacta al equipo de desarrollo.
