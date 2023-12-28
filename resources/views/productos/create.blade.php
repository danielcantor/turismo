<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
    <div id="app">
        <header-component></header-component>
        <div class="card col-md-10 mx-auto mt-5" style="padding: 15px">
            <h3 class="mx-auto mt-5">Crear nuevo producto:</h3>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="product_name">Título del producto:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>
            <br>
                <div class="form-group">
                    <label for="product_price">Precio del producto:</label>
                    <input type="number" class="form-control" id="product_price" name="product_price" required min="0">
                </div>
                <br>
                <div class="form-group">
                    <label for="product_description">Descripción del producto:</label>
                    <textarea class="form-control" id="product_description" name="product_description" rows="4" required></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="product_image">Imagen del producto:</label>
                    <input type="file" class="form-control-file" id="product_image" name="product_image">
                </div>
                <div class="form-group">
                    <label for="product_slider">Slider del producto:</label>
                    <input type="file" class="form-control-file" id="product_slider" name="product_slider">
                </div>
                <br>
                <div class="form-group">
                    <label for="product_type">Tipo de producto:</label>
                    <select class="form-control" id="product_type" name="product_type" required>
                        <option value="1">Verano</option>
                        <option value="2">Internacional</option>
                        <option value="3">Pasajes Aereos</option>
                        <option value="4">Escapadas</option>
                        <option value="5">Findes Largos</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_days">Dias:</label>
                    <select class="form-control" id="product_days" name="product_days" required>
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
                <div class="form-group">
                    <label for="product_nights">Noches:</label>
                    <select class="form-control" id="product_nights" name="product_nights" required>
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
                <br>
                <div class="buttons">
                    <button type="submit" class="btn btn-primary mx-auto">Guardar producto</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    
    <script>
        const app = new Vue({
    el: '#app',
    data() {
        return {
            productName: '',
            productPrice: '',
            productDescription: '',
            productType: '',
            productDays: '',
            productNights: '',
            productImage: null,
            productSlider: null,

        };
    },
    methods: {
        submitForm() {
            if (
                this.productName.trim() === '' ||
                this.productPrice.trim() === '' ||
                this.productDescription.trim() === '' ||
                this.productType.trim() === '' ||
                this.productImage === null ||
                this.productDays.trim() === '' ||
                this.productNights.trim() === '' ||
                this.productSlider === null

            ) {
                alert('Por favor completa todos los campos');
                return;
            }
            const formData = new FormData();
            formData.append('product_name', this.productName);
            formData.append('product_price', this.productPrice);
            formData.append('product_description', this.productDescription);
            formData.append('product_type', this.productType);
            formData.append('product_image', this.productImage);
            formData.append('product_slider', this.productSlider);
            formData.append('product_days', this.productDays);
            formData.append('product_nights', this.productNights);

            
            axios.post('/productos', formData)
                .then(response => {
                    alert('Producto guardado correctamente');
                    this.productName = '';
                    this.productPrice = '';
                    this.productDescription = '';
                    this.productType = '';
                    this.productImage = null;
                    this.productSlider = null;
                    this.productDays = '';
                    this.productNights = '';
                })
                .catch(error => {
                    alert('Error al guardar el producto');
                    console.error(error);
                });
        }
    }
});

    </script>
</body>
</html>