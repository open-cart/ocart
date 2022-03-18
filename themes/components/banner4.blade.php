<section class="section-custom pb-0 hidden lg:block">
    <div class="">
        <div class="text-center relative">
            <a
                href="{{ theme_options()->getOption('link_banner4', 'javascript:void(0)') }}"
            >
                <img
                    data-src="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_banner4', null)) ? theme_options()->getOption('image_banner4', null) : asset('/images/no-image.jpg')) }}"
                    src="{{ asset('/images/no-image.jpg') }}"
                    alt="{{ theme_options()->getOption('title_banner4', '') }}"
                    class="mx-auto lozad"
                >
            </a>
            <div style="position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(9, 2, 90, 0.5) 0%, rgba(118, 158, 255, 0.5) 100%);
    z-index: 9;">
            </div>
            <div style="    background-color: rgb(2, 26, 84);
    position: absolute;
    left: 50%;
    bottom: -40px;
    transform: translateX(-50%);
    padding: 1.5rem;
    min-width: 60%;
    z-index: 9;">
                <div class="text-5xl font-bold text-white uppercase" style="font-family: sans-serif;">
                    <div class="mb-3">
                        {{ theme_options()->getOption('title_banner4', '') }}
                    </div>
                    <div>
                        {{ theme_options()->getOption('subtitle_banner4', '') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
