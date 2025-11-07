import Vue from 'vue';
import VueRouter from 'vue-router';

// Import components
import ProductDetail from '../components/productos/ProductDetail.vue';

Vue.use(VueRouter);

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
