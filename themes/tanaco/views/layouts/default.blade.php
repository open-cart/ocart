<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-pjax-version" content="{{ mix('themes/ripple/css/style.css') }}">

    <title>TanacoGroup.vn - Hệ thống phân phối</title>
    <link rel="icon" type="image/png" href="{{ Theme::asset('img/favicon-tanaco.gif') }}">

    <!-- Meta -->
    <meta name="description" content="TanacoGroup.vn - Hệ thống phân phối">
    <meta name="keywords" content="tanaco, tanaco group">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SeoHelper::render() !!}

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    {{--<link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
    <link rel="stylesheet" href="{{ Theme::asset('css/style.css?v=1') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
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
    // $(document).on('click', 'a:not(no-pjax)', function(event) {
    //     // event.preventDefault();
    //     const container = $(this).attr('data-body');
    //     const containerSelector = '#' + container;
    //     if ($(containerSelector).length) {
    //         $.pjax.click(event, {container: containerSelector})
    //     } else {
    //         $.pjax.click(event, {container: '#body'})
    //     }
    // })
    $(document).pjax('a', '#body');
    $.pjax.defaults.timeout = 1200;
</script>
</html>
