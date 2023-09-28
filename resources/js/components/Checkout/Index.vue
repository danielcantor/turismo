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
              <span class="text-muted">${{product.product_price}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (ARS)</span>
              <strong>$20</strong>
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
          <span class="badge bg-primary rounded-pill">1</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between align-items-center lh-sm">
            <div>
              <h6 class="my-0">{{product.product_name}}</h6>
              <small class="text-muted">{{product.product_description}}</small>
            </div>
            <span class="text-muted">${{product.product_price}}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (ARS)</span>
            <strong>$20</strong>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Informacion de cliente</h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Se necesita el nombre.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Apellido</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Se necesita el apellido.
              </div>
            </div>

            <div class="col-6">
              <label for="email" class="form-label">Correo electronico</label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Por favor ingrese un correo electronico valido.
              </div>
            </div>

            <div class="col-6">
              <label for="address" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Por favor ingrese su direccion.
              </div>
            </div>

            <div class="col-6">
              <label for="address2" class="form-label">Dirección 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
            </div>


            <div class="col-md-6">
              <label for="state" class="form-label">Provincia</label>
              <select class="form-select" id="state" required>
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

            <div class="col-md-3">
              <label for="zip" class="form-label">Codigo Postal</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>
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
              <select class="form-select" id="state" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option disabled="true" selected="true" value="">Selecciona</option>              
              </select>
            </div>
          </div>

          <hr class="my-4">

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
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
        </form>
      </div>
    </div>
  </main>
</div>
</section>
</template>
<script>
  
    export default {  
      props: ['product'],
        data() {
            return {
                cart: [],
            }
        },
        mounted() {
            
        }
    }
</script>