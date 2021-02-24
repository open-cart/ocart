<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-pjax-version" content="{{ mix('/css/app.css') }}">

        <title>{{ page_title()->getTitle() }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{!! asset('access/jquery/jquery.min.js') !!}"></script>
        <script src="{!! asset('access/jquery.pjax.js') !!}"></script>
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
            const confirmDelete = {
                callback: () => {},
                close: () => {},
                show(accept = () => {}, close = () => {}) {
                    $('#confirmDelete').show();
                    this.callback = accept;
                    this.close = close;
                },
                hide() {
                    $('#confirmDelete').hide();
                    this.close(this);
                },
                accept() {
                    $('#confirmDelete').hide();
                    this.callback(this);
                }
            }
        </script>
    </head>
    <body class="font-sans antialiased">
        <div id="body">
            <div x-data class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
                <header class="lg:ml-64">
                    <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>

                <!-- Page Sidebar -->
            @include('layouts.sidebar')

            <!-- Page Content -->
                <main class="lg:ml-64">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
    <div id="loading" style="display:none" class="fixed w-full h-full top-0 left-0 z-50 flex items-center justify-center">
        <div class="relative inline-flex rounded-md shadow-sm">
            <span class="flex items-center justify-center h-24 w-24">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-8 w-8 bg-purple-500"></span>
            </span>
        </div>
    </div>
    <div x-data="confirmDelete">
        <x-confirm-delete
            id="confirmDelete"
            @close="hide()"
            @accept="accept()"></x-confirm-delete>
    </div>
    <script>
        $(function(){
            // pjax
            $(document).pjax('a', '#body');
            $(document).on('pjax:send', function() {
                $('#loading').show()
            })
            $(document).on('pjax:complete', function() {
                feather.replace({'stroke-width': 1.5})
                Alpine.start();
                $('#loading').hide();
                $('img').on("error", function (e) {
                    e.target.src = '/images/no-image.jpg';
                });
            })
        })
    </script>
    @stack('scripts')
</html>
