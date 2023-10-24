<template>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" v-if="link">
                    <img :src="imageUrl"  class='d-block w-100' alt="" style="max-height: 461px;">
                    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="background-color:rgb(243, 91, 4, .8)">
                        <div class="text-center align-middle position-relative top-50 start-50 translate-middle">
                            <p class="text-white mb-3" style="font-family: Raleway, sans-serif; font-size: 3.5rem !important; ">Una experiencia inolvidable</p>
                            <p>
                                <a :href="link" class="text-white text-decoration-none border px-5 py-1 fw-bolder" style="font-family: Raleway, sans-serif; font-size: 3.5rem !important; ">Contáctanos</a> 
                            </p>
                            <p class="">
                                <a href="https://www.instagram.com/salidasgrupalescyn">
                                    <i class="fa-brands fa-instagram fa-4x" style="color: #8640bf;"></i>
                                </a>
                                <a href="https://chat.whatsapp.com/KCGUvgi5vQvDo8bSjIvn4q" class="mx-3">
                                    <i class="fa-brands fa-whatsapp fa-4x text-success"></i>
                                </a>
                            </p>
                        </div>
                    </div>
            </div>
            <div class="carousel-item active" v-else>
                <img :src="imageUrl"  class='d-block w-100' alt="">
            </div>
        </div>
    </div>
</template>
    
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
    