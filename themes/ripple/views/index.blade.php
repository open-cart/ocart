<x-guest-layout>
    <div class="image-cover hero-banner bg-no-repeat bg-cover bg-center"
         style="background-image:url(https://themezhub.net/resido-live/resido/assets/img/banner-1.jpg);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-20">
            <div class="hero-search-wrap">
                <div class="hero-search">
                    <h1 id="form-lh">Form liên hệ</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="sec-product antialiased bg-gray-100 text-gray-900 font-sans py-16">
        <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
            <h2 class="text-3xl font-bold">Explore Good places</h2>
            <p class="text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                praesentium voluptatum deleniti atque corrupti quos dolores</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-wrap -mx-4">
                @foreach(get_list_products() as $product)
                    @include(Theme::getThemeNamespace('component.item-product'), ['data' => $product])
                @endforeach
            </div>
        </div>

    </section>
    <section class="sec-post antialiased font-sans py-16">
        <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
            <h2 class="text-3xl font-bold">Find By Locations</h2>
            <p class="text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-wrap -mx-4">
                @foreach(get_list_products() as $post)
                    @include(Theme::getThemeNamespace('component.item-post'), ['data' => $post])
                @endforeach
            </div>
        </div>

    </section>
    <section class="antialiased font-sans bg-blue-600">
        <div class="call-to-act py-14 max-w-7xl mx-auto px-4 sm:px-6 block sm:flex items-center">
            <div class="call-to-act-head text-white flex-1 mb-8 sm:mb-0">
                <h3 class="text-2xl font-bold">Want to Become a Real Estate Agent?</h3>
                <span>We'll help you to grow your career and growth.</span>
            </div>
            <a href="#" class="btn btn-call-to-act bg-white border-4 border-blue-400 rounded-full py-4 px-8">SignUp Today</a>
        </div>
    </section>
</x-guest-layout>
