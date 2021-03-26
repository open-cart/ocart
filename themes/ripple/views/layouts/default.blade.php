<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-pjax-version" content="{{ mix(Theme::asset('css/style.css')) }}">

    <title>Bdstayhanoi.vn - Bất động sản phía tây hà nội</title>
    <link rel="icon" type="image/png" href="{{ Theme::asset('img/favicon-bdstayhanoi.jpg') }}">

    <!-- Meta -->
    <meta name="description" content="Bdstayhanoi.vn - Bất động sản phía tây hà nội">
    <meta name="keywords" content="bds tay ha noi">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SeoHelper::render() !!}

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    {{--<link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
    <link rel="stylesheet" href="{{ Theme::asset('css/style.css?v=1') }}">

    <!-- Scripts -->
    <script src="{{ Theme::asset('js/app.js') }}" defer></script>
    <script src="{!! asset('access/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('access/jquery.pjax.js') !!}"></script>
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    @include(Theme::getThemeNamespace('layouts.header'))
    <div id="body" class="content">{{ $slot }}</div>
    @include(Theme::getThemeNamespace('layouts.footer'))

</div>
</body>
<script>
    $(document).pjax('a', '#body');
    $.pjax.defaults.timeout = 1200;
</script>
</html>
