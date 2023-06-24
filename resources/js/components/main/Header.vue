<template>
  <nav class="navbar bg-light navbar-expand-xl sticky-top py-4" style="background-color:#f6f6f6">
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
              <a class="nav-link active" aria-current="page" href="/">Inicio</a>
            </li>
            <li class="nav-item mx-0 mx-xl-2">
              <a class="nav-link" href="#">Nosotros</a>
            </li>
            <li class="nav-item mx-0 mx-xl-2">
              <a class="nav-link" :href="'/productos?type=nacional'">Turismo Nacional</a>
            </li>
            <li class="nav-item mx-0 mx-xl-2">
              <a class="nav-link" :href="'/productos?type=internacional'">Turismo Internacional</a>
            </li>
            <li class="nav-item mx-0 mx-xl-2">
              <a class="nav-link" href="#">Contacto</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  mounted() {},
};
</script>
