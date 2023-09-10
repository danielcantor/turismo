<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('/css/fontawesome.min.css') }}">
    <title>{{isset($pageName) ? $pageName :'Destinos'}}</title>
</head>
<body>
    <div id="app">
        <header-component></header-component>
        <turismo-component :items="@json($items)" :imageURL='{{$imageUrl}}'></turismo-component>
        <footer-component></footer-component>    
    </div>
    
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>