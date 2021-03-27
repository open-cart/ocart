<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Xi Măng</title>

<!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('themes/ximang/css/style.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('themes/ximang/js/jquery.min.css') }}"></script>
    <script src="{{ asset('themes/ximang/js/cus.css') }}"></script>

</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    @include(Theme::getThemeNamespace('layouts.header'))
    <div class="content">{{ $slot }}</div>
    @include(Theme::getThemeNamespace('layouts.footer'))
</div>
</body>
</html>
