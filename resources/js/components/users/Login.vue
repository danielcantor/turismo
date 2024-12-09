<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
      <div class="card" style="width: 320px;">
        <div class="card-body">
          <h5 class="card-title">Iniciar sesión</h5>
          <form @submit.prevent="handleSubmit">
            <input type="hidden" name="_token" :value="csrfToken">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" v-model="email" required>
            </div>
            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control" id="password" v-model="password" required>
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="remember" v-model="rememberMe">
              <label class="form-check-label" for="remember">Recordar</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
            <div class="text-center mt-3">
              <small>¿No tienes una cuenta? <a href="#">Regístrate aquí</a></small>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  <script>
  import Swal from 'sweetalert2';

  export default {
    data() {
      return {
        email: '',
        password: '',
        csrfToken: '',
        rememberMe: false,
        flashMessage: '',
        flashMessageClass: ''
      };
    },
    created(){
      this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },
    methods: {
      handleSubmit() {
          const email = this.email;
          const password = this.password;

          fetch('/login', {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
              },
              body: JSON.stringify({
                  email: email,
                  password: password
              })
          })
          .then(response => response.json())
          .then(data => {
              if (data.message === 'success') {
                  window.location.href = '/category/list';
              } else {
                  alert('Error de inicio de sesión. Verifica tus credenciales.');
              }
          })
          .catch(error => {
              console.error('Error al iniciar sesión:', error);
          });
      }
  }
  };
  </script>
  
  <style scoped>
  body {
    background-color: #f0f4f8;
  }
  
  .card {
    background-color: #ffffff;
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  
  .card-title {
    color: #2e005d;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
  }
  
  .form-control {
    background-color: #f8fafc;
    border: 1px solid #cbd5e0;
    border-radius: 5px;
    color: #2e005d;
  }
  
  .btn-primary {
    background-color: #2e005d;
    border: none;
    border-radius: 5px;
    color: #ffffff;
    font-weight: bold;
  }
  
  .btn-primary:hover {
    background-color: #451b61;
  }
  
  .text-center {
    color: #8c91a1;
  }
  
  a {
    color: #2e005d;
    font-weight: bold;
    text-decoration: none;
  }
  
  a:hover {
    text-decoration: underline;
  }
  </style>
  
  