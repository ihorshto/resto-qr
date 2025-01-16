<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resto QR Code</title>
    @vite('resources/css/app.css')
</head>
<body>

<!-- ========== HEADER ========== -->
@include('layouts.header')
<!-- ========== END HEADER ========== -->

<!-- ========== MAIN SIDEBAR ========== -->
@include('layouts.sidebar')
<!-- ========== END MAIN SIDEBAR ========== -->


@vite('resources/js/app.js')
</body>
</html>
