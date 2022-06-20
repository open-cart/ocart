<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom mb-4">
        <ol class="list-reset py-4 border-b border-gray-200 flex text-grey">
            <li class="pr-2"><a href="{!! route('home') !!}" class="no-underline text-blue-600">Home</a></li>
            <li>/</li>
            <li class="px-2 line-clamp-1"><span class="no-underline text-gray-500">{{ $tag->name }}</span></li>
        </ol>
    </div>

    <div class="container-custom flex flex-wrap pb-2">
        <div class="lg:w-3/4 w-full md:order-last px-0 lg:pl-4">
            @if(!empty($tag->description))
                <div class="mb-4 p-2 -mx-2 md:-mx-4">
                    <div class="p-4 bg-gray-100 rounded-md">{!! $tag->description !!}</div>
                </div>
            @endif
            @if(count($products)>0)
                <div class="flex flex-wrap -mx-2 md:-mx-4">
                    @foreach($products as $product)
                        <div class="w-1/2 xl:w-1/3 p-2 md:p-2 pt-0">
                            <x-theme::card.product :data="$product"/>
                        </div>
                    @endforeach
                </div>
                @if(method_exists($products, 'links'))
                    <div class="my-4">{!! $products->links() !!}</div>
                @endif
            @else
                <div class="p-2 -mx-2 md:-mx-4">
                    <div class="p-4 bg-gray-100 rounded-md">Chưa có sản phẩm nào</div>
                </div>
            @endif
        </div>

        @include(Theme::getThemeNamespace('layouts.sidebar-all'))

    </div>

</x-guest-layout>
