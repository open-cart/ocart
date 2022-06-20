<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:x-theme="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-pjax-version" content="{{ mix('themes/base/css/style.css') }}">
    <meta name="robots" content="index,follow">

    @if(!empty(get_favicon()))
        <link rel="icon" type="image/png" href="{{ get_favicon() }}">
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SeoHelper::render() !!}

    <!-- Fonts -->
    <link rel=preload href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'"/>

    <style>
        section:nth-child(odd), .sec-category-product1 {
            background-color: #ececec63;
        }
    </style>
    <link rel="stylesheet" href="{{ Theme::asset('css/speed.css') }}"/>
    <link rel="preload" href="{{ Theme::asset('css/style.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
    <!-- Swiper CSS -->
    <link rel="preload" href="{!! asset('access/swiper/css/swiper-custom.min.css') !!}" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
    <link rel="stylesheet" href="{!! asset('access/swiper/css/swiper-button-custom.css') !!}"/>

    <script src="{!! asset('access/jquery/jquery.min.js') !!}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{!! asset('access/jquery.pjax.js') !!}" defer></script>
    <!-- Swiper JS -->
    <script src="{!! asset('access/swiper/js/swiper-custom.min.js') !!}"></script>
    {{--<!-- lozad JS -->--}}
    <script src="{!! asset('access/lazyload/lozad.min.js') !!}"></script>

    <!-- Meta Head -->
    {!! theme_options()->getOption('meta_header', '') !!}
    <!-- End Meta Head -->

    <!-- Style Css Custom -->
    @if(!empty(theme_options()->getOption('style_custom', '')))
        <style>
            {!! theme_options()->getOption('style_custom', '') !!}
        </style>
    @endif
    <!-- End Style Css Custom -->

    @stack('head')

    <script>
        const bodyLoading = {
            show() {
                $('#loading').show();
            },
            hide() {
                $('#loading').hide();
            }
        }
    </script>

</head>
<body id="body" class="font-sans text-gray-900 antialiased">
@stack('body')

@include(Theme::getThemeNamespace('layouts.header'))
<div id="body-content" class="content" data-pjax-container="body">{{ $slot }}</div>

<div class="google-speed">
    @include(Theme::getThemeNamespace('layouts.footer'))

    @include(Theme::getThemeNamespace('components.layout.list-sharing'))

    <!-- Modal -->
    <x-theme::form.login-modal/>

    <x-theme::modal.youtube/>

    <x-theme::modal.search/>
    <!-- End Modal -->
    <div id="loading" style="display:none" class="fixed w-full h-full top-0 z-50 flex items-center justify-center">
        <div class="relative inline-flex">
            <span class="flex items-center justify-center h-24 w-24">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-0 w-0 bg-purple-500"></span>
            </span>
        </div>
    </div>
</div>

@stack('bodybelow')

<script>
    $(function(){
        $(document).pjax('a:not(.blank)', '#body-content');
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
            if (typeof FB != 'undefined') {
                FB.XFBML.parse();
            }
            feather.replace({'stroke-width': 1.5})
            Alpine.start();
            loading.then(() => {
                bodyLoading.hide();
            })
            const observer = lozad(); // lazy loads elements with default selector as '.lozad'
            observer.observe()
            $('img').on("error", function (e) {
                e.target.src = '/images/no-image.jpg';
            });
        })

        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe()
    })

    @if(is_active_plugin('ecommerce'))
    function addToCart(productId, slug = null, quantity = 1, optionAttrs = [], buynow = false) {
        axios.post('{{route(ROUTE_ADD_TO_CART_NAME)}}', {
            productId: productId,
            slug: slug,
            quantity: quantity,
            optionAttrs: optionAttrs,
        }).then((res) => {
            toast.success(res.message);
            $(".cart-count").text(res.count);
            if (!!buynow){
                $.pjax({url: '{{ route(ROUTE_SHOPPING_CART_SCREEN_NAME) }}', container: '#body'})
            }
        }).catch(e => {
            toast.error(e.message)
        }).finally(() => {
            // $.pjax.reload('#body', {});
        });
    }
    @endif

    $(function () {
        $(document).on('click', '[data-toggle=modal]', function () {
            const idModal = $(this).attr('data-target');
            $(idModal).click();
        })
    })
</script>

<!-- Meta Footer -->
{!! theme_options()->getOption('meta_footer', '') !!}
<!-- End Meta Footer -->

@stack('footer')

</body>
</html>
