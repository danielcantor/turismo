import Vue from 'vue';
import VueRouter from 'vue-router';

// Import components
import ProductDetail from '../components/productos/ProductDetail.vue';

Vue.use(VueRouter);

/**
 * Vue Router Configuration
 * 
 * Note: This router configuration is prepared for future full SPA migration.
 * It is not currently integrated into the main app.js but serves as a foundation
 * for when the application transitions to a complete SPA architecture.
 * 
 * To activate: Import this router in app.js and pass it to the Vue instance.
 */
const routes = [
  {
    path: '/productos/info/:id',
    name: 'product-detail',
    component: ProductDetail,
    props: (route) => ({
      productId: route.params.id
    })
  }
];

const router = new VueRouter({
  mode: 'history',
  base: '/',
  routes
});

export default router;
