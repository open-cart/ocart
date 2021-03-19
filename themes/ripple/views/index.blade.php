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
    <section class="antialiased font-sans py-16 max-w-7xl mx-auto px-4 sm:px-6">Footer</section>
</x-guest-layout>
