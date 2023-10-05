<template>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" v-if="link">
                <a :href="link">
                    <img :src="imageUrl"  class='d-block w-100' alt="">
                </a>
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
    