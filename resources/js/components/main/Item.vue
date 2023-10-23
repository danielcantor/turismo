<template>
    <div class="col-xl-3 col-6 col-md-4 p-3">
        <div class="card rounded-0">
            <img :src="'/storage/' + product_image"  class="px-3 pt-3 rounded-0" >
            <div class="p-0">
            <h5 class="text-center p-3 mx-auto mt-2 text-light fs-6 w-100" style="background-color:rgb(150, 131, 236); font-family:'poppins';border-color:rgb(150, 131, 236);">{{product_name}}</h5>
            <p class="text-center mt-3 lh-1 mx-5 fs-1 " style="border:1px solid #f18701; border-top:0; border-right:0; border-left:0;  ">
                <span class="fw-bolder text-uppercase" style="font-family:'poppins';color:#f18701">${{ product_price }}</span>
            </p>
            <p class="text-center">
                <span class="fs-6" v-if='isFullDay' style="font-family:'Raleway', sans-serif;color:#2e005d;"> <img src="/img/icons/calendario.svg" width='5%'> Full day </span>
                <span class="fs-6" v-else style="font-family:'Raleway', sans-serif;color:#2e005d;"> <img src="/img/icons/calendario.svg" width='5%'> {{ days }} {{ textDays }} , {{ nights }} {{ textNights }} </span>
            </p>
            <div class="card-footer text-center border-top-0">
                <a  :href="'/productos/info/' + id" class="btn btn-primary rounded-0 fw-bolder w-75" style="background-color: #2e005d; font-family: poppins; border-color: #2e005d;"><img src="/img/icons/maleta.svg" width='10%'> VER PROGRAMA</a>
            </div>
            </div>
        </div>
    </div>
</template>
    
    <script>
        export default {
            props: [
                'id',
                'product_name',
                'product_price',
                'product_image',
                'product_description',
                'days',
                'nights'
            ],
            data() {
                return {
                    textDays : '',
                    textNights : '',
                    isFullDay : false
                }
            },
            beforeMount() {

                if(this.days === 1){
                    this.textDays = 'día'
                }
                else{
                    this.textDays = 'días'
                }

                if(this.nights === 1){
                    this.textNights = 'noche'
                }
                else{
                    this.textNights = 'noches'
                }

                if(this.days === 1 && this.nights === 0){
                    this.isFullDay = true
                }
            },
            mounted() {

            }
        }
    </script>
    