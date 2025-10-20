<template>
  <section>
    <Slider :imageUrl="imageUrl"/>
    <div class="py-5 bg-light-custom">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-xl-6 order-2 order-xl-1">
            <div class="mb-5">
              <h4 class="text-left title-custom border-custom ps-3 lh-1">
                <p class="mb-0 font-cherolina-large">Vive una gran</p>
                <p class="fw-bolder font-poppins-large">Experiencia</p>
              </h4>
              <p class="text-justify my-4 font-raleway">
                {{ description }}
              </p>
            </div>
          </div>
          <div class="col-xl-6 text-center order-1 order-xl-2">
          </div>
        </div>
      </div>
    </div>

    <div class="container py-3">
      <div class="row justify-content-center align-items-center">
        <h4 class="col-12 text-center title-custom ps-3 lh-1">
          <p class="mb-0 font-cherolina-large">{{ title }}</p>
          <p class="fw-bolder font-poppins-large">{{ subtitle }}</p>
        </h4>

        <div v-if="!posts.length" class="col-12 text-center py-5">
          <i class="fa-solid fa-triangle-exclamation fa-3x mb-2"></i>
          <h4 class="text-center">No hay productos en esta categoria</h4>
        </div>

        <Item v-for="product in posts" :key="product.id" v-bind="product" />
      </div>
    </div>
  </section>
</template>

<script>
import Slider from '../main/Slider.vue';
import Item from '../main/Item.vue';

export default {
  name: 'TurismoIndexAlt',
  components: { Slider, Item },
  props: {
    posts: { type: Array, default: () => [] },
    imageUrl: { type: String, default: '' },
    title: { type: String, default: '' },
    subtitle: { type: String, default: '' },
    description: { type: String, default: '' }
  }
};
</script>

<style scoped>
/* estilos mínimos si se necesita override local */
</style>
