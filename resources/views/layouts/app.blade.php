<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-pjax-version" content="{{ mix('/css/app.css') }}">
        <meta http-equiv="x-pjax-version" content="{{ mix('/css/swal.css') }}">

        <title>{{ page_title()->getTitle() }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

{{--        <!-- Styles -->--}}
{{--        <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
{{--        <link rel="stylesheet" href="{{ asset('css/swal.css') }}">--}}

{{--        <!-- Scripts -->--}}
{{--        <script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--        <script src="{!! asset('access/jquery/jquery.min.js') !!}"></script>--}}
{{--        <script src="{!! asset('access/jquery.pjax.js') !!}"></script>--}}

        {!! Assets::renderHeader(['core']) !!}

        <script>
            const bodyLoading = {
                show() {
                    $('#loading').show();
                },
                hide() {
                    $('#loading').hide();
                }
            }
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
                    bg: 'bg-gray-900'
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
            function tableActions() {
                return {
                    destroy(id, url, options = {}) {
                        confirmDelete.show(() => {
                            bodyLoading.show();
                            axios.delete(url, {data: {id}})
                                .then(res => {
                                    toast.success('Deleted successfully')
                                    if (options.id) {
                                        return $.pjax.reload('#' + options.id, {});
                                    }
                                    return $.pjax.reload('#body', {});
                                })
                                .catch(e => {
                                    toast.error(e.message);
                                })
                                .finally(() => {
                                    bodyLoading.hide();
                                })
                        })
                    },
                }
            }
            $(function () {
                $(document).on('click', '[data-toggle=modal]', function () {
                    const idModal = $(this).attr('data-target');
                    $(idModal).click();
                })
            })
        </script>
        @stack('head')
    </head>
    <body class="font-sans antialiased dark:bg-gray-800">
        @stack('bodyPrepend')
        <div>
            <div x-data class="min-h-screen bg-gray-100 dark:bg-gray-800">
            @include('layouts.navigation')

            <!-- Page Heading -->
{{--                <header class="lg:ml-64">--}}
{{--                    <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                        <div class="hidden">{{ $header }}</div>--}}
{{--                        {{ Breadcrumbs::render('main', page_title()->getTitle(false)) }}--}}
{{--                    </div>--}}
{{--                </header>--}}

                <!-- Page Sidebar -->
            @include('layouts.sidebar')

            <!-- Page Content -->
                <main class="lg:ml-64" id="body" data-pjax-container="body">
                    {{ $slot }}
                </main>
            </div>
            {!! Assets::renderBody() !!}
            @stack('scripts')
        </div>
    </body>
    <div id="loading" style="display:none; background: rgba(189,191,191,0.38)" class="fixed w-full h-full top-0 left-0 z-50 flex items-center justify-center">
        <div class="relative inline-flex">
            <span class="flex items-center justify-center h-24 w-24">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-6 w-6 bg-purple-500"></span>
            </span>
        </div>
    </div>
    <div x-data="confirmDelete">
        <x-confirm-delete
            id="confirmDelete"
            @close="hide()"
            @accept="accept()"></x-confirm-delete>
    </div>
    <div id="tnmedia-root"></div>
    <script>
        $(function(){
            // pjax
            // $(document).on('click', 'a', function(event) {
            //     // event.preventDefault();
            //     var container = $(this).closest('[data-pjax-container]')
            //     var containerSelector = '#' + container[0].id
            //     console.log(container[0].id)
            //     $.pjax.click(event, {container: containerSelector})
            // })
            $(document).pjax('a:not(.blank)', '#body');
            $.pjax.defaults.timeout = 1200;

            let loading;

            $(document).on('pjax:send', function() {
                loading =  new Promise((resolve, reject) => {
                    setTimeout(function() {
                        resolve(true)
                    }, 120)
                });
                bodyLoading.show();
            })
            $(document).on('pjax:complete', function() {
                feather.replace({'stroke-width': 1.5})
                Alpine.start();
                loading.then(() => {
                    bodyLoading.hide();
                })
                $('img').on("error", function (e) {
                    e.target.src = '/images/no-image.jpg';
                });
            })
        })
    </script>
    @stack('bodyAppend')
</html>
