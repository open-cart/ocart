<x-guest-layout>
    <div class="image-cover hero-banner bg-no-repeat bg-cover bg-center"
         style="background-image:url(https://themezhub.net/resido-live/resido/assets/img/banner-1.jpg);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-20">
            <div class="hero-search-wrap">
                <div class="hero-search">
                    <h1>Form liên hệ</h1>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10 text-center">
                    <div class="sec-heading center">
                        <h2>How It Works?</h2>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="middle-icon-features-item">
                        <div class="icon-features-wrap"><div class="middle-icon-large-features-box f-light-success"><i class="ti-receipt text-success"></i></div></div>
                        <div class="middle-icon-features-content">
                            <h4>Evaluate Property</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have Ipsum available.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="middle-icon-features-item">
                        <div class="icon-features-wrap"><div class="middle-icon-large-features-box f-light-warning"><i class="ti-user text-warning"></i></div></div>
                        <div class="middle-icon-features-content">
                            <h4>Meet Your Agent</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have Ipsum available.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="middle-icon-features-item remove">
                        <div class="icon-features-wrap"><div class="middle-icon-large-features-box f-light-blue"><i class="ti-shield text-blue"></i></div></div>
                        <div class="middle-icon-features-content">
                            <h4>Close The Deal</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have Ipsum available.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
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
</x-guest-layout>
