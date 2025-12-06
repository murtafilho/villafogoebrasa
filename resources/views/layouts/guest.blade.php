<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login - Villa Fogo & Brasa</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-villa-cream antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-villa-charcoal relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-villa-espresso via-villa-charcoal to-black opacity-90"></div>
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1544025162-d76694265947?w=1920')] bg-cover bg-center opacity-10"></div>

            <!-- Logo -->
            <div class="relative z-10 mb-6">
                <a href="/" class="block">
                    <img src="{{ asset('img/logo.webp') }}" alt="Villa Fogo & Brasa" class="h-24 w-auto">
                </a>
            </div>

            <!-- Login Card -->
            <div class="relative z-10 w-full sm:max-w-md px-8 py-8 bg-villa-espresso/80 backdrop-blur-sm border border-villa-gold/20 shadow-2xl overflow-hidden sm:rounded-xl">
                {{ $slot }}
            </div>

            <!-- Back to site -->
            <div class="relative z-10 mt-6">
                <a href="/" class="text-villa-cream/60 hover:text-villa-gold text-sm transition-colors">
                    &larr; Voltar ao site
                </a>
            </div>
        </div>
    </body>
</html>
