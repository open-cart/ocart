@foreach($products as $product)
    <div class="">
        <div class="flex items-center py-2">
            <div class="flex-1 flex items-center">
                <img class="px-2 h-10" src="/images/no-image.jpg" alt="">
                <div class="flex flex-col flex-1">
                    <div class="flex space-x-2">
                        <x-link href="javascript:void(0)">
                            {!! $product->product_name !!}
                        </x-link>
                        @if($product->product->sku)
                        <span>(SKU: <strong class="uppercase">{!! $product->product->sku !!}</strong>)</span>
                        @endif
                    </div>
                    <div>
                        @php
                            $a = $product->product->attributes->pluck('attribute.title');
                            $a = $a->map(function ($txt){
                                return '<span>'.$txt.'</span>';
                            });
                            echo join(' / ', $a->toArray());
                        @endphp
                    </div>
                </div>
            </div>
            <x-link class="flex-1 max-w-24 text-right">
                {!! format_price($product->price) !!}
            </x-link>
            <div class="flex-1 max-w-8 flex justify-center">
                <span>x</span>
            </div>
            <div class="flex-1 max-w-12">
                <span>{!! $product->qty !!}</span>
            </div>
            <div class="flex-1 max-w-24 text-right">
                {!! format_price($product->price * $product->qty) !!}
            </div>
        </div>
    </div>
@endforeach