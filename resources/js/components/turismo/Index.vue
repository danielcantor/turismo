<template>
    <section>
        <Slider :imageUrl="imageUrl"/>
        <div class="py-5" style="background-color: #f6f6f6;">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-xl-6 order-2 order-xl-1">
                        <div class="mb-5">
                            <h4 class="text-left title-custom border-custom ps-3 lh-1"> 
                                <p class=' mb-0' style="font-family:cherolinaregular;font-size:3.9rem;">Vive una gran</p> 
                                <p class="fw-bolder" style="font-family:poppins;font-size:3.5rem;">Experiencia</p> 
                            </h4>
                            <p class="text-justify my-4" style="font-family:'Raleway', sans-serif;">
                                Somos a una empresa familiar y profesional dedicados a cumplir los sueños de nuestros pasajeros, en cada viaje brindamos una óptima calidad de servicio tratando de cumplir con las expectativas de cada uno de los que confía en nuestro trabajo.
                                Agradecemos infinitamente a quienes estuvieron a nuestro lado durante tantos años de trabajo, apoyándonos para que hoy en día podamos nosotros cumplir nuestro sueño!                            
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-6 text-center order-1 order-xl-2">
                        <img src="img/home/Sobre-nosotros.jpg" alt="" width="75%" class="shadow-image">
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
    
    <script>
    import Slider from '../main/Slider.vue';
    import Item from '../main/Item.vue';
    export default {      
        components: { Slider , Item},  
        data(){
            return {
                products: window.posts,
                imageUrl : window.imageUrl
            }
        },
        mounted() {
            
        }
        }
    </script>
    