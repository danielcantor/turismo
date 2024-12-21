<template>
    <section>
        <Slider :imageUrl="'/img/home/portada.png'"/>
        <div class="container my-5">
            <div class="col-12 mb-5">
            <h4 class="text-center lh-1" style="color:#2e005d"> 
                <p class="fw-bolder" style="font-family:poppins;font-size:3.3rem;">Destinos</p>
            </h4>
            </div>
            <!-- Recorremos el arreglo 'chunkedCategories' para crear filas de 3 categorías. -->
            <div
            v-for="(row, rowIndex) in chunkedCategories"
            :key="rowIndex"
            class="row justify-content-center mb-4"
            >
            <!-- Para cada fila, mostramos hasta 3 columnas. -->
            <div
                v-for="category in row"
                :key="category.id"
                class="col-12 col-md-4 text-center mb-3"
            >
                <a :href="'/destinos/' + category.slug">
                <img
                    :src="category.home_image"
                    class="p-3 border"
                    :alt="category.name"/>
                </a>
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
                categories: [],
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
        computed: {
            // Agrupa 'categories' en subarreglos de 3 elementos
            chunkedCategories() {
            const chunkSize = 3
            const chunked = []
            for (let i = 0; i < this.categories.length; i += chunkSize) {
                chunked.push(this.categories.slice(i, i + chunkSize))
            }
            return chunked
            }
        },
        methods: {
            fetchCategories() {
            axios.get('/api/categories')
                .then(response => {
                this.categories = response.data;
                });
            }
        },
        created() {
            this.fetchCategories();
        }
    }
</script>
