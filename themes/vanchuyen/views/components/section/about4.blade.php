<section class="sec-about4 section-custom antialiased" style="background-color: rgba(59,130,246,1) !important;">
    <div class="container-custom">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full xl:w-1/2 p-4 pt-14 text-white">
                <h2 class="text-xl md:text-2xl font-bold pl-4 border-l-2 mb-4">
                    {!! theme_options()->getOption('title_about4', '') !!}
                </h2>
                <div>{!! theme_options()->getOption('deps_about4', '') !!}</div>
                @if(!empty(theme_options()->getOption('link_about4', '')))
                <div class="mt-12">
                    <a
                        href="{{ theme_options()->getOption('link_about4', '') }}"
                        class="bg-red-600 py-1.5 px-8 font-bold rounded-sm"
                    >
                        Chi tiết
                    </a>
                </div>
                @endif
            </div>
            <div class="w-full xl:w-1/2 p-4">
                <div class="image relative">
                    <div class="md:pl-0 md:p-10">
                        <img
                            data-src="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about4', null)) ? theme_options()->getOption('image_about4', null) . '?w=400' : asset('/images/no-image.jpg')) }}"
                            data-srcset="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about4', null)) ? theme_options()->getOption('image_about4', null) . '?w=400' : asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about4', null)) ? theme_options()->getOption('image_about4', null) . '?w=600' : asset('/images/no-image.jpg')) }} 2000w"
                            src="{{ asset('/images/no-image.jpg') }}"
                            class="w-full h-full block m-auto relative lozad rounded-md border-4 border-white md:border-none shadow-2xl"
                            alt="about"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media (min-width: 768px) {
            .sec-about4 .image:before {
                content: "";
                position: absolute;
                top: 0;
                width: 50%;
                height: 100%;
                border: 4px solid #fff;
                right: 0;
            }
        }

    </style>

</section>
