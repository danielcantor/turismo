<template>
    <div>
        <hr class="my-4">
        <h4 class="mb-3">Informacion del pasajero  {{qty}}</h4>
        <div class="row g-3">
            <div class="col-6">
                <label  class="form-label">Nombre</label>
                <input type="text" class="form-control" placeholder="" value="" required v-model="pasajero.nombre" :class="[ errors.nombre ? 'is-invalid' : '']">
                <div class="invalid-feedback">
                    Se necesita el nombre.
                </div>
            </div>
            <div class="col-6">
                <label  class="form-label">Apellido</label>
                <input type="text" class="form-control"  placeholder="" value="" required v-model="pasajero.apellido" :class="[ errors.apellido ? 'is-invalid' : '']">
                <div class="invalid-feedback">
                    Se necesita el apellido.
                </div>
            </div>
            <div class="col-6">
                <label for="address2" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="address2" placeholder="" required v-model="pasajero.nacimiento" :class="[ errors.nacimiento ? 'is-invalid' : '']">
                <div class="invalid-feedback">
                    Por favor ingrese una fecha de nacimiento valida.
                </div>    
            </div>
            <div class="col-6">
                <label for="address2" class="form-label">Nacionalidad</label>
                <select name="" id="" class="form-select" v-model="pasajero.nacionalidad" :class="[ errors.nacionalidad ? 'is-invalid' : '']">
                    <option value="">Seleccione su nacionalidad</option>
                    <option value="1">Argentina</option>
                    <option value="2">Brasil</option>
                    <option value="3">Chile</option>
                    <option value="4">Uruguay</option>
                    <option value="5">Paraguay</option>
                </select>
                <div class="invalid-feedback">
                    Por favor ingrese una nacionalidad valida.
                </div>
            </div>
            <div class="col-6">
                <label for="address2" class="form-label">Documento</label>
                <input type="number" class="form-control" id="address2" placeholder="Ingrese su documento" v-model="pasajero.documento" :class="[ errors.documento ? 'is-invalid' : '']">
                <div class="invalid-feedback">
                    Por favor ingrese un documento valido.
                </div>
            </div>
            <div class="col-6">
                <label  class="form-label">Correo electronico</label>
                <input type="email" class="form-control"  placeholder="tu@ex.com" v-model="pasajero.email" :class="[ errors.email ? 'is-invalid' : '']">
                <div class="invalid-feedback">
                    Por favor ingrese un correo electronico valido.
                </div>
            </div>
            <div class="col-6">
                <label  class="form-label">Celular</label>
                <input type="number" class="form-control"   v-model="pasajero.celular" :class="[ errors.celular ? 'is-invalid' : '']">
                <div class="invalid-feedback">
                    Por favor ingrese un celular.
                </div>
            </div>
            <h4 class="mb-0">Si tu reserva es con alojamiento, especifica tu Dieta </h4>
            <div class="col-6">
                <select name="" id="" class="form-select"  v-model="pasajero.dieta.tipo">
                    <option value="0" selected>Sin especificar</option>
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
        data: function() {
            return {
                errors : {
                        nombre: false,
                        apellido: false,
                        nacimiento: false,
                        nacionalidad: false,
                        documento: false,
                        email: false,
                        celular: false
                    } 
                
            }
        },
        methods:{
            resetErrors(){
                this.errors = {
                        nombre: false,
                        apellido: false,
                        nacimiento: false,
                        nacionalidad: false,
                        documento: false,
                        email: false,
                        celular: false
                    }
            },
            CheckPropData(){
                this.resetErrors();
                let count = 0;
                let keys = Object.keys(this.errors);
                for(let i=0; i< keys.length; i++){
                let key = keys[i];
                if (typeof this.pasajero[key] === 'object') {
                    let keys2 = Object.keys(this.pasajero[key]);
                    for(let i=0; i< keys.length; i++){
                        let key2 = keys2[i];
                        if(this.pasajero[key][key2] === '') {
                            this.errors[key][key2] = true;
                            count++;
                        }
                    }
                }else{
                    if(this.pasajero[key] === '') {
                        this.errors[key] = true;
                        count++;
                    }
                }
                }
                if(count > 0) {
                    this.$emit('error', true);
                }else{
                    this.$emit('error', false);
                }
            }
        },
        mounted() {
            
        }
        }
    </script>