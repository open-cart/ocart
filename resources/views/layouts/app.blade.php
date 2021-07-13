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
                loading: false,
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
                    if (this.loading) {
                        return Promise.reject();
                    }

                    this.loading = true;
                    return this.callback(this).then(() => {
                        $('#confirmDelete').hide();
                    }).finally(() => {
                        this.loading = false;
                    })
                }
            }
            function tableActions() {
                return {
                    destroy(id, url, options = {}) {
                        confirmDelete.show(() => {
                            // bodyLoading.show();
                            return axios.delete(url, {data: {id}})
                                .then(res => {
                                    toast.success('Deleted successfully')
                                    if (options.id) {
                                        $.pjax.reload('#' + options.id, {});
                                    } else {
                                        $.pjax.reload('#body', {});
                                    }

                                    return res;
                                })
                                .catch(e => {
                                    toast.error(e.message);
                                })
                                .finally(() => {
                                    // bodyLoading.hide();
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
            const buttonLoading = (el) => {
                return {
                    show() {
                        el.addClass('button-loading');
                    },
                    hide() {
                        el.removeClass('button-loading');
                    }
                }
            }
            function showError(e) {
                if (e?.errors) {
                    toast.error(Object.values(e.errors).find(Boolean));
                } else {
                    toast.error(e.message);
                }
                throw e;
            }
        </script>
        <style>
            .button-loading {
                cursor: default;
                text-shadow: none;
                color: transparent!important;
                position: relative;
                transition: border-color .2s ease-out;
            }
            .button-loading::before {
                content: "";
                position: absolute;
                top: 50%;
                left: 50%;
                border-radius: 50%;
                border: 3px solid #919eab;
                border-bottom-color: transparent;
                margin-top: -9px;
                margin-left: -9px;
                width: 18px;
                height: 18px;
                -webkit-animation: spin .7s linear infinite;
                animation: spin 1s linear infinite;
            }
        </style>
        @stack('head')
    </head>
    <body class="font-sans antialiased dark:bg-gray-800 dark:text-gray-300">
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
    {!! Assets::renderFooter() !!}
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

            // window.onpopstate = function(event) {
            //     // alert("location: " + document.location + ", state: " + JSON.stringify(event.state));
            //     window.location.reload();
            // };

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
                console.log('complete pjax');
                loading.then(() => {
                    bodyLoading.hide();
                })
                $('img').on("error", function (e) {
                    e.target.src = '/images/no-image.jpg';
                });
            })
            $('img').on("error", function (e) {
                e.target.src = '{{ asset('/images/no-image.jpg') }}';
            });
        })
    </script>
    @stack('bodyAppend')
</html>
