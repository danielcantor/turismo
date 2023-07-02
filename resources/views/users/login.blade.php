<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>Iniciar Sesión</title>
</head>
<body>
    @include('flash::message')
    <div id="app">
        <header-component></header-component>
        @if(session()->has('flash_notification.message'))
        <div class="alert alert-{{ session('flash_notification.level') }}">
            {{ session('flash_notification.message') }}
        </div>
        @endif
        <login-component></login-component>
        <footer-component></footer-component>
    </div>
    
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>