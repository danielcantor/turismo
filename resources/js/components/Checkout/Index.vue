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
                <small class="text-muted" v-html="product.product_description" ></small>
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
  <ul class="nav nav-pills mb-3">
    <li class="nav-item">
      <a class="nav-link" :class="[ cart.step === 1 ? 'active' : 'disabled']" href="#">Información de Pasajeros</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" :class="[ cart.step === 2 ? 'active' : 'disabled']"  href="#">Información de facturación</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" :class="[ cart.step === 3 ? 'active' : 'disabled']"  href="#">Confirmación de compra</a>
    </li>
  </ul>
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
              <small class="text-muted" :html="product.product_description"></small>
            </div>
            <strong>${{product.product_price}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Subtotal (ARS)</span>
            <strong>${{cart.subtotal}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (ARS)</span>
            <strong>${{cart.total}}</strong>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8" v-show="cart.step === 1">
        <h4 class="mb-3">Seleccionar cantidad de pasajeros</h4>
          <div class="row g-3">
            <div class="col-12" v-if="hasDepartureDates">
              <label for="departureDate" class="form-label">Fecha de salida</label>
              <select class="form-select" id="departureDate" required v-model="selectedDepartureDateId">
                <option disabled="true" selected="true" value="">Selecciona una fecha</option>
                <option v-for="date in product.departure_dates" :key="date.id" :value="date.id">
                  {{ formatDepartureDate(date.date) }}
                </option>
              </select>
            </div>
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

          <hr class="my-4">

        <h4 class="mb-3">Datos de los pasajeros</h4>

        <pasajeros v-for="(qty, index) in quantity" :key="index" :pasajero="pasajeros[index]" :qty="qty" @error="setError" :ref="'pasajero' + index"></pasajeros>

        <hr class="my-4">

        <button class="mx-auto d-block btn btn-success btn-lg" @click="step2">Continuar</button>
      </div>
      <div class="col-md-7 col-lg-8" v-show="cart.step === 2">
        <h4 class="mb-3">Informacion de facturación</h4>
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
            <div class="col-sm-6">
              <label for="lastName" class="form-label">Telefono</label>
              <input type="number" class="form-control" id="lastName" placeholder="" value="" required v-model="cart.data.telefono" :class="[ cart.errors.telefono ? 'is-invalid' : '']">
              <div class="invalid-feedback">
                Se necesita el numero de telefono.
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
              <label for="address2" class="form-label">Localidad</label>
              <input type="text" class="form-control" id="address2" required placeholder="Numero de departemento" :class="[ cart.errors.ciudad ? 'is-invalid' : '']" v-model="cart.data.ciudad">
              <div class="invalid-feedback">
                Por favor ingrese su localidad.
              </div>
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

        <div class="row mt-3">
          <div class="col-6 text-center">
            <button class="btn btn-warning btn-lg" @click="goBack">Volver</button>
          </div>
          <div class="col-6 text-center">
            <button class="btn btn-success btn-lg" @click="step3">Continuar</button>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-lg-8" v-show="cart.step === 3">
        <h4 class="mb-3">Confirmacion de compra</h4>
        <p>Este es el resumen de tu compra:</p>
        <div class="card my-3 shadow-sm" v-for="(pasajero,key) in pasajeros.slice(0, quantity)" :key="key">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Pasajero #{{ key + 1}}</h5>
          </div>
          <div class="card-body">
            <h6 class="card-subtitle mb-3 text-muted">Datos personales</h6>
            <div class="row mb-2">
              <div class="col-md-4">
                <p class="mb-1"><small class="text-muted">Nombre completo</small></p>
                <p class="fw-bold">{{ pasajero.nombre }} {{ pasajero.apellido }}</p>
              </div>
              <div class="col-md-4">
                <p class="mb-1"><small class="text-muted">Fecha de nacimiento</small></p>
                <p class="fw-bold">{{ pasajero.nacimiento }}</p>
              </div>
              <div class="col-md-4">
                <p class="mb-1"><small class="text-muted">Nacionalidad</small></p>
                <p class="fw-bold">{{ NacionalidadName(pasajero.nacionalidad) }}</p>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-4">
                <p class="mb-1"><small class="text-muted">Documento</small></p>
                <p class="fw-bold">{{ pasajero.documento }}</p>
              </div>
              <div class="col-md-4">
                <p class="mb-1"><small class="text-muted">Celular</small></p>
                <p class="fw-bold">{{ pasajero.celular }}</p>
              </div>
              <div class="col-md-4">
                <p class="mb-1"><small class="text-muted">Email</small></p>
                <p class="fw-bold">{{ pasajero.email }}</p>
              </div>
            </div>
            <hr>
            <h6 class="card-subtitle mb-3 text-muted">Preferencias alimentarias</h6>
            <div class="row">
              <div class="col-md-12">
                <p class="mb-1"><small class="text-muted">Tipo de dieta</small></p>
                <p class="fw-bold">{{ DietaName(pasajero.dieta.tipo) }}</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="card my-3 shadow-sm">
          <div class="card-header bg-info text-white">
            <h5 class="mb-0">Datos de facturación</h5>
          </div>
          <div class="card-body">
            <div class="row mb-2">
              <div class="col-md-6">
                <p class="mb-1"><small class="text-muted">Nombre completo</small></p>
                <p class="fw-bold">{{ cart.data.nombre }} {{ cart.data.apellido }}</p>
              </div>
              <div class="col-md-6">
                <p class="mb-1"><small class="text-muted">Email</small></p>
                <p class="fw-bold">{{ cart.data.email }}</p>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6">
                <p class="mb-1"><small class="text-muted">Teléfono</small></p>
                <p class="fw-bold">{{ cart.data.telefono }}</p>
              </div>
              <div class="col-md-6">
                <p class="mb-1"><small class="text-muted">Documento</small></p>
                <p class="fw-bold">{{ cart.data.documento }}</p>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-12">
                <p class="mb-1"><small class="text-muted">Dirección completa</small></p>
                <p class="fw-bold">{{ cart.data.direccion }}, {{ cart.data.ciudad }}, CP: {{ cart.data.codigo_postal }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-6 text-center">
            <button class="btn btn-warning btn-lg" @click="goBack">Volver</button>
          </div>
          <div class="col-6 text-center">
            <button class="btn btn-success btn-lg" @click="confirmReservation">Confirmar Reserva</button>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-lg-8" v-show="cart.step === 4">
        <h1>
            <i class="fa-regular fa-circle-check fa-2x text-success"></i>
        </h1>
        <h1>¡Gracias por tu reserva!</h1>
        <p>Tu reserva fue procesada exitosamente</p>
        <p>Numero de reserva # {{cart.purchaseID}}</p>
        <p>En los proximos minutos se estara enviando un correo con la informacion de su compra y/o estado del pago</p>
        <p>Si no recibe el correo en los proximos minutos, por favor revise su bandeja de correo no deseado</p>
        <p>Si tiene alguna duda o consulta, por favor escribanos a <a href="mailto:cynthiagarsketurismo@gmail.com">cynthiagarsketurismo@gmail.com</a></p>

        <div class="mt-5">
            <a href="/" class="btn btn-primary">Volver al inicio</a>
        </div>
      </div>
    </div>
  </main>
</div>
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="errorModalLabel">Error</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Ha ocurrido un error al intentar continuar con el pago, por favor intente en unos minutos.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
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
                  payment_type : 'Reserva',
                  discount_value : 0,
                  data: {
                    nombre: '',
                    pais: 'Argentina',
                    apellido: '',
                    email: '',
                    direccion: '',
                    ciudad: '',
                    provincia: '',
                    codigo_postal: '',
                    documento: '',
                    telefono: ''
                  },
                  purchaseID: '',
                  errors: {
                    nombre: false, 
                    apellido: false, 
                    email: false, 
                    direccion: false,
                    provincia: false,
                    codigo_postal: false,
                    documento: false,
                    telefono: false,
                    localidad: false,
                  },
                  subtotal : 0,
                  total: 0
                },
                quantity: 1,
                selectedDepartureDateId: '',
                pasajeros : [
                  {
                    nombre: '',
                    apellido: '',
                    nacimiento: '',
                    email: '',
                    nacionalidad : '',
                    documento: '',
                    celular: '',
                    dieta: {
                      tipo: ''
                    }
                  }
                ],
                errors : false
            }
        },
        watch: {
          quantity(val, old) {
            if (val > old) {
              for (var i = old; i < val; i++) {
                this.pasajeros.push({
                  nombre: '',
                  apellido: '',
                  nacimiento: '',
                  email: '',
                  nacionalidad: '',
                  documento: '',
                  celular: '',
                  dieta: {
                    tipo: ''
                  }
                });
              }
            } else {
              this.pasajeros.splice(val);
            }
            this.ChangePrice(val);
          },

        },
        computed: {
          hasDepartureDates() {
            return this.product.departure_dates && this.product.departure_dates.length > 0;
          }
        },
        methods: {
          step2(){
            // Validate passengers data before moving to step 2
            for(let i=0; i< this.quantity ; i++){
              this.$refs['pasajero' + i][0].CheckPropData();
            }
            if(this.error) return;
            
            this.cart.step = 2;
          },
          ChangePrice(val) {
            const normalPrice = this.product.product_price * val;
            this.cart.subtotal = normalPrice.toFixed(2);
            this.cart.total = normalPrice.toFixed(2);
            this.cart.discount_value = 0;
          },
          NacionalidadName(value){
            const nacionalidades = {
              1: 'Argentina',
              2: 'Brasil',
              3: 'Chile',
              4: 'Uruguay',
              5: 'Paraguay'
            }
            return nacionalidades[value];
          },
          DietaName(value){
            const dietas = {
              0: 'Sin especificar',
              1: 'Vegetariano',
              2: 'Celiaco',
              3: 'Diabetico',
              4: 'Hipertenso'
            }
            return dietas[value];
          },
          setError(value){
            this.error = value;
          },
          formatDescription: function (value) {
            //replace \n with a double lineebreak
            return value.replace(/\n/g, '<br>');
          },
          
          resetErrors(){
            this.cart.errors.nombre = false;
            this.cart.errors.apellido = false;
            this.cart.errors.email = false;
            this.cart.errors.direccion = false;
            this.cart.errors.provincia = false;
            this.cart.errors.codigo_postal = false;
            this.cart.errors.documento = false;
            this.cart.errors.telefono = false;
          },
          step3 (){
            // Validate billing data before moving to step 3
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
              this.resetErrors();
              this.cart.step = 3;
          },
          confirmReservation() {
            const requestData = {
                id: this.product.id,
                price: this.cart.total,
                payment: this.cart.payment_type,
                pasajeros: this.pasajeros.slice(0, this.quantity),
                facturacion : this.cart.data
            };
            
            // Add departure date if selected
            if (this.selectedDepartureDateId) {
              requestData.departure_date_id = this.selectedDepartureDateId;
            }
            
            axios.post('/cart/reserve', requestData, {
                headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
              }).then(response => {
                if(response.data.purchaseID){
                  this.cart.purchaseID = response.data.purchaseID;
                  this.cart.step = 4;
                }else{
                    //modal en caso de error
                    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                    errorModal.show();
                }
              }).catch(error => {
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
              });
          },
          step1 (){

            this.cart.step = 1;
          },
          reserve (){
                this.cart.step = 4;
          },
          goBack (){
            if(this.cart.step > 1){
              this.cart.step = this.cart.step - 1;
            }
          },
          formatDepartureDate(date) {
            if (!date) return '';
            const [year, month, day] = date.split('-');
            const dateObj = new Date(year, month - 1, day);
            return new Intl.DateTimeFormat('es-AR', {
              year: 'numeric',
              month: 'long',
              day: 'numeric',
              timeZone: 'America/Argentina/Buenos_Aires'
            }).format(dateObj);
          }
        },
        beforeMount() {
          this.product.product_description = this.formatDescription(this.product.product_description);
        },
        mounted() {
          this.cart.total = this.product.product_price * this.quantity;
        }
    }
</script>