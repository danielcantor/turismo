<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">
    <title>Detalle del Producto</title>
    <style>
        body {
            background-color: #9683ec;
            font-family: Arial, sans-serif;
            color: white;
        }

        .container_product {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #2e005d;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div id="app">
        <header-component></header-component>
        <div class="container-fluid">
            <div class="container-centered col-md-8 mx-auto" style="display: flex; margin-top: 10px; margin-bottom: 10px;">
                <div class="col-md-6" style="width: 50% ; height: 100%;">
                    <img src="{{ asset('storage/' . $product->product_image) }}" class="card-img-top" style="width: 100%; height: 100%;">
                </div>
                    <div class="col-md-6" style="margin-left: 5%">
                            <p class="fw-bolder" style="font-family: poppins; font-size: 3.5rem; color: coral;">{{ Str::ucfirst($product->product_name) }}</p>
                            <p class="text">Turismo Nacional</p>
                            <hr>
                        <div class="product_description">
                            <p class="text">{{ $product->product_description }}</p>
                        </div>
                        <div class="heading__share clearfix">
                            <div class="heading__share__item clearfix">
                              <a class="heading__share__item__link" href=""><i class="fas fa-share-alt"></i></a>
                              <a href="" target="_blank" class="heading__share__item__label">Compartir</a>
                              <div class="share_buttons">
                                <a href="#" class="lnkFB" rel="https://www.buenas-vibras.com.ar/San-Antonio-de-Areco-Dia-de-campo-ARE1009">
                                    <i class="fab fa-facebook-square"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                                <a rel="nofollow" href="https://api.whatsapp.com/send?text={{ Str::ucfirst($product->product_name) }} https://www.buenas-vibras.com.ar/San-Antonio-de-Areco-Dia-de-campo-ARE1009" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                    <span class="sr-only">Whatsapp</span>
                                </a>
                              </div>
                            </div>
                                          </div>
                        <hr>
                        <div class="product_price">
                            <p class="fw-bolder" style="font-family: poppins; font-size: 2.5rem; color: black;">ARS $ {{ $product->product_price }}</p> 
                        </div>
                    </div>
            </div>
        </div>
        <footer-component></footer-component>
    </div>
    

    <script>
        new Vue({
            el: '#app',
            data: {
                product: {}
            },
            created() {
                const productId = window.location.pathname.split('/').pop();
                axios.get(`/api/productos/info/${productId}`)
                    .then(response => {
                        this.product = response.data.product;
                    })
                    .catch(error => {
                        console.error('Error al obtener los datos del producto', error);
                    });
            }
        });
    </script>
    
    
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
