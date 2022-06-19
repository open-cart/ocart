@if(!empty(theme_options()->getOption('banner2', null)))
<section class="section-custom pt-8">
    <div class="container-custom">
        <div class="text-center">
            <a
                href="{{ theme_options()->getOption('link_banner2', 'javascript:void(0)') }}"
                class="inline-block"
            >
                <img
                    data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('banner2', null) . '?w=400&h=400', asset('/images/no-image.jpg')) }}"
                    data-srcset="{{ TnMedia::getImageUrl(theme_options()->getOption('banner2', null) . '?w=400&h=400', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(theme_options()->getOption('banner2', null), asset('/images/no-image.jpg')) }} 2000w"
                    src="{{ asset('/images/no-image.jpg') }}"
                    alt="banner"
                    class="mx-auto lozad"
                >
            </a>
        </div>
    </div>
</section>
@endif
