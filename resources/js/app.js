require('./bootstrap');

import Vue from 'vue';

import IndexComponent from './components/home/Index.vue';
import HeaderComponent from './components/main/Header.vue';
import FooterComponent from './components/main/Footer.vue';
import ProductoComponent from './components/productos/Producto.vue';
import LoginComponent from './components/users/Login.vue';
import TurismoComponent from './components/turismo/Index.vue';
import TurismoComponentAlt from './components/turismo/IndexAlt.vue';
import AboutComponent from './components/nosotros/Index.vue';
import RegisterComponent from './components/users/Register.vue';
import ItemComponent from './components/main/Item.vue';
import ContactoComponent from './components/contact/Index.vue';
import CheckoutComponent from './components/checkout/Index.vue';
import responseContent from './components/payment/Index.vue';

Vue.component('index-component', IndexComponent);
Vue.component('header-component', HeaderComponent);
Vue.component('footer-component', FooterComponent);
Vue.component('producto-component', ProductoComponent);
Vue.component('login-component', LoginComponent);
Vue.component('register-component', RegisterComponent);
Vue.component('turismo-component', TurismoComponent);
Vue.component('turismo-component-alt', TurismoComponentAlt);
Vue.component('about-component', AboutComponent);
Vue.component('item', ItemComponent);
Vue.component('checkout-component', CheckoutComponent);
Vue.component('contacto-component', ContactoComponent);
Vue.component('response-component', responseContent);

const app = new Vue({
    el: '#app',
});
