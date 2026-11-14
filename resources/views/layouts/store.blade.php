<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('description', 'Shop smartphones and accessories at JT Ponsel.')">
        <title>@yield('title', 'JT Ponsel')</title>
        @vite(['resources/css/commerce.css'])
        @stack('styles')
    </head>
    <body class="min-h-screen bg-[#0a0a0b] font-sans text-white antialiased">
        @yield('header')
        @yield('content')
        @stack('scripts')
    </body>
</html>
