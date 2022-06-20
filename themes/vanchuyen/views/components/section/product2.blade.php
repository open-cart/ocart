@php
    $products_new = get_list_products_new(7);
@endphp
@if(count($products_new))
<section {!! $attributes->merge(['class' => 'sec-product2 section-custom antialiased text-gray-900']) !!}>
    <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-8">
        <h2 class="text-xl md:text-2xl font-bold">{{ theme_options()->getOption('title_product2', '') }}</h2>
        <p class="text-sm md:text-base text-gray-600">{{ theme_options()->getOption('deps_product2', '') }}</p>
    </div>
    <div class="container-custom">
        <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
            @foreach($products_new as $key=>$product)
                @if($key == 1)
                    <div class="hidden lg:block col-span-2">
                        <x-theme::card.product-horizontal-big :data="$product"/>
                    </div>
                @else
                    <div>
                        <x-theme::card.product :data="$product"/>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif
