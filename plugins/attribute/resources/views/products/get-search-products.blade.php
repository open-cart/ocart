@foreach($products as $product)
    @if(count($product->version))
        <div class="">
            <div class="flex items-center py-1 px-2">
                <div class="w-8 h-8 border rounded">
                    <img src="{!! TnMedia::url($product->image ?? null) ?? asset('/images/no-image.jpg') !!}"
                         class="w-full h-full" alt="img" />
                </div>
                <span class="pl-2">{!! $product->name !!}</span>
            </div>
            @foreach($product->version as $version)
                <div class="attr pl-10">
                    <div class="cursor-pointer hover:bg-blue-50 dark:hover:bg-gray-600"
                         x-on:click='change($dispatch, @json($version->product))'>
                        <div class="py-1 pl-3 pr-2">
                            @php
                                $a = $version->product->attributes->pluck('attribute.title');
                                $a = $a->map(function ($txt){
                                    return '<span class="text-green-600">'.$txt.'</span>';
                                });
                                echo join(' / ', $a->toArray());
                            @endphp
                            <span class="text-sm">(Có sẵn)</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="cursor-pointer hover:bg-blue-50 dark:hover:bg-gray-600"
             x-on:click='change($dispatch, @json($product))'>
            <div class="flex items-center py-1 px-2">
                <div class="w-8 h-8 border rounded">
                    <img src="{!! TnMedia::url($product->image ?? null) ?? asset('/images/no-image.jpg') !!}"
                         class="w-full h-full" alt="img" />
                </div>
{{--                <img src="{!! TnMedia::url($product->image ?? null) ?? '/images/no-image.jpg' !!}"--}}
{{--                     class="w-12 px-2" alt="img" />--}}
                <span class="pl-2">{!! $product->name !!}</span>
            </div>
        </div>
    @endif
    @if($loop->last)
        <hr class="-mx-3 dark:border-gray-600">
    @else
        <hr class="dark:border-gray-600">
    @endif
@endforeach
<div class="flex justify-between py-2">
    <div></div>
    {!! $products->links('plugins.ecommerce::partials.paginate') !!}
</div>