<section class="section-custom py-6">
    <div class="container-custom">
        <div class="grid grid-cols-2 sm:grid-cols-9 gap-2 md:gap-2.5 mx-auto">
            <div class="mx-auto col-span-full sm:col-span-5 w-full">
                <a
                    class="h-full group flex justify-center relative overflow-hidden effect"
                    href="{{ theme_options()->getOption('link_grid1', 'javascript:void(0)') }}"
                >
                    <img
                        data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1', null) . '?w=400', asset('/images/no-image.jpg')) }}"
                        data-srcset="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1', null) . '?w=400', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(theme_options()->getOption('grid1', null), 'large', asset('/images/no-image.jpg')) }} 2000w"
                        src="{{ asset('/images/no-image.jpg') }}"
                        alt="banner gird 1"
                        class="bg-gray-300 object-cover w-full h-40 lg:h-64 lozad"
                    />
                </a>
            </div>
            <div class="mx-auto col-span-1 sm:col-span-2 w-full">
                    <a
                        class="h-full group flex justify-center relative overflow-hidden effect"
                        href="{{ theme_options()->getOption('link_grid1_2', 'javascript:void(0)') }}"
                    >
                        <img
                            data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1_2', null) . '?w=200', asset('/images/no-image.jpg')) }}"
                            data-srcset="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1_2', null) . '?w=200', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(theme_options()->getOption('grid1_2', null), 'medium', asset('/images/no-image.jpg')) }} 2000w"
                            src="{{ asset('/images/no-image.jpg') }}"
                            alt="banner gird 2"
                            class="bg-gray-300 object-cover w-full h-40 lg:h-64 lozad"
                        />
                    </a>
            </div>
            <div class="mx-auto col-span-1 sm:col-span-2 w-full">
                    <a
                        class="h-full group flex justify-center relative overflow-hidden effect"
                        href="{{ theme_options()->getOption('link_grid1_3', 'javascript:void(0)') }}"
                    >
                        <img
                            data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1_3', null) . '?w=200', asset('/images/no-image.jpg')) }}"
                            data-srcset="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1_3', null) . '?w=200', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(theme_options()->getOption('grid1_3', null), 'medium', asset('/images/no-image.jpg')) }} 2000w"
                            src="{{ asset('/images/no-image.jpg') }}"
                            alt="banner gird 3"
                            class="bg-gray-300 object-cover w-full h-40 lg:h-64 lozad"
                        />
                    </a>
            </div>
            <div class="mx-auto col-span-1 sm:col-span-2 w-full">
                    <a
                        class="h-full group flex justify-center relative overflow-hidden effect"
                        href="{{ theme_options()->getOption('link_grid1_4', 'javascript:void(0)') }}"
                    >
                        <img
                            data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1_4', null), 'medium', asset('/images/no-image.jpg')) }}"
                            src="{{ asset('/images/no-image.jpg') }}"
                            alt="banner gird 4"
                            class="bg-gray-300 object-cover w-full h-40 lg:h-64 lozad"
                        />
                    </a>
            </div>
            <div class="mx-auto col-span-1 sm:col-span-2 w-full">
                    <a
                        class="h-full group flex justify-center relative overflow-hidden effect"
                        href="{{ theme_options()->getOption('link_grid1_5', 'javascript:void(0)') }}"
                    >
                        <img
                            data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1_5', null) . '?w=200', asset('/images/no-image.jpg')) }}"
                            data-srcset="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1_5', null) . '?w=200', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(theme_options()->getOption('grid1_5', null), 'medium', asset('/images/no-image.jpg')) }} 2000w"
                            src="{{ asset('/images/no-image.jpg') }}"
                            alt="banner gird 5"
                            class="bg-gray-300 object-cover w-full h-40 lg:h-64 lozad"
                        />
                    </a>
            </div>
            <div class="mx-auto col-span-full sm:col-span-5 w-full">
                    <a
                        class="h-full group flex justify-center relative overflow-hidden effect"
                        href="{{ theme_options()->getOption('link_grid1_6', 'javascript:void(0)') }}"
                    >
                        <img
                            data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1_6', null) . '?w=400', asset('/images/no-image.jpg')) }}"
                            data-srcset="{{ TnMedia::getImageUrl(theme_options()->getOption('grid1_6', null) . '?w=400', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(theme_options()->getOption('grid1_6', null), 'large', asset('/images/no-image.jpg')) }} 2000w"
                            src="{{ asset('/images/no-image.jpg') }}"
                            alt="banner gird 6"
                            class="bg-gray-300 object-cover w-full h-40 lg:h-64 lozad"
                        />
                    </a>
            </div>
        </div>
    </div>
</section>
