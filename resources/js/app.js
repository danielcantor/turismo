require('./bootstrap');

import Vue from 'vue';

import IndexComponent from './components/home/Index.vue';
import HeaderComponent from './components/main/Header.vue';
import FooterComponent from './components/main/Footer.vue';
import ProductoComponent from './components/productos/Producto.vue';
import LoginComponent from './components/users/Login.vue';
import RegisterComponent from './components/users/Register.vue';
import ItemComponent from './components/main/Item.vue';
Vue.component('index-component', IndexComponent);
Vue.component('header-component', HeaderComponent);
Vue.component('footer-component', FooterComponent);
Vue.component('producto-component', ProductoComponent);
Vue.component('login-component', LoginComponent);
Vue.component('register-component', RegisterComponent);
Vue.component('item-component', ItemComponent);
const app = new Vue({
    el: '#app',
});
