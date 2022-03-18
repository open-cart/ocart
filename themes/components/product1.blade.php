@php
    $products_feature = get_list_products_feature(8);
@endphp
@if(count($products_feature))
<section {!! $attributes->merge(['class' => 'section-custom sec-product1 antialiased text-gray-900']) !!}>
        <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-8">
            <h2 class="text-xl md:text-2xl font-bold">{{ theme_options()->getOption('title_product1', '') }}</h2>
            <p class="text-sm md:text-base text-gray-600">{{ theme_options()->getOption('deps_product1', '') }}</p>
        </div>
        <div class="container-custom">
            <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                @foreach($products_feature as $product)
                    <x-theme::card.product :data="$product"/>
                @endforeach
            </div>
        </div>
</section>
@endif
