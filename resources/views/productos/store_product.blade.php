<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ url('/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
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
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/storage/{{ $product->product_image }}"  class='d-block w-100 h-25' alt="">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 " style="margin-top: 30px; margin-bottom: 30px;">
                        <div class="row mx-auto">
                        <div class="title">
                            <h5 class='fw-bold'>{{ $product->product_name }}</h5>
                        </div>
                        <div class="share">
                            <div class="heading__share__item clearfix">
                                <a class="heading__share__item__link" href=""><i class="fas fa-share-alt"></i></a>
                                <a href="" target="_blank" class="heading__share__item__label">Compartir</a>
                                <div class="share_buttons">
                                </div>
                            </div>
                        </div>
                    <hr>
                        <div class="description">
                            <p>{{ $product->product_description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 card" style="background-color: rgba(255, 127, 80, 0.521); margin-top: 30px; margin-bottom: 30px;">
                    <img class="w-100" src="/storage/{{ $product->product_image }}">
                    <div class="card-body">
                        <div class="price text-light text-decoration-none">
                            <p>$ {{$product->product_price}}</p>
                        </div>
                        <hr>
                        <button class="btn btn-success" style="border-radius: 10px; width: 100%; height: 20%; font-family: fantasy;">AGREGAR</button>
                        <div id="wallet_container"></div>
                        <hr>
                        <div class="contacto text-center">
                            <p>¿Tenés alguna consulta?</p>
                            <p href="" style="cursor: pointer"><i class="fa-brands fa-whatsapp"></i> Whatsapp</p>
                            <p href="" style="cursor: pointer"><i class="fa fa-envelope" aria-hidden="true"></i> Email</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer-component></footer-component>
    </div>
    
    <script src="{{ mix('js/app.js') }}"></script>   

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago('TEST-b970a885-b574-4d94-b036-3d9f659d7a44');
        const bricksBuilder = mp.bricks();
        mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "{{ $preference->id }}",
        },
        });

    </script>

</body>
</html>
