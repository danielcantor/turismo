require('./bootstrap');

import Vue from 'vue';

import IndexComponent from './components/home/Index.vue';
import HeaderComponent from './components/main/Header.vue';
import FooterComponent from './components/main/Footer.vue';
import ProductoComponent from './components/productos/Producto.vue';
import LoginComponent from './components/users/Login.vue';

Vue.component('index-component', IndexComponent);
Vue.component('header-component', HeaderComponent);
Vue.component('footer-component', FooterComponent);
Vue.component('producto-component', ProductoComponent);
Vue.component('login-component', LoginComponent);

const app = new Vue({
    el: '#app',
});
