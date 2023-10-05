<template>
    <div>
        <hr class="my-4">
        <h4 class="mb-3">Datos del pasajero  {{qty}}</h4>
        <div class="row g-3">
            <div class="col-6">
                <label  class="form-label">Nombre</label>
                <input type="text" class="form-control" placeholder="" value="" required v-model="pasajero.nombre">
                <div class="invalid-feedback">
                    Se necesita el nombre.
                </div>
            </div>
            <div class="col-6">
                <label  class="form-label">Apellido</label>
                <input type="text" class="form-control"  placeholder="" value="" required v-model="pasajero.apellido">
                <div class="invalid-feedback">
                    Se necesita el apellido.
                </div>
            </div>
            <div class="col-6">
                <label for="address2" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="address2" placeholder="" required v-model="pasajero.nacimiento">
            </div>
            <div class="col-6">
                <label for="address2" class="form-label">Nacionalidad</label>
                <select name="" id="" class="form-select" v-model="pasajero.nacionalidad">
                    <option value="">Seleccione su nacionalidad</option>
                    <option value="1">Argentina</option>
                    <option value="2">Brasil</option>
                    <option value="3">Chile</option>
                    <option value="4">Uruguay</option>
                    <option value="5">Paraguay</option>
                </select>
            </div>
            <div class="col-6">
                <label for="address2" class="form-label">Documento</label>
                <input type="number" class="form-control" id="address2" placeholder="Ingrese su documento" v-model="pasajero.documento">
            </div>
            <div class="col-6">
                <label  class="form-label">Correo electronico</label>
                <input type="email" class="form-control"  placeholder="tu@ex.com" v-model="pasajero.email">
                <div class="invalid-feedback">
                    Por favor ingrese un correo electronico valido.
                </div>
            </div>
            <div class="col-6">
                <label  class="form-label">Celular</label>
                <input type="number" class="form-control"   v-model="pasajero.celular">
                <div class="invalid-feedback">
                    Por favor ingrese un correo electronico valido.
                </div>
            </div>
            <h4 class="mb-0">Contacto de emergencia</h4>
            <div class="col-6">
                <label  class="form-label">Nombre</label>
                <input type="text" class="form-control" placeholder="" value="" required v-model="pasajero.emergencia.nombre">
                <div class="invalid-feedback">
                    Se necesita el nombre.
                </div>
            </div>
            <div class="col-6">
                <label  class="form-label">Apellido</label>
                <input type="text" class="form-control"  placeholder="" value="" required v-model="pasajero.emergencia.nombre">
                <div class="invalid-feedback">
                    Se necesita el apellido.
                </div>
            </div>
            <div class="col-6">
                <label  class="form-label">Celular</label>
                <input type="number" class="form-control"  placeholder="" value="" required v-model="pasajero.emergencia.celular">
                <div class="invalid-feedback">
                    Se necesita el apellido.
                </div>
            </div>
            <h4 class="mb-0">Si tu reserva es con alojamiento, especifica tu Dieta </h4>
            <div class="col-6">
                <select name="" id="" class="form-select" pasajero.dieta.tipo>
                    <option value="">Sin especificar</option>
                    <option value="1">Vegetariano </option>
                    <option value="2">Celiaco </option>
                    <option value="3">Diabético </option>
                    <option value="4">Hipertenso</option>
                </select>
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