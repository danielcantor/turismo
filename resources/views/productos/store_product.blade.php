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
    <link href="https://fonts.cdnfonts.com/css/rift-soft-2" rel="stylesheet">
    <link rel="manifest" href="{{ url('/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <title>Detalle del Producto</title>
    <style>
        body {
            background-color: #2e005d;
            font-family: "Helvetica Neue", sans-serif;
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
        .textos-i, .titulo_producto {
            font-family: "Rift Soft", sans-serif;
        }
        a.btn-pink:visited{
            color: black;
        }
    </style>
</head>
<body>
    <div id="app">
        <header-component></header-component>
        @if ($product->product_slider)
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/storage/{{ $product->product_slider }}" class='d-block w-100' alt="">
                    </div>
                </div>
            </div>    
        @endif        
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12 titulo_producto">
                            <h1 class="fw-bold">{{ $product->product_name }}</h1>
                        </div>
                        <div class="col-12">
                            <div class="shareytxt">
                                <div class="heading__share__item clearfix titulo_producto col-5" style="display: flex; flex-wrap:wrap;">
                                    <a class="heading__share__item__link" href=""></a>
                                    <a href="whatsapp://send?text=Te comparto la información sobre este viaje! <?=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>" target="_blank" class="heading__share__item__label"><h5><i class="fas fa-share-alt"></i> Compartir</h5></a>
                                </div>
                                <div class="col-5 titulo_producto">
                                    <modal-example></modal-example>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                            <p style="font-family: poppins;">{!! nl2br(e($product->product_description)) !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" style="background-color: #9683ec; border: none;">
                        <div class="card-body">
                            <img src="/storage/{{ $product->product_image }}" alt="Producto" class="w-100 img-fluid" style="max-width: 100%; border-radius: 10px;">
                            <hr>
                            <p class="text-center fw-bolder" style="font-size: 24px;">$ {{ $product->product_price }}</p>
                            <div class="text-center">
                                <a href="/checkout/{{$product->id}}" class="btn btn-success btn-block w-50 fw-bold" style="border-color: black; background-color:#2e005d;font-family: Arial, sans-serif; font-size: 18px;">RESERVAR AHORA</a>
                            </div>
                            <hr>
                            <div class="text-center">
                                <p class="fw-bold" style="font-size: 18px;">¿Tenés alguna consulta?</p>
                                <a href="https://wa.me/message/SCBMQYYYMSHRM1" target="_blank" class="text-decoration-none" style="font-size: 18px;"><i class="fab fa-whatsapp"></i> Contactar por WhatsApp</a><br>
                                <a href="mailto:cynthiaedithgarske@gmail.com" target="_blank" class="text-decoration-none" style="font-size: 18px;"><i class="fas fa-envelope"></i> Enviar un Email</a>
                            </div>
                        </div>
                    </div>
                </div>             
            </div>
        </div>
        <br>
        <hr>
        <section class="bg-light py-4">
            <div class="container textos-i">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text">
                        <h3 class="m-0" style="color:#2e005d">¿Querés seguir viendo nuestros viajes?</h3>
                        <h3 class="m-0" style="color: #f18701">¡ Ingresá a nuestro Instagram para mantenerte actualizado con las últimas novedades !</h3>
                    </div>
                    <div class="group-button" style="display: flex; align-items: center;">
                        <i class="fa-brands fa-instagram" style="color: black; font-size: xx-large"></i>
                        <a href="https://www.instagram.com/salidasgrupalescyn/" target="_blank" class="btn btn-pink"><h3 class="m-0">Instagram</h3></a>
                    </div>
                </div>
            </div>
        </section>
         
        <hr>

        <footer-component></footer-component>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="{{ mix('js/app.js') }}"></script>   
    <script>
        Vue.component('modal-example', {
            data() {
                return {
                    showModal: false,
                };
            },
            methods: {
                openModal() {
                    this.showModal = true;
                },
                closeModal() {
                    this.showModal = false;
                },
            },
            template: `
            <button class="btn btn-primary" @click="openModal">CONDICIONES GENERALES</button>
                <div class="modal" tabindex="-1" role="dialog" :class="{ 'show': showModal }">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Imagen</h5>
                            <button type="button" class="close" @click="openModal">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="/img/home/condicionesgenerales.jpeg" alt="Imagen Modal">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="closeModal">Cerrar</button>
                        </div>
                        </div>
                    </div>
                </div>`
        });

        new Vue({
            el: '#app',
        });
    </script>
</body>
</html>