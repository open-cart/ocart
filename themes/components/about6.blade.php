<section class="sec-about1 hidden lg:block section-custom antialiased">
    <div class="container-custom">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                <div class="middle-icon-features-item text-center mt-4">
                    <div class="icon-features-wrap relative">
                        <div class="middle-icon-large-features-box f-light-success">
                            {!! theme_options()->getOption('icon_about1', '') !!}
                        </div>
                    </div>
                    <div class="middle-icon-features-content pt-4">
                        <h4 class="text-xl mb-3 font-bold">
                            {{ theme_options()->getOption('title_about1', '') }}
                        </h4>
                        <p class="text-gray-500">
                            {{ theme_options()->getOption('deps_about1', '') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                <div class="middle-icon-features-item text-center mt-4">
                    <div class="icon-features-wrap relative">
                        <div class="middle-icon-large-features-box f-light-warning">
                            {!! theme_options()->getOption('icon_about1_2', '') !!}
                        </div>
                    </div>
                    <div class="middle-icon-features-content pt-4">
                        <h4 class="text-xl mb-3 font-bold">
                            {{ theme_options()->getOption('title_about1_2', '') }}
                        </h4>
                        <p class="text-gray-500">
                            {{ theme_options()->getOption('deps_about1_2', '') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                <div class="middle-icon-features-item text-center mt-4">
                    <div class="icon-features-wrap relative remove">
                        <div class="middle-icon-large-features-box f-light-blue">
                            {!! theme_options()->getOption('icon_about1_3', '') !!}
                        </div>
                    </div>
                    <div class="middle-icon-features-content pt-4">
                        <h4 class="text-xl mb-3 font-bold">
                            {{ theme_options()->getOption('title_about1_3', '') }}
                        </h4>
                        <p class="text-gray-500">
                            {{ theme_options()->getOption('deps_about1_3', '') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
