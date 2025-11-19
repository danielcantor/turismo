# Mejoras en la Administración de Productos

## Nuevas Funcionalidades Implementadas

### 1. Filtro por Categoría
- Se agregó un selector de categoría en la parte superior de la tabla de productos
- Permite filtrar productos según su categoría (Nacional, Internacional, etc.)
- El filtro se aplica automáticamente al cambiar la selección

### 2. Búsqueda por Nombre
- Campo de búsqueda que permite encontrar productos por su nombre
- La búsqueda es en tiempo real y busca coincidencias parciales
- Se puede combinar con otros filtros

### 3. Ordenamiento
Opciones de ordenamiento disponibles:
- **Fecha de creación** (por defecto, descendente)
- **Nombre del producto** (alfabéticamente)
- **Categoría** (agrupando por tipo)
- **Precio** (de menor a mayor o viceversa)

Cada opción puede ordenarse de forma ascendente o descendente.

### 4. Importación CSV/Excel
- Botón "Importar CSV" permite subir archivos CSV con productos
- Botón "Descargar Plantilla CSV" descarga un archivo de plantilla con las columnas necesarias
- El sistema puede:
  - Crear nuevos productos si no tienen ID
  - Actualizar productos existentes si se proporciona el ID
- Se muestran mensajes con el resultado de la importación

#### Formato del CSV
El archivo CSV debe incluir las siguientes columnas:
- `id` (opcional, solo para actualizar productos existentes)
- `product_name` - Nombre del producto
- `product_price` - Precio del producto
- `product_description` - Descripción del producto
- `product_type` - Tipo de producto (1 = Nacional, 2 = Internacional)
- `product_category` - Categoría del producto
- `days` - Número de días
- `nights` - Número de noches
- `product_activate` - Estado (1 = Activo, 0 = Inactivo)

### 5. Selector de Columnas
- Permite mostrar/ocultar columnas de la tabla según preferencia
- Columnas disponibles:
  - ID
  - Título
  - Descripción
  - Precio
  - Tipo
  - Días/Noches
  - Estado
- Las columnas de "Acciones" siempre están visibles

## Uso de las Nuevas Funcionalidades

### Filtrar Productos
1. Selecciona una categoría del menú desplegable "Filtrar por categoría"
2. Los productos se actualizarán automáticamente

### Buscar Productos
1. Escribe el nombre del producto en el campo "Buscar por nombre"
2. Los resultados se filtran mientras escribes

### Ordenar Productos
1. Selecciona el criterio de ordenamiento en "Ordenar por"
2. Selecciona el orden (Ascendente/Descendente)
3. Los productos se reorganizarán automáticamente

### Importar Productos
1. Haz clic en "Descargar Plantilla CSV" para obtener el formato correcto
2. Completa la plantilla con tus productos
3. Haz clic en "Importar CSV"
4. Selecciona tu archivo CSV completado
5. El sistema procesará el archivo y mostrará un resumen

### Personalizar Columnas
1. Usa los botones en "Columnas a mostrar"
2. Activa/desactiva las columnas que desees ver
3. La tabla se actualizará instantáneamente

## Endpoints API Agregados

### GET /products/get
Parámetros de consulta:
- `page` - Número de página (default: 1)
- `category` - ID de categoría para filtrar
- `search` - Texto para buscar en nombres de productos
- `sort_by` - Campo por el cual ordenar (created_at, product_name, product_category, product_price)
- `sort_order` - Orden de clasificación (asc, desc)

### POST /products/import
Carga un archivo CSV para importar/actualizar productos.

Body: FormData con campo `file`

### GET /products/export-template
Descarga una plantilla CSV con las columnas necesarias para importar productos.

## Pruebas
Se agregaron pruebas automatizadas para todas las nuevas funcionalidades:
- `tests/Feature/ProductFilteringTest.php` - Pruebas de filtrado, búsqueda y ordenamiento
- `tests/Feature/ProductImportTest.php` - Pruebas de importación CSV

Para ejecutar las pruebas:
```bash
php artisan test --filter=Product
```
