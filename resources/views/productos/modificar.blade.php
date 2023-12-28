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
        <div class="container">
            <div class="col-md-12">
                <h1>Productos</h1>
                <a href="{{ route('productos.create') }}" class="btn btn-primary mb-2">Crear Producto</a>
            </div>
            <div class="col-md-12">
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
                            <td>@switch($product->product_type)
                                @case(1)
                                    Verano
                                    @break

                                @case(2)
                                    Internacional
                                    @break
                                
                                @case(3)
                                    Aereos
                                    @break
                                    
                                @case(4)
                                    Escapadas
                                    @break
                                    
                                @case(5)
                                    Finde largo
                                    @break
                            @endswitch
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-btn" data-product-id="{{ $product->id }}" onclick="eliminarProducto({{ $product->id }})">Eliminar</button>
                                <button class="btn btn-sm btn-primary edit-btn" data-product-id="{{ $product->id }}"  onclick="modificarProducto({{ $product->id }})">Modificar</button>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input activate-switch" data-product-id="{{ $product->id }}" onclick="activarDesactivarProducto({{ $product->id }}, event)" {{ ($product->product_activate == 1) ? 'checked' : '' }} >
                                    <label class="form-check-label" for="activate-switch">Activar/Desactivar</label>
                                </div>                                    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <footer-component></footer-component>
    </div>
    <div class="modal fade" id="modificarProductoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="color: #2e005d;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioModificarProducto">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select class="form-select" id="tipo" name="tipo">
                                <option value="1">Verano</option>
                                <option value="2">Internacional</option>
                                <option value="3">Pasajes Aereos</option>
                                <option value="4">Escapadas</option>
                                <option value="5">Findes Largos</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="product_image">Imagen del producto:</label>
                            <input type="file" class="form-control-file" id="product_image" name="product_image">
                        </div>
                        <div class="mb-3">
                            <label for="product_slider">Slider del producto:</label>
                            <input type="file" class="form-control-file" id="product_slider" name="product_slider">
                        </div>
                        <div class="mb-3">
                            <label for="days">Dias:</label>
                            <select class="form-control" id="days" name="days" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nights">Noches:</label>
                            <select class="form-control" id="nights" name="nights" required>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        function eliminarProducto(productId) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch(`/deleteProducto/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error('Error al eliminar el producto:', error);
                });
            }
        }

        let productoId = null;
        
        function modificarProducto(id) {
            productoId = id;
            fetch(`/obtenerProducto/${productoId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('titulo').value = data.product_name;
                    document.getElementById('descripcion').value = data.product_description;
                    document.getElementById('tipo').value = data.product_type;
                    document.getElementById('precio').value = data.product_price;
                    document.getElementById('days').value = data.days;
                    document.getElementById('nights').value = data.nights;
                    $('#modificarProductoModal').modal('show');
                })
                .catch(error => {
                    console.error('Error al obtener los datos del producto:', error);
                });
        }

        function guardarCambios() {
            if(productoId == null){
                alert('Error en el ID de producto.')
            }else{
                const formData = new FormData(document.getElementById('formularioModificarProducto'));
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch(`/modificarProducto/${productoId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    $('#modificarProductoModal').modal('hide');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error al guardar cambios:', error);
                });
            }
        }

        function activarDesactivarProducto(productoId, event) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/activarDesactivarProducto/${productoId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                console.log(event.target);
            })
            .catch(error => {
                console.error('Error al activar/desactivar el producto:', error);
            });
        }


    </script>    
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();
        });
    </script>
</body>
</html>
