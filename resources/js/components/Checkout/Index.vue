<template>

<section class="pt-5">
<div class="offcanvas offcanvas-end show d-none d-md-flex" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Tu compra</h5>
    </div>
    <div class="offcanvas-body">
      <div class="order-md-last">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-center lh-sm">
              <div>
                <h6 class="my-0">{{product.product_name}}</h6>
                <small class="text-muted">{{product.product_description}}</small>
              </div>
              <strong>${{product.product_price}}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Cantidad</span>
              <strong>{{quantity}}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (ARS)</span>
              <strong>${{cart.total}}</strong>
            </li>
          </ul>
    </div>
  </div>
</div>
<div class="container">
  <main>
    <div class="row g-5 pb-3">
      <div class="col-md-5 col-lg-4 order-md-last d-md-none">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Tu compra</span>
          <span class="badge bg-primary rounded-pill">{{quantity}}</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between align-items-center lh-sm">
            <div>
              <h6 class="my-0">{{product.product_name}}</h6>
              <small class="text-muted">{{product.product_description}}</small>
            </div>
            <strong>${{product.product_price}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (ARS)</span>
            <strong>${{cart.total}}</strong>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8" v-show="cart.step === 1">
        <h4 class="mb-3">Informacion de cliente</h4>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="" required v-model="cart.data.nombre" :class="[ cart.errors.nombre ? 'is-invalid' : '']">
              <div class="invalid-feedback">
                Se necesita el nombre.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Apellido</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="" required v-model="cart.data.apellido" :class="[ cart.errors.apellido ? 'is-invalid' : '']">
              <div class="invalid-feedback">
                Se necesita el apellido.
              </div>
            </div>

            <div class="col-6">
              <label for="email" class="form-label">Correo electronico</label>
              <input type="email" class="form-control" id="email" placeholder="ejemplo@ex.com" v-model="cart.data.email" :class="[ cart.errors.email ? 'is-invalid' : '']">
              <div class="invalid-feedback">
                Por favor ingrese un correo electronico valido.
              </div>
            </div>

            <div class="col-6">
              <label for="address" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="address" placeholder="Av de Mayo 100" required v-model="cart.data.direccion" :class="[ cart.errors.direccion ? 'is-invalid' : '']"> 
              <div class="invalid-feedback">
                Por favor ingrese su direccion.
              </div>
            </div>

            <div class="col-6">
              <label for="address2" class="form-label">Dirección 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="Numero de departemento" v-model="cart.data.direccion2">
            </div>


            <div class="col-md-6">
              <label for="state" class="form-label">Provincia</label>
              <select class="form-select" id="state" required v-model.number="cart.data.provincia" :class="[ cart.errors.provincia ? 'is-invalid' : '']">
                <option value="1">BUENOS AIRES</option>
                <option value="2">CATAMARCA</option>
                <option value="5">CHACO</option>
                <option value="6">CHUBUT</option>
                <option value="50">CIUDAD AUTONOMA DE Bs As</option>
                <option value="3">CORDOBA</option>
                <option value="4">CORRIENTES</option>
                <option value="7">ENTRE RIOS</option>
                <option value="8">FORMOSA</option>
                <option value="9">JUJUY</option>
                <option value="10">LA PAMPA</option>
                <option value="11">LA RIOJA</option>
                <option value="12">MENDOZA</option>
                <option value="13">MISIONES</option>
                <option value="14">NEUQUEN</option>
                <option value="15">RIO NEGRO</option>
                <option value="16">SALTA</option>
                <option value="17">SAN LUIS</option>
                <option value="19">SANTA CRUZ</option>
                <option value="20">SANTA FE</option>
                <option value="21">SANTIAGO DEL ESTERO</option>
                <option value="22">TIERRA DEL FUEGO</option>
                <option disabled="true" selected="true" value="">Selecciona</option>              
              </select>
              <div class="invalid-feedback">
                Por favor seleccione una provincia.
              </div>
            </div>
            <div class="col-6">
              <label for="email" class="form-label">Documento</label>
              <input type="number" class="form-control" id="email" placeholder="34556" v-model="cart.data.documento" :class="[ cart.errors.documento ? 'is-invalid' : '']">
              <div class="invalid-feedback">
                Por favor ingrese un nro de documento electronico valido.
              </div>
            </div>
            <div class="col-md-3">
              <label for="zip" class="form-label">Codigo Postal</label>
              <input type="text" class="form-control" id="zip" placeholder="" required v-model="cart.data.codigo_postal" :class="[ cart.errors.codigo_postal ? 'is-invalid' : '']">
              <div class="invalid-feedback">
                Se necesita el codigo postal.
              </div>
            </div>
          </div>
          <hr class="my-4">

          <h4 class="mb-3">Pasajeros</h4>
          <div class="row g-3">
            <div class="col-12">
            <label for="state" class="form-label">Cantidad</label>
              <select class="form-select" id="state" required v-model.number="quantity">
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                <option value=6>6</option>
                <option value=7>7</option>
                <option value=8>8</option>
                <option value=9>9</option>
                <option value=10>10</option>
                <option disabled="true" selected="true" value="">Selecciona</option>              
              </select>
            </div>
          </div>
          
          <div v-for="(qty, index) in quantity" :key="index" >
            <pasajeros :pasajero="pasajeros[index]" :qty="qty"></pasajeros>
          </div>
          <!--<hr class="my-4">

          <h4 class="mb-3">Metodo de pago</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Mercado pago</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Transferencia Bancaria</label>
            </div>
          </div> -->

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" @click="step2">Continuar</button>
      </div>
      <div class="col-md-7 col-lg-8" v-show="cart.step === 2">
        <h4 class="mb-3">Confirmacion</h4>
        <div id="wallet_container"></div>
        <button class="w-100 btn btn-primary btn-lg" @click="step1">Volver</button>

      </div>
    </div>
  </main>
</div>
</section>
</template>
<script>
    import axios from 'axios';
    import Pasajeros from './pasajeros.vue';
    export default {  
      components: { Pasajeros },
      props: ['product'],
        data() {
            return {
                cart: {
                  step : 1,
                  data: {
                    nombre: '',
                    apellido: '',
                    email: '',
                    direccion: '',
                    direccion2: '',
                    provincia: '',
                    codigo_postal: '',
                    documento: ''
                  },
                  errors: {
                    nombre: false, 
                    apellido: false, 
                    email: false, 
                    direccion: false,
                    provincia: false,
                    codigo_postal: false,
                    documento: false
                  },
                  total: 0
                },
                quantity: 1,
                pasajeros : [
                  {
                    nombre: '',
                    apellido: '',
                    email: '',
                    direccion: '',
                    documento: ''
                  }
                ]
            }
        },
        watch: {
          quantity(val , old){
            for (var i = old; i < val; i++) {
              this.pasajeros.push({
                nombre: '',
                apellido: '',
                email: '',
                direccion: '',
                documento: ''
              });
            }
            this.cart.total = this.product.product_price * val;
          }
        },
        methods: {
          step2(){
            let keys = Object.keys(this.cart.data);
            let count = 0;
              for(let i=0; i< keys.length; i++){
                let key = keys[i];
                if(this.cart.data[key] === '') {
                    this.cart.errors[key] = true;
                    count++;
                }
              }
              if(count > 0) {
                  return;
              }
              axios.post('/cart', {
                id: this.product.id,
                price: this.cart.total
              }).then(response => {
                const mp = new MercadoPago('TEST-b970a885-b574-4d94-b036-3d9f659d7a44');
                const bricksBuilder = mp.bricks();
                mp.bricks().create("wallet", "wallet_container", {
                initialization: {
                    preferenceId: response.data.preference,
                    redirectMode: "modal",
                },
                });
                this.cart.step = 2;
              }).catch(error => {
                console.log(error);
              });
          },
          step1 (){

            this.cart.step = 1;
          }
        },
        mounted() {
          this.cart.total = this.product.product_price * this.quantity;
        }
    }
</script>