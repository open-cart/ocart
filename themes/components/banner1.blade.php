@if(!empty(theme_options()->getOption('banner1', null)))
<section class="section-custom pb-0">
    <div class="container-custom">
        <div class="text-center">
            <a
                href="{{ theme_options()->getOption('link_banner1', 'javascript:void(0)') }}"
                class="block"
            >
                <img
                    data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('banner1', null) . '?w=400&h=400', asset('/images/no-image.jpg')) }}"
                    data-srcset="{{ TnMedia::getImageUrl(theme_options()->getOption('banner1', null) . '?w=400&h=400', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(theme_options()->getOption('banner1', null) . '?w=850&h=850', asset('/images/no-image.jpg')) }} 2000w"
                    src="{{ asset('/images/no-image.jpg') }}"
                    alt="banner"
                    class="w-8/12 lg:h-36 mx-auto lozad"
                >
            </a>
        </div>
    </div>
</section>
@endif
