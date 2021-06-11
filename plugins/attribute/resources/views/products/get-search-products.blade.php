@foreach($products as $product)
    @if(count($product->version))
        <div class="">
            <div class="flex items-center h-12">
                <img src="{!! TnMedia::url($product->image ?? null) ?? '/images/no-image.jpg' !!}"
                     class="w-12 px-2" alt="img" />
                <span class="pl-2">{!! $product->name !!}</span>
            </div>
            @foreach($product->version as $version)
                <div class="attr pl-10">
                    <div class="cursor-pointer hover:bg-blue-50 dark:hover:bg-gray-600"
                         x-on:click="change($dispatch, JSON.parse('{{ json_encode($version->product) }}'))">
                        <div class="py-3 px-2">
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
             x-on:click="change($dispatch, JSON.parse('{{ json_encode($product) }}'))">
            <div class="flex items-center h-12">
                <img src="{!! TnMedia::url($product->image ?? null) ?? '/images/no-image.jpg' !!}"
                     class="w-12 px-2" alt="img" />
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