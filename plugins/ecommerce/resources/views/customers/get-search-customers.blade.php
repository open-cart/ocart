@foreach($customers as $customer)
    <div class="cursor-pointer hover:bg-blue-50 dark:hover:bg-gray-600 -mx-3" x-on:click="change($dispatch, JSON.parse('{{ json_encode($customer) }}'))">
        <div class="flex items-center h-12">
            <img src="{!! TnMedia::url($customer->image ?? null) ?? '/images/no-image.jpg' !!}" class="w-8 h-8 ml-5 rounded-full" alt="img" />
            <div class="flex flex-col px-2">
                <div>{!! $customer->name !!}</div>
                <div class="text-blue-500">{!! $customer->email !!}</div>
            </div>
        </div>
    </div>
    <hr class="-mx-3 dark:border-gray-600">
@endforeach
<div class="flex justify-between py-2">
    <div></div>
    {!! $customers->links('plugins.ecommerce::partials.paginate') !!}
</div>