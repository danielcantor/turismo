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
                                {{descripcion}}
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-6 text-center order-1 order-xl-2">
                    </div>
                </div>
                                <div class="row text-center">
                    <div class="col-4 text-center">
                                    <a href=""><img style="width: 100%;" src="/img/home/aereoscompanies.jpg" alt=""></a>
                                    <p class="text-center" style="background-color: #2e005d; color: white;">Envíanos tu consulta haciendo click aquí...</p>
                                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-3">
            <div class="row justify-content-center align-items-center">
                    <h4 class=" col-12 text-center title-custom ps-3 lh-1"> 
                        <p class=' mb-0' style="font-family:cherolinaregular;font-size:3.9rem;">{{title}}</p> 
                        <p class="fw-bolder" style="font-family:poppins;font-size:3.5rem;">{{subtitle}}</p> 
                    </h4>
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
                imageUrl : window.imageUrl,
                title: window.title,
                subtitle: window.subtitle,
                descripcion: window.description,
            }
        },
        mounted() {
            
        }
        }
    </script>
    