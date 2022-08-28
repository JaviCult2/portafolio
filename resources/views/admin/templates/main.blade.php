<!doctype html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador</title>
    @include('admin.templates.global_css')
    @stack('styles')
</head>

<body>
@yield('content')
@include('admin.templates.global_js')
@stack('js')
</body>

</html>
