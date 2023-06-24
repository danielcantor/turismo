<template>
    <div class="col-3 p-3">
      <div class="card rounded-0">
        <img src="img/home/ninos.png" class="px-3 pt-3 rounded-0" alt="...">
        <div class="card-body p-0">
          <h5 class="text-center p-3 text-light fs-6 position-absolute top-50 start-50 translate-middle w-75" style="background-color:rgb(150, 131, 236); font-family:'poppins';border-color:rgb(150, 131, 236);">
            {{ product.product_name }}
          </h5>
          <p class="text-center mt-5 lh-1 mx-5 fs-1 " style="border:1px solid #f18701; border-top:0; border-right:0; border-left:0;  ">
            <span class="text-uppercase" style="font-family:'Raleway', sans-serif;color:#2e005d;">Desde</span>
            <span class="fw-bolder text-uppercase" style="font-family:'poppins';color:#f18701">{{ product.product_price }}</span>
          </p>
          <p class="text-center">
            <span class="fs-6" style="font-family:'Raleway', sans-serif;color:#2e005d;">
              <img src="/img/icons/calendario.svg" width="5%"> 8 días, 7 noches
            </span>
          </p>
          <div class="card-footer text-center border-top-0">
            <a href="#" class="btn btn-primary rounded-0 fw-bolder w-75" style="background-color: #2e005d; font-family: poppins; border-color: #2e005d;">
              <img :src="product.image" width="10%"> VER PROGRAMA
            </a>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      product: {
        type: Object,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos CSS específicos del componente aquí */
  </style>
  