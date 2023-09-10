<template>
    <section>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/img/baner-contacto.jpg"  class='d-block w-100' alt="">
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-5">
                    <h4 class="text-left title-custom border-custom-2 lh-1"> 
                        <p class=' mb-0' style="font-family:cherolinaregular;font-size:3.4rem;">Comunicate con</p> 
                        <p class="fw-bolder" style="font-family:poppins;font-size:3.5rem;">Nosotros</p> 
                    </h4>
                    <p class="text-left">Llena nuestro formulario, nos pondremos en cotacto a la brevedad.</p>
                </div>
                <div class="col-7">
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre Completo">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="telefono">
                        </div>
                        <div class="mb-3">
                            <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="mensaje"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                      </form>
                </div>   
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {        
        mounted() {
            
        }
    }
</script>
