<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div x-data class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class=" ml-64">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Sidebar -->
            @include('layouts.sidebar')

            <!-- Page Content -->
            <main class="ml-64">
                {{ $slot }}
            </main>
        </div>
    </body>
    <script>
        var themes = {
            blue: {
                bg: 'bg-blue-500'
            },
            red: {
                bg: 'bg-red-500'
            },
            green: {
                bg: 'bg-green-600'
            },
            black: {
                bg: 'bg-gray-800'
            }
        };
        var theme = {{ session('theme', 'themes.blue') }};
    </script>
</html>
