<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ @css('default.css') }}" />
        @endif
        @stack('css')
    </head>
    <body class="bg-gray-100">
        <main class="flex h-screen overflow-hidden">
            @include('layouts.aside')
            <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
                @include('layouts.header')
                <section class="p-4 pb-20 md:p-6 md:pb-6">
                    @yield('content')
                </section>
            </div>
        </main>
        @stack('js')
    </body>
</html>
