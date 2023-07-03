<template>
    <div class="register-form">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Registro</h2>
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" v-model="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" v-model="apellido" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" v-model="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" v-model="password" class="form-control">
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" v-model="confirmPassword" class="form-control">
          </div>
          <button type="button" @click="handleSubmit" class="btn btn-primary">Registrarse</button>
          <p class="text-center">Ya tenés una cuenta? <a href="/login">Iniciar Sesión</a></p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: '',
        apellido: '',
        email: '',
        password: '',
        confirmPassword: '',
      };
    },
    methods: {
      handleSubmit() {  

        if (this.password !== this.confirmPassword) {
          alert('Passwords do not match');
          return;
        }
  
        const registrationData = {
          name: this.name,
          apellido: this.apellido,
          email: this.email,
          password: this.password,
        };
  
        axios.post('/register', registrationData)
          .then(response => {
            if (response.data.message === 'Registration successful') {
              alert('Registration successful');
            } else {
              alert('Registration failed');
            }
          })
          .catch(error => {
            console.error(error);
          });
      },
    },
  };
  </script>
  
  <style scoped>
  body {
    background-color: #f0f4f8;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  
  .card {
    background-color: #ffffff;
    margin: 0 auto;
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 400px;
    padding: 20px;
  }
  
  .card-title {
    color: #2e005d;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-control {
    background-color: #f8fafc;
    border: 1px solid #cbd5e0;
    border-radius: 5px;
    color: #2e005d;
    padding: 10px;
    width: 100%;
  }
  
  .btn-primary {
    background-color: #2e005d;
    border: none;
    border-radius: 5px;
    color: #ffffff;
    font-weight: bold;
    padding: 10px;
    width: 100%;
  }
  
  .btn-primary:hover {
    background-color: #451b61;
  }
  
  .text-center {
    color: #8c91a1;
    font-size: 14px;
    margin-top: 20px;
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
  