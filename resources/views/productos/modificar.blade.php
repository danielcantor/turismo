<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <header-component></header-component>
        <div class="container-fluid">
            <table id="productTable" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_description }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->product_type }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-btn" data-product-id="{{ $product->id }}" onclick="eliminarProducto({{ $product->id }})">Eliminar</button>
                                <button class="btn btn-sm btn-primary edit-btn" data-product-id="{{ $product->id }}">Modificar</button>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input activate-switch" data-product-id="{{ $product->id }}" {{ $product->product_activate ? 'checked' : '' }} >
                                    <label class="form-check-label" for="activate-switch">Activar/Desactivar</label>
                                </div>                                    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        function eliminarProducto(productId) {
            if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
                axios.delete(`/api/productos/${productId}`, {
                    headers: {
                        'Authorization': 'Bearer TOKEN A PENSAR'
                    }
                })
                    .then(response => {
                        alert('Producto eliminado correctamente');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    })
                    .catch(error => {
                        alert('Error al eliminar el producto:', error);
                    });
            }
        }
    </script>    
    <script>
        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
            $('#productTable').DataTable();

            $('input.activate-switch').on('click', function() {
                var productId = $(this).data('product-id');
                var isChecked = $(this).prop('checked');
                var confirmMessage = isChecked ? '¿Estás seguro de activar el producto?' : '¿Estás seguro de desactivar el producto?';

                if (confirm(confirmMessage)) {
                    var newStatus = isChecked ? 1 : 0;
                    axios.put(`/api/productos/${productId}/activar`, { product_activate: newStatus })
                        .then(response => {
                            alert('Estado del producto actualizado correctamente');
                        })
                        .catch(error => {
                            alert('Error al actualizar el estado del producto');
                            console.error(error);
                        });
                } else {
                    $(this).prop('checked', !isChecked);
                }
            });

            // Función para modificar un producto

            
        });
    </script>
</body>
</html>
