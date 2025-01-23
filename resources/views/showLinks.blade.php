<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div
    class="min-h-screen"
    @if ($user->background_type == \App\Models\User::BACKGROUND_TYPE_IMAGE)
        style="background-image: url('/storage/{{ $user->background_image_path }}'); background-size: cover; background-repeat: no-repeat;"
    @else
        style="background-color: {{ $user->background_color }};"
    @endif
>
    @if($user->logo_path)
        <div class="sm:pt-10 pt-5">
            <img src="/storage/{{$user->logo_path}}" class="mx-auto sm:w-16 w-12 sm:h-16 h-12" alt="Logo">
        </div>
    @endif

    <div class="max-w-7xl mx-auto sm:pt-10 pt-5 sm:px-5 px-3">
        @foreach($links as $link)
            <!-- Card -->
            <x-useful-link :link="$link" :editMode="false" />
            <!-- End Card -->
        @endforeach
    </div>

</div>
</body>
</html>
