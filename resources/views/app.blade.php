<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

{{--        <link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}" />--}}

        <link rel="icon" href="/storage/images/indobeach-logo-white.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        <div id="app"
             data-page="{{ json_encode($page) }}"
             data-vapid-public-key="{{ config('webpush.vapid.public_key') }}">
        </div>
        @inertia
    </body>
</html>
