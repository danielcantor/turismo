<template>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img :src="imageUrl"  class='d-block w-100' alt="">
            </div>
        </div>
    </div>
</template>
    
    <script>
        export default {
            props: {
                imageUrl: String,
            },
            mounted() {
            }
        }
    </script>
    