<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
    <div id="app">
        <header-component></header-component>
        <div class="card col-md-10 mx-auto mt-5" style="padding: 15px">
            <h3 class="mx-auto mt-5">Crear nuevo producto:</h3>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <productos-component></productos-component>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>