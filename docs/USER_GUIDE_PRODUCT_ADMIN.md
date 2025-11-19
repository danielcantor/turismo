# Guía de Usuario - Administración de Productos

## Acceso a la Administración de Productos

1. Inicia sesión como administrador
2. Navega a la sección de productos en `/products/list`

## Interfaz de Usuario

La página de administración de productos ahora incluye:

### 1. Barra de Herramientas Superior
```
[Crear Producto] [Importar CSV] [Descargar Plantilla CSV]
```

### 2. Controles de Filtrado y Búsqueda
```
┌─────────────────────┬─────────────────────┬─────────────────────┬─────────────────────┐
│ Filtrar por         │ Buscar por nombre   │ Ordenar por         │ Orden               │
│ categoría           │                     │                     │                     │
│ [Dropdown]          │ [Campo de texto]    │ [Dropdown]          │ [Dropdown]          │
└─────────────────────┴─────────────────────┴─────────────────────┴─────────────────────┘
```

### 3. Selector de Columnas
```
Columnas a mostrar:
[✓ ID] [✓ Título] [✓ Descripción] [✓ Precio] [✓ Tipo] [  Días/Noches] [  Estado]
```

### 4. Tabla de Productos
Muestra los productos según los filtros y columnas seleccionadas.

## Uso de las Funcionalidades

### Filtrar por Categoría

**Objetivo**: Mostrar solo productos de una categoría específica.

**Pasos**:
1. Haz clic en el dropdown "Filtrar por categoría"
2. Selecciona una categoría (ej: "Nacional", "Internacional")
3. La tabla se actualizará automáticamente

**Ejemplo de uso**:
- Quieres revisar solo los tours nacionales
- Seleccionas "Nacional" en el filtro
- Solo verás productos con categoría "Nacional"

**Para limpiar el filtro**:
- Selecciona "Todas las categorías"

---

### Buscar por Nombre

**Objetivo**: Encontrar productos específicos por su nombre.

**Pasos**:
1. Escribe en el campo "Buscar por nombre"
2. La búsqueda es en tiempo real (mientras escribes)
3. Los resultados se filtran automáticamente

**Características**:
- Búsqueda parcial (no necesitas el nombre completo)
- No distingue mayúsculas y minúsculas
- Busca coincidencias en cualquier parte del nombre

**Ejemplos**:
- Buscar "playa" mostrará "Tour de Playa Paraíso" y "Excursión Playas del Sur"
- Buscar "patagonia" mostrará todos los productos con "Patagonia" en el nombre

**Para limpiar la búsqueda**:
- Borra el texto del campo de búsqueda

---

### Ordenar Productos

**Objetivo**: Organizar productos según diferentes criterios.

**Criterios de ordenamiento disponibles**:
1. **Fecha de creación** (default): Productos más recientes primero
2. **Nombre**: Orden alfabético
3. **Categoría**: Agrupados por tipo
4. **Precio**: De menor a mayor o viceversa

**Pasos**:
1. Selecciona el criterio en "Ordenar por"
2. Selecciona el orden:
   - **Ascendente**: A-Z, menor a mayor, más antiguos primero
   - **Descendente**: Z-A, mayor a menor, más recientes primero
3. La tabla se reorganiza automáticamente

**Casos de uso comunes**:
- **Ver productos nuevos**: Ordenar por "Fecha de creación" (Descendente)
- **Buscar productos baratos**: Ordenar por "Precio" (Ascendente)
- **Revisar alfabéticamente**: Ordenar por "Nombre" (Ascendente)

---

### Importar Productos desde CSV

**Objetivo**: Crear o actualizar múltiples productos en una sola operación.

#### Paso 1: Preparar el archivo CSV

1. Haz clic en **[Descargar Plantilla CSV]**
2. Se descargará `plantilla_productos.csv` con las columnas correctas
3. Abre el archivo con Excel, Google Sheets o un editor de texto

#### Paso 2: Completar el archivo

**Columnas del CSV**:
- `id`: ID del producto (opcional, solo para actualizar existentes)
- `product_name`: Nombre del producto (requerido)
- `product_price`: Precio del producto (requerido)
- `product_description`: Descripción del producto (requerido)
- `product_type`: Tipo (1 = Nacional, 2 = Internacional)
- `product_category`: Categoría (normalmente igual a product_type)
- `days`: Número de días del tour
- `nights`: Número de noches del tour
- `product_activate`: Estado (1 = Activo, 0 = Inactivo)

**Ejemplo de CSV**:
```csv
id,product_name,product_price,product_description,product_type,product_category,days,nights,product_activate
,"Tour Mendoza",25000,"Visita a bodegas y viñedos",1,1,3,2,1
,"Tour Iguazú",35000,"Cataratas del Iguazú",1,1,4,3,1
15,"Tour Bariloche",40000,"Actualización de tour existente",1,1,5,4,1
```

**Notas importantes**:
- Para crear nuevos productos: deja la columna `id` vacía o no incluyas ID
- Para actualizar productos existentes: incluye el ID del producto
- Los textos con comas deben estar entre comillas dobles
- Guarda el archivo como CSV (UTF-8)

#### Paso 3: Importar el archivo

1. Haz clic en **[Importar CSV]**
2. Selecciona tu archivo CSV preparado
3. Espera la confirmación
4. Verás un mensaje con:
   - Número de productos creados
   - Número de productos actualizados
   - Errores (si los hubiera)

**Manejo de errores**:
- Si hay errores en algunas filas, las filas válidas se procesarán de todos modos
- Los errores se mostrarán en la consola del navegador
- Revisa y corrige el CSV para las filas con errores

---

### Seleccionar Columnas Visibles

**Objetivo**: Personalizar qué información ver en la tabla.

**Pasos**:
1. Usa los botones en "Columnas a mostrar"
2. Haz clic en un botón para activar/desactivar una columna
3. La tabla se actualiza inmediatamente

**Columnas disponibles**:
- **ID**: Identificador único del producto
- **Título**: Nombre del producto
- **Descripción**: Descripción completa
- **Precio**: Precio del producto
- **Tipo**: Categoría (Nacional/Internacional)
- **Días/Noches**: Duración del tour
- **Estado**: Activo/Inactivo

**Casos de uso**:
- **Vista compacta**: Desactiva Descripción y Días/Noches
- **Revisión de precios**: Activa solo Título, Precio y Estado
- **Vista completa**: Activa todas las columnas

**Nota**: La columna de "Acciones" siempre está visible (Editar, Eliminar, Activar/Desactivar)

---

## Combinando Funcionalidades

Puedes usar múltiples funcionalidades juntas:

### Ejemplo 1: Buscar tours nacionales económicos
1. Filtrar por categoría: "Nacional"
2. Ordenar por: "Precio" (Ascendente)
3. Resultado: Tours nacionales ordenados del más barato al más caro

### Ejemplo 2: Revisar tours de playa recientes
1. Buscar: "playa"
2. Ordenar por: "Fecha de creación" (Descendente)
3. Resultado: Tours de playa más recientes primero

### Ejemplo 3: Actualización masiva de precios
1. Descargar plantilla CSV
2. Exportar productos existentes (nota: necesitarías crear esta funcionalidad)
3. Actualizar precios en el CSV
4. Importar el CSV con los IDs incluidos
5. Resultado: Precios actualizados en bloque

---

## Preguntas Frecuentes

**P: ¿Los filtros se mantienen al cambiar de página?**
R: Sí, los filtros se aplican a todas las páginas de resultados.

**P: ¿Puedo importar productos con imágenes?**
R: No, las imágenes deben subirse individualmente al crear/editar cada producto.

**P: ¿Qué pasa si importo un CSV con un ID que no existe?**
R: Se creará un nuevo producto ignorando el ID proporcionado.

**P: ¿El archivo CSV puede tener más o menos columnas?**
R: El CSV debe tener exactamente las columnas especificadas en la plantilla.

**P: ¿Puedo deshacer una importación?**
R: No hay función de deshacer. Se recomienda hacer respaldo antes de importaciones grandes.

---

## Solución de Problemas

### Error: "Número incorrecto de columnas"
- **Causa**: El CSV no tiene todas las columnas requeridas
- **Solución**: Usa la plantilla descargada y asegúrate de no eliminar columnas

### Error: "Error al importar el archivo"
- **Causa**: El archivo no es CSV o excede 10MB
- **Solución**: Verifica que el archivo sea .csv y menor a 10MB

### Los filtros no funcionan
- **Causa**: Problema de JavaScript o carga de página
- **Solución**: Recarga la página (F5)

### No veo algunos productos después de filtrar
- **Causa**: Los filtros están activos
- **Solución**: Limpia los filtros seleccionando "Todas las categorías" y borrando la búsqueda

---

## Consejos y Mejores Prácticas

1. **Respaldo antes de importar**: Siempre haz un respaldo de los productos antes de importar CSVs grandes
2. **Prueba con pocos productos**: Prueba importando 2-3 productos primero
3. **Usa filtros para verificar**: Después de importar, usa filtros para verificar que todo se importó correctamente
4. **Nombres descriptivos**: Usa nombres claros en los productos para facilitar la búsqueda
5. **Organización por categorías**: Mantén las categorías consistentes para facilitar el filtrado
