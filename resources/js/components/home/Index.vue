<template>
    <section>
        <Slider :imageUrl="'/img/home/portada.png'"/>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12 mb-5">
                    <h4 class="text-center lh-1" style="color:#2e005d"> 
                        <p class="fw-bolder" style="font-family:poppins;font-size:3.3rem;">Destinos</p> 
                    </h4>
                </div>
                <div class="col-12 col-xl-3 col-md-4 text-center">
                    <a href="/destinos/escapada"><img src="/img/home/escapadas.jpg" class="p-3 border" alt=""></a>    
                </div>
                <div class="col-12 col-xl-3 col-md-4 text-center">
                    <a href="/destinos/nacional"><img src="/img/home/nacio.jpg" class="p-3 border" alt=""></a>   
                </div>
                <div class="col-12 col-xl-3 col-md-4 text-center">
                    <a href="/destinos/internacional"><img src="/img/home/inter.jpg" class="p-3 border" alt=""></a>  
                </div>
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-12 col-xl-3 col-md-4 text-center">
                    <a href="#" target="_blank"><img src="/img/home/micro.jpg" class="p-3 border" alt=""></a>    
                </div>
                <div class="col-12 col-xl-3 col-md-4 text-center">
                    <a href="/destinos/aereo"><img src="/img/home/aereos.jpg" class="p-3 border" alt=""></a>   
                </div>
                <div class="col-12 col-xl-3 col-md-4 text-center">
                    <a href="/destinos/finde"><img src="/img/home/findes.jpg" class="p-3 border" alt=""></a>   
                </div>
            </div>
        </div>
        <div class="py-5" style="background-color: #f6f6f6;">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-xl-6 order-2 order-xl-1">
                        <div class="mb-5">
                            <h4 class="text-left title-custom border-custom ps-3 lh-1"> 
                                <p class=' mb-0' style="font-family:cherolinaregular;font-size:3.9rem;">Sobre</p> 
                                <p class="fw-bolder" style="font-family:poppins;font-size:3.5rem;">Nosotros</p> 
                            </h4>
                            <p class="text-justify my-4" style="font-family:'Raleway', sans-serif;">
                                Somos a una empresa familiar y profesional dedicados a cumplir los sueños de nuestros pasajeros, en cada viaje brindamos una óptima calidad de servicio tratando de cumplir con las expectativas de cada uno de los que confía en nuestro trabajo.
                                Agradecemos infinitamente a quienes estuvieron a nuestro lado durante tantos años de trabajo, apoyándonos para que hoy en día podamos nosotros cumplir nuestro sueño!                            
                            </p>
                            <a href="#" class="btn btn-success btn-lg rounded-0 w-25 text-uppercase fw-bolder" style="background-color:rgb(150, 131, 236); font-family:'poppins';border-color:rgb(150, 131, 236);">Leer Más</a>
                        </div>
                    </div>
                    <div class="col-xl-6 text-center order-1 order-xl-2">
                        <img src="img/home/Sobre-nosotros.jpg" alt="" width="75%" class="shadow-image">
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12 mb-3">
                    <h4 class="text-center lh-1" style="color:#2e005d"> 
                        <p class="fw-bolder" style="font-family:poppins;font-size:3.3rem;">Promociones</p> 
                    </h4>
                    <div class="col-12 justify-content-center text-center">
                    <a href="https://wa.link/0qrx6o" target="_blank">
                        <img src="img/home/getnet3.jpg" alt="" width="25%" class="responsive-img">
                    </a>
                </div>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12 mb-3">
                    <h4 class="text-center lh-1" style="color:#2e005d"> 
                        <p class="fw-bolder" style="font-family:poppins;font-size:3.3rem;">Salidas</p> 
                    </h4>
                </div>

                <div v-if="!products.length" class="col-12 text-center py-5">
                        <i class="fa-solid fa-triangle-exclamation fa-3x mb-2"></i>
                        <h4 class="text-center">No hay productos en esta categoria</h4>
                </div>
                <div v-else class="col-12 text-center py-5">
                    <VueSlickCarousel v-bind="settings">
                        <Item v-for="(product, index) in products" :key="product.id" v-bind="product" />
                    </VueSlickCarousel>
                </div>
            </div>
        </div>
        <div>
          </div>
        <Slider :imageUrl="'/img/home/home-new.jpg'" :link="'/contacto'"/>

    </section>
</template>

<script>
    import VueSlickCarousel from 'vue-slick-carousel'
    import Item from '../main/Item.vue';
    import Slider from '../main/Slider.vue';
    import 'vue-slick-carousel/dist/vue-slick-carousel.css';
    import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css';
    import Swal from 'sweetalert2';
    export default {
        components: { VueSlickCarousel , Item , Slider },   
        data() {
            return {
                products: window.posts,
                settings: {
                    "dots": true,
                    "infinite": false,
                    "arrows": true,
                    "speed": 500,
                    "autoplay":true,
                    "slidesToShow": 4,
                    "slidesToScroll": 4,
                    "initialSlide": 0,
                    "responsive": [
                        {
                        "breakpoint": 800,
                        "settings": {
                            "slidesToShow": 2,
                            "slidesToScroll": 2,
                            "infinite": true,
                            "dots": true,
                            "autoplay":true,
                            "arrows": true
                        }
                        },
                        {
                        "breakpoint": 480,
                        "settings": {
                            "slidesToShow": 1,
                            "slidesToScroll": 1,
                            "infinite": true,
                            "autoplay":true,
                            "dots": true,
                            "arrows": true

                        }
                        }
                    ]
                    }
            }
        },
        methods: {},
        mounted() {
            
        }
    }
</script>
