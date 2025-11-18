<template>
  <nav class="navbar bg-light navbar-expand-xl" style="background-color:#f6f6f6" id="navbar">
    <div class="container">
      <a class="navbar-brand w-25" href="/">
        <img src="/img/logo.png" width="35%" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Salidas grupales</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1">
            <li class="nav-item mx-0 mx-xl-2">
                <a class="nav-link" :class="currentPage == '/' ? 'active' : ' '" aria-current="page" href="/">Inicio</a>
            </li>
            <li class="nav-item mx-0 mx-xl-2">
                <a class="nav-link" :class="currentPage == '/nosotros' ? 'active' : ' '" href="/nosotros">Nosotros</a>
            </li>
            <li class="nav-item dropdown" v-if="categories.length">
              <a class="nav-link dropdown-toggle" :class="currentPage.indexOf('destinos') > -1 ? 'active' : ' '" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Destinos
              </a>
              <ul class="dropdown-menu">
                <li v-for="category in categories" :key="category.id">
                  <a class="dropdown-item" :href="'/destinos/' + category.slug">{{ category.name }}</a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown" v-if="isAdmin">
              <a class="nav-link dropdown-toggle" :class="currentPage == '/category/list' || currentPage ==  '/products/list'  ? 'active' : ' '" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Administración
              </a>
              <ul class="dropdown-menu">
                <li class="nav-item mx-0 mx-xl-2" >
                    <a class="nav-link"  href="/category/list">Categorias</a>
                </li>
                <li class="nav-item mx-0 mx-xl-2" >
                    <a class="nav-link"  href="/products/list">Productos</a>
                </li>
            </ul>
            </li>
            <li class="nav-item mx-0 mx-xl-2">
                <a class="nav-link" :class="currentPage == '/contacto' ? 'active' : ' '" href="/contacto">Contacto</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      currentPage: window.location.pathname,
      isAdmin: false
    };
  },
  computed: {
    // reactive, provisto por app.js
    categories() {
      return this.$categories.list;
    }
  },
  created() {
    // ya no fetchCategories(), solo comprobar admin
    this.checkAdminStatus();
  },
  methods: {
    checkAdminStatus() {
      axios.get('/admin/status')
        .then(response => {
          this.isAdmin = response.data.authenticated;
        })
        .catch(() => { this.isAdmin = false; });
    }
  }
};
</script>

<style scoped>
.navbar-nav .nav-link.active {
  font-weight: bold;
}
</style>