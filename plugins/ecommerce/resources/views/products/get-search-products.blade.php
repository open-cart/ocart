{{--<div class="">--}}
{{--    <div class="flex items-center h-12">--}}
{{--        <i class="fa fa-image px-3"></i>--}}
{{--        <span class="pl-2">Ten san pham</span>--}}
{{--    </div>--}}
{{--    <div class="attr pl-10">--}}
{{--        <div class="cursor-pointer hover:bg-blue-50" x-on:click="change">--}}
{{--            <div class="py-3 px-2">--}}
{{--                <span class="text-green-600">Text</span>--}}
{{--                <span>(...)</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@foreach($products as $product)
<div class="cursor-pointer hover:bg-blue-50" x-on:click="change($dispatch, JSON.parse('{{ json_encode($product) }}'))">
    <div class="flex items-center h-12">
        <img src="{!! TnMedia::url($product->image ?? null) ?? '/images/no-image.jpg' !!}" class="w-12 px-2" alt="img" />
        <span class="pl-2">{!! $product->name !!}</span>
    </div>
</div>
@if($loop->last)
    <hr class="-mx-3">
@else
    <hr>
@endif
@endforeach
<div class="flex justify-between py-2">
    <div>&nbsp;</div>
    <div>
        <x-button>Next</x-button>
    </div>
</div>