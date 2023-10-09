<template>
    <div class="py-5 text-center">
        <h1>
            <i v-if="status == 'approved'" class="fa-regular fa-circle-check fa-2x text-success"></i>
            <i v-else-if="status == 'pending'" class="fa-solid fa-circle-exclamation fa-2x text-warning"></i>
            <i v-else-if="status == 'failure'" class="fa-solid fa-triangle-exclamation fa-2x text-danger"></i>
        </h1>
        <h1>{{ title }}</h1>
        <p>{{text}}</p>
        <p>En los proximos minutos se estara enviando un correo con la informacion de su compra y/o estado del pago</p>
        <p>Si no recibe el correo en los proximos minutos, por favor revise su bandeja de correo no deseado</p>
        <p>Si tiene alguna duda o consulta, por favor escribanos a <a href="mailto:cynthiaedithgarske@gmail.com">cynthiaedithgarske@gmail.com</a></p>

        <div class="mt-5">
            <a href="/" class="btn btn-primary">Volver al inicio</a>
        </div>

    </div>
</template>

<script>
export default {
    props : ['status' , 'text' , 'title'],

}
</script>
