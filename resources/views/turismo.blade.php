<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('/apple-icon-114x114.png') }}">
    <link rel="manifest" href="{{ url('/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="{{ $description }}">
    <title>{{ $pageName }}</title>
</head>
<body>
    <div id="app">
        <header-component></header-component>

        <!-- Pasamos datos al componente Vue mediante props en vez de window.* -->
        <turismo-component
            :posts='@json($items->items())'
            :pagination='@json($items->toArray())'
            :image-url='@json($imageUrl)'
            :title='@json($title)'
            :subtitle='@json($subtitle)'
            :description='@json($description)'>
        </turismo-component>

        <footer-component></footer-component>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>