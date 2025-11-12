<template>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" v-if="link">
                    <img :src="imageUrl"  class='d-block w-100' alt="" style="max-height: 461px;">
                    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="background-color:rgb(243, 91, 4, .8)">
                        <div class="text-center align-middle position-relative top-50 start-50 translate-middle">
                            <p class="text-white mb-3 text-slider" >Una experiencia inolvidable</p>
                            <p>
                                <a :href="link" class="text-white text-decoration-none border px-5 py-1 fw-bolder text-slider" >Contáctanos</a> 
                            </p>
                            <div class="container">
                                <div class="row justify-content-center align-middle">
                                    <div class="col-6">
                                        <p class="text-white text-slider-join mb-0">Siguenos en instagram</p>
                                        <a href="https://www.instagram.com/cynthiagarsketurismo/">
                                            <i class="fa-brands fa-instagram fa-3x" style="color: #8640bf;"></i>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-white  text-slider-join mb-0" >
                                            Unite a nuestro grupo
                                        </p>
                                        <a href="https://chat.whatsapp.com/KCGUvgi5vQvDo8bSjIvn4q">
                                            <i class="fa-brands fa-whatsapp fa-3x text-white rounded-circle" style="background-color: #25d366;"></i>
                                        </a>    
                                    </div>
                                </div>     
                            </div>
                           
                        </div>
                    </div>
            </div>
            <div class="carousel-item active" v-else>
                <img :src="imageUrl"  class='d-block w-100' alt="">
            </div>
        </div>
    </div>
</template>
    <style>
    .text-slider{
        font-size: 3.5rem;
        font-family: Raleway, sans-serif;
    }
    .text-slider-join{
        font-size: 2rem;
        font-family: Raleway, sans-serif;
    }
    @media only screen and (max-width: 600px) {
        .text-slider{
            font-size: 1.8rem !important;
        }
        .text-slider-join{
            font-size: 1.2rem !important;
        }
    }
    </style>
    <script>
        export default {
            props: {
                imageUrl: String,
                link: String
            },
            mounted() {
            }
        }
    </script>
    