<x-guest-layout>
    <div>
        <div class="py-12" style="background: #00a5ff">
            <div class="container-custom">
                <div class="text-white text-xl lg:text-3xl font-bold">
                    {{ $page->name }}
                </div>
                <div class="text-white">
                    {{ $page->description }}
                </div>
            </div>
        </div>
        <div class="section-custom container-custom content-mce">
            {!! $page->content !!}
        </div>
    </div>
</x-guest-layout>
