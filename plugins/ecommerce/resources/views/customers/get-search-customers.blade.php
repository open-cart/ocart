@foreach($customers as $customer)
    <div class="cursor-pointer hover:bg-blue-50" x-on:click="change($dispatch, JSON.parse('{{ json_encode($customer) }}'))">
        <div class="flex items-center h-12">
            <img src="{!! TnMedia::url($customer->image ?? null) ?? '/images/no-image.jpg' !!}" class="w-12 px-2" alt="img" />
            <span class="pl-2">{!! $customer->name !!}</span>
        </div>
    </div>
    @if($loop->last)
        <hr class="-mx-3">
    @else
        <hr>
    @endif
@endforeach
<div class="flex justify-between py-2">
    {!! $customers->links() !!}
</div>