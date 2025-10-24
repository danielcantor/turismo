require('./bootstrap');

import Vue from 'vue';
window.bootstrap = require('bootstrap');
import IndexComponent from './components/home/Index.vue';
import HeaderComponent from './components/main/Header.vue';
import FooterComponent from './components/main/Footer.vue';
import ProductoComponent from './components/productos/Producto.vue';
import LoginComponent from './components/users/Login.vue';
import TurismoComponent from './components/turismo/Index.vue';
import TurismoComponentAlt from './components/turismo/IndexAlt.vue';
import TurismoComponentAltmic from './components/turismo/IndexAltMic.vue';
import AboutComponent from './components/nosotros/Index.vue';
import RegisterComponent from './components/users/Register.vue';
import ItemComponent from './components/main/Item.vue';
import ContactoComponent from './components/contact/Index.vue';
import CheckoutComponent from './components/Checkout/Index.vue';
import responseContent from './components/payment/Index.vue';
import CondicionesComponent from './components/turismo/Condiciones.vue';
import ProductosComponent from "./components/productos/Productos.vue";
import Category from "./components/category/Index.vue";

Vue.component('index-component', IndexComponent);
Vue.component('header-component', HeaderComponent);
Vue.component('footer-component', FooterComponent);
Vue.component('producto-component', ProductoComponent);
Vue.component('productos-component', ProductosComponent);
Vue.component('login-component', LoginComponent);
Vue.component('register-component', RegisterComponent);
Vue.component('turismo-component', TurismoComponent);
Vue.component('turismo-component-alt', TurismoComponentAlt);
Vue.component('turismo-component-altmic', TurismoComponentAltmic);
Vue.component('about-component', AboutComponent);
Vue.component('item', ItemComponent);
Vue.component('checkout-component', CheckoutComponent);
Vue.component('contacto-component', ContactoComponent);
Vue.component('response-component', responseContent);
Vue.component('condiciones-component', CondicionesComponent);
Vue.component('category-component', Category);

const app = new Vue({
    el: '#app',
});
