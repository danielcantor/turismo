<template>
  <nav class="navbar bg-light navbar-expand-xl py-4" style="background-color:#f6f6f6" id="navbar">
    <div class="container">
      <a class="navbar-brand w-25" href="#">
        <img src="img/logo.png" width="35%" alt="">
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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" :class="currentPage.indexOf('destinos') > -1 ? 'active' : ' '" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Destinos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/destinos/nacional">Turismo Nacional</a></li>
                <li><a class="dropdown-item" href="/destinos/inernacional">Turismo Internacional</a></li>
                <li><a class="dropdown-item" href="/destinos/escapada">Escapadas</a></li>
                <li><a class="dropdown-item" href="/destinos/aereo">Pasajes Aereos</a></li>
                <li><a class="dropdown-item" href="/destinos/finde">Findes largos</a></li>
              </ul>
            </li>
            <li class="nav-item mx-0 mx-xl-2">
                <a class="nav-link" href="#" target="_blank">Pasajes en Micro</a>
            </li>
            <li class="nav-item mx-0 mx-xl-2">
                <a class="nav-link" :class="currentPage == '/contacto' ? 'active' : ' '" href="/contacto" >Contacto</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>

export default {
  data() {
    return {
      currentPage: window.location.pathname
    };
  },
  mounted() {
    let scrollpos = window.scrollY
    
    const header = document.getElementById("navbar");
    const scrollChange = 240;

    const add_class_on_scroll = () => header.classList.add("sticky-top")
    const remove_class_on_scroll = () => header.classList.remove("sticky-top")

    window.addEventListener('scroll', function() { 
      scrollpos = window.scrollY;

      if (scrollpos >= scrollChange) { add_class_on_scroll() }
      else { remove_class_on_scroll() }
    });
  },
};
</script>
