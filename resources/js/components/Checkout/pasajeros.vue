<template>
    <div>
        <hr class="my-4">
        <h4 class="mb-3">Datos del pasajero  {{qty}}</h4>
        <div class="row g-3">
            <div class="col-sm-6">
                <label  class="form-label">Nombre</label>
                <input type="text" class="form-control" placeholder="" value="" required v-model="pasajero.nombre">
                <div class="invalid-feedback">
                    Se necesita el nombre.
                </div>
            </div>
        <div class="col-sm-6">
            <label  class="form-label">Apellido</label>
            <input type="text" class="form-control"  placeholder="" value="" required v-model="pasajero.apellido">
            <div class="invalid-feedback">
                Se necesita el apellido.
            </div>
        </div>
        <div class="col-6">
            <label  class="form-label">Correo electronico</label>
            <input type="email" class="form-control"  placeholder="you@example.com" v-model="pasajero.email">
            <div class="invalid-feedback">
                Por favor ingrese un correo electronico valido.
            </div>
        </div>
        <div class="col-6">
            <label class="form-label">Dirección</label>
            <input type="text" class="form-control"  placeholder="1234 Main St" required v-model="pasajero.direccion">
            <div class="invalid-feedback">
                Por favor ingrese su direccion.
            </div>
        </div>
        <div class="col-6">
            <label for="address2" class="form-label">Documento</label>
            <input type="number" class="form-control" id="address2" placeholder="Ingrese su documento" v-model="pasajero.documento">
            </div>
        </div>
    </div>
    </template>
    <script>
        export default {  
        props: ['pasajero' , 'qty'],
        mounted() {

        }
        }
    </script>