@php
    $partner = json_decode(theme_options()->getOption('images_partner1', []));
@endphp
@if(!empty($partner))
    <section class="section-custom antialiased">
        <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
            <h2 class="text-xl md:text-2xl font-bold">{{ theme_options()->getOption('title_partner1', '') }}</h2>
            <p class="text-gray-600">
                {{ theme_options()->getOption('deps_partner1', '') }}
            </p>
        </div>

        <div class="container-custom">
            <div class="flex flex-wrap">
                @foreach($partner as $item)
                    <div class="w-1/4 p-1 lg:p-2">
                        <div class="bg-gray-100 p-2 sm:py-4 sm:px-0">
                            <img
                                class="w-auto h-10 lg:h-12 mx-auto lozad"
                                data-src="{{ TnMedia::getImageUrl($item->img, 'thumb', asset('/images/no-image.jpg')) }}"
                                src="{{ asset('/images/no-image.jpg') }}"
                                alt="partner"
                            >
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
