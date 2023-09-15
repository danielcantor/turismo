<template>
    <section>
        <Slider :imageUrl="'/img/baner-contacto.jpg'"/>
        <div class="container my-5 py-5">
            <div class="row justify-content-center text-md-start text-sm-center">
                <div class="col-md-5 col-12">
                    <h4 class=" title-custom border-custom-2 lh-1"> 
                        <p class='mb-0' style="font-family:cherolinaregular;font-size:3.4rem;">Comunicate con</p> 
                        <p class="fw-bolder" style="font-family:poppins;font-size:3.5rem;">Nosotros</p> 
                    </h4>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <p class="fw-bolder mb-2" style="font-family:poppins;">Email</p>
                                <p>cynthiaedithgarske@gmail.com</p> 

                                <p class="fw-bolder" style="font-family:poppins;">Siguenos en redes sociales</p>
                                <p> 
                                    <a href="#" class="px-2">
                                        <i class="fa-brands fa-square-facebook fa-2x" style="color: #276ee7;"></i>
                                    </a> 
                                    <a href="#">
                                        <i class="fa-brands fa-instagram fa-2x" style="color: #8640bf;"></i>
                                    </a> 
                                </p> 
                            </div>
                            <div class="col-md-6 col-12">
                                <p class="fw-bolder mb-2" style="font-family:poppins;">Consultas por Whatsapp</p>
                                <p><a href="#" class="btn w-50" style="color:white; background-color: #25d366;">Mensaje <i class="fa-brands fa-whatsapp fa-sm" style="color: white;"></i></a></p> 
                            </div>
                            <hr class="col-12">
                            <div class="col-12">
                                <p class="fw-bolder mb-0" style="font-family:poppins;">Telefono de contacto</p>
                                <p>+54 9 11 3413-8037</p> 

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    
                        <div class="mb-3">
                            <input type="text" v-model="form.name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre Completo">
                        </div>
                        <div class="mb-3">
                            <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="number" v-model="form.phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="telefono">
                        </div>
                        <div class="mb-3">
                            <textarea name="" v-model="form.mensaje" id="" cols="30" rows="10" class="form-control" placeholder="mensaje"></textarea>
                        </div>
                        <button @click="send" class="btn btn-primary">Enviar</button>
                    
                </div>   
                </div>
        </div>
    </section>
</template>

<script>
    import Slider from '../main/Slider.vue';
    import axios from 'axios';
    import Swal from 'sweetalert2';
    export default {      
        components: { Slider },
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    phone: '',
                    mensaje: '',
                    csrfToken : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
        },
        methods: {
            send: function(event) {
                axios.post('/mail', this.form)
                .then(res => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Mensaje enviado',
                        text: 'Gracias por contactarnos, te responderemos a la brevedad',
                        timer: 1500
                    });
                    this.form.name = '';
                    this.form.email = '';
                    this.form.phone = '';
                    this.form.mensaje = '';
                    event.preventDefault();
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salio mal, intentalo de nuevo',
                        timer: 1500
                    });
                    event.preventDefault();
                })
            }
        },
        mounted() {

            
            
        }
    }
</script>
