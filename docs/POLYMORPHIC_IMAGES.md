# Sistema de Imágenes Polimórficas

## Descripción General

Este documento describe la implementación del sistema de imágenes polimórficas en la aplicación de Turismo. El sistema permite que múltiples modelos (Categorías, Productos, y futuros modelos) compartan una tabla de imágenes centralizada utilizando relaciones polimórficas de Laravel.

## ¿Por qué Relaciones Polimórficas?

Antes de esta implementación, las imágenes se almacenaban directamente en las tablas de cada modelo:
- **Categorías**: columnas `image` y `home_image`
- **Productos**: columnas `product_image` y `product_slider`

### Problemas con el Enfoque Anterior:
1. **Falta de escalabilidad**: Cada nuevo modelo que necesite imágenes requiere nuevas columnas
2. **Duplicación de lógica**: El código para manejar imágenes se repite en cada controlador
3. **Difícil de mantener**: Cambios en la gestión de imágenes requieren modificar múltiples lugares
4. **Sin flexibilidad**: Limitado a un número fijo de imágenes por modelo

### Ventajas del Nuevo Sistema:
1. **Escalable**: Cualquier modelo puede tener imágenes sin modificar la estructura de base de datos
2. **Flexible**: Cada modelo puede tener cualquier número de imágenes
3. **Centralizado**: Una sola tabla y lógica para todas las imágenes
4. **Tipado**: Las imágenes tienen tipos (main, home, slider) para organización
5. **Ordenable**: Soporte nativo para ordenar múltiples imágenes

## Estructura de la Base de Datos

### Tabla `images`

```sql
CREATE TABLE images (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    imageable_type VARCHAR(255),    -- Tipo de modelo (Category, Product, etc.)
    imageable_id BIGINT,            -- ID del modelo
    path VARCHAR(255),              -- Ruta del archivo de imagen
    type VARCHAR(255) NULLABLE,     -- Tipo de imagen (main, home, slider)
    order INT DEFAULT 0,            -- Orden para múltiples imágenes
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    INDEX idx_imageable (imageable_type, imageable_id)
);
```

## Uso en Modelos

### Modelo Image

```php
use App\Models\Image;

// Obtener la URL completa de una imagen
$image = Image::find(1);
echo $image->url; // /storage/path/to/image.jpg

// Obtener el modelo padre
$imageable = $image->imageable; // Retorna Category o Product
```

### Modelo Category

```php
use App\Models\Category;

$category = Category::find(1);

// Obtener todas las imágenes
$images = $category->images;

// Obtener imagen principal
$mainImage = $category->getMainImage();
echo $mainImage->url; // /storage/categories/main.jpg

// Obtener imagen de home
$homeImage = $category->getHomeImage();
echo $homeImage->url; // /storage/categories/home.jpg

// Crear nueva imagen
$category->images()->create([
    'path' => 'categories/new-image.jpg',
    'type' => 'main',
    'order' => 0
]);
```

### Modelo Product

```php
use App\Models\Product;

$product = Product::find(1);

// Obtener todas las imágenes
$images = $product->images;

// Obtener imagen principal
$mainImage = $product->getMainImage();
echo $mainImage->url; // /storage/products/main.jpg

// Obtener imágenes del slider (ordenadas)
$sliderImages = $product->getSliderImages();
foreach ($sliderImages as $image) {
    echo $image->url . "\n";
}

// Crear múltiples imágenes del slider
$product->images()->create([
    'path' => 'products/slider-1.jpg',
    'type' => 'slider',
    'order' => 1
]);

$product->images()->create([
    'path' => 'products/slider-2.jpg',
    'type' => 'slider',
    'order' => 2
]);
```

## Migración de Datos Existentes

Se han creado dos seeders para migrar las imágenes existentes al nuevo sistema:

### 1. Migrar Imágenes de Categorías

```bash
php artisan db:seed --class=MigrateCategoryImagesToImagesTableSeeder
```

Este seeder:
- Migra la columna `image` como tipo 'main'
- Migra la columna `home_image` como tipo 'home'

### 2. Migrar Imágenes de Productos

```bash
php artisan db:seed --class=MigrateProductImagesToImagesTableSeeder
```

Este seeder:
- Migra la columna `product_image` como tipo 'main'
- Migra la columna `product_slider` (puede contener múltiples imágenes separadas por comas) como tipo 'slider'

## Compatibilidad Hacia Atrás

Las columnas antiguas (`image`, `home_image`, `product_image`, `product_slider`) **permanecen en las tablas** para garantizar compatibilidad durante el período de transición. Esto permite:

1. Que el código existente siga funcionando
2. Una migración gradual sin tiempo de inactividad
3. Rollback fácil si es necesario

## Agregar Imágenes a Nuevos Modelos

Para agregar soporte de imágenes a un nuevo modelo:

1. Agregar el trait y relación al modelo:

```php
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class NuevoModelo extends Model
{
    /**
     * Get all images for this model
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the main image
     */
    public function getMainImage()
    {
        return $this->images()->where('type', 'main')->first();
    }
}
```

2. Usar en el controlador:

```php
$modelo = NuevoModelo::find(1);

// Guardar imagen subida
if ($request->hasFile('image')) {
    $path = $request->file('image')->store('images', 'public');
    
    $modelo->images()->create([
        'path' => $path,
        'type' => 'main',
        'order' => 0
    ]);
}

// Obtener imagen para la vista
$imagen = $modelo->getMainImage();
$url = $imagen ? $imagen->url : null;
```

## Tipos de Imagen Soportados

Los tipos de imagen actuales son:

- **main**: Imagen principal del modelo
- **home**: Imagen para la página de inicio
- **slider**: Imágenes para carruseles/sliders

Puedes definir tus propios tipos según las necesidades de tu aplicación.

## Pruebas

Se han creado pruebas unitarias para verificar el funcionamiento correcto:

```bash
php artisan test --filter ImagePolymorphicTest
```

Las pruebas verifican:
- Que las categorías pueden tener múltiples imágenes
- Que los productos pueden tener múltiples imágenes
- Que los métodos helper retornan las imágenes correctas
- Que el atributo URL se genera correctamente

## Próximos Pasos Recomendados

1. **Actualizar Controladores**: Modificar CategoryController y ProductController para usar el nuevo sistema
2. **Actualizar Vistas**: Cambiar las vistas para usar `$model->getMainImage()->url` en lugar de acceder directamente a las columnas
3. **Eliminar Columnas Antiguas**: Una vez migrado todo el código, crear una migración para eliminar las columnas antiguas
4. **Agregar Validación**: Implementar validación de tamaño y tipo de archivos en el modelo Image
5. **Optimización**: Agregar eager loading de imágenes para mejorar el rendimiento

## Ejemplo de Uso Completo en Controlador

```php
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'image' => 'required|image|max:2048',
        'slider_images.*' => 'image|max:2048'
    ]);

    $product = Product::create($request->only(['name', 'description', 'price']));

    // Guardar imagen principal
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $product->images()->create([
            'path' => $path,
            'type' => 'main',
            'order' => 0
        ]);
    }

    // Guardar imágenes del slider
    if ($request->hasFile('slider_images')) {
        foreach ($request->file('slider_images') as $index => $file) {
            $path = $file->store('products/slider', 'public');
            $product->images()->create([
                'path' => $path,
                'type' => 'slider',
                'order' => $index + 1
            ]);
        }
    }

    return redirect()->route('products.show', $product);
}

public function show(Product $product)
{
    // Eager load images para mejor rendimiento
    $product->load('images');
    
    return view('products.show', [
        'product' => $product,
        'mainImage' => $product->getMainImage(),
        'sliderImages' => $product->getSliderImages()
    ]);
}
```

## Consideraciones de Seguridad

1. **Validación de Archivos**: Siempre validar tipo y tamaño de archivos subidos
2. **Sanitización de Nombres**: Usar nombres generados automáticamente para evitar path traversal
3. **Permisos de Storage**: Asegurar que el directorio storage/app/public tenga los permisos correctos
4. **Límites de Tamaño**: Configurar límites apropiados en php.ini y Laravel

## Soporte

Para preguntas o problemas con el sistema de imágenes polimórficas, consultar:
- Documentación de Laravel: https://laravel.com/docs/eloquent-relationships#polymorphic-relationships
- Este documento
- El código fuente en `app/Models/Image.php`
