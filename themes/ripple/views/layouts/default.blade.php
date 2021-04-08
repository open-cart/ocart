<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-pjax-version" content="{{ mix('themes/ripple/css/style.css') }}">

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
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{!! asset('access/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('access/jquery.pjax.js') !!}"></script>
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    @include(Theme::getThemeNamespace('layouts.header'))
    <button id="gotop" class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 opacity-0 fixed bottom-10 right-10 z-50 focus:outline-none">
        <x-theme::icons.chevron-double/>
    </button>
    <div id="body" class="content">{{ $slot }}</div>
    @include(Theme::getThemeNamespace('layouts.footer'))

<!-- This example requires Tailwind CSS v2.0+ -->
    <div x-data="{ modal : false }" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" x-ref="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div :class="{'ease-out duration-300 opacity-100' : modal, 'ease-in duration-200 opacity-0' : !modal}" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div :class="{'ease-out duration-300 opacity-100 translate-y-0 sm:scale-100' : modal, 'ease-in duration-200 opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95' : !modal}" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Deactivate account
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Deactivate
                    </button>
                    <button x-on:click="modal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="alert alert-success fixed top-4 right-4 z-50">--}}
        {{--<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">--}}
            {{--<strong class="font-bold">Holy smokes!</strong>--}}
            {{--<span class="block sm:inline">Holy smokes!Holy smokes!Holy smokes!Holy smokes!Holy smokes!Holy smokes!Holy smokes!</span>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">--}}
        {{--<strong class="font-bold">Holy smokes!</strong>--}}
        {{--<span class="block sm:inline">{{ session('alert') }}</span>--}}
        {{--<span class="absolute top-0 bottom-0 right-0 px-4 py-3">--}}
                {{--<svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>--}}
             {{--</span>--}}
    {{--</div>--}}
    @if (session('alert'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Holy smokes!</strong>
            <span class="block sm:inline">{{ session('alert') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
             </span>
        </div>
    @endif

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

    var btn = $('#gotop');

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass('opacity-100');
        } else {
            btn.removeClass('opacity-100');
        }
    });

    btn.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, '300');
    });

    function addToCart(productId) {
        axios.post('{!! route('add-to-cart') !!}', {
            productId: productId
        }).then((res) => {
            toast.success(res.message);
            $(".cart-count").text(res.count);
        }).catch(e => {
            toast.error(e.message)
        }).finally(() => {
            // $.pjax.reload('#body', {});
        })
    }
</script>
</html>
