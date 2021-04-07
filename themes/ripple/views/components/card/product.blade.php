@props(['data' => null])
@if($data)
    <div class="h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-60 overflow-hidden">
            <a href="/product/{{ $data->id }}">
                <img class="absolute inset-0 h-full w-full object-cover" src="{{ TnMedia::url(head($data->images)) }}" alt="">
            </a>
        </div>
        <div class="p-4">
            <span class="inline-block leading-none text-gray-500 tracking-wide text-xs">
                {{ Arr::get($data->categories->first(), 'name') }}
            </span>
            <a href="/product/{{ $data->id }}">
                <h3 class="mb-2 font-bold">{{ $data->name }}</h3>
            </a>
            <div class="text-sm text-gray-500 line-clamp-3">{!! $data->description !!}</div>
            <div class="flex justify-between items-center mt-3">
                <div class="flex text-red-600">
                    @if($data->price >= 1)
                        <span class="font-bold text-2xl">{{ $data->price }}</span>
                        &nbsp;
                        <span class="text-sm font-semibold">đ</span>
                    @else
                        <span class="font-bold text-2xl">Liên hệ</span>
                    @endif
                    @if($data->price >= 1 && $data->price < $data->price_sell)
                        <span class="font-medium line-through text-gray-300 text-lg ml-4">{{ $data->price_sell }}</span>
                        &nbsp;
                        <span class="text-sm font-semibold text-gray-300 line-through">đ</span>
                    @endif
                </div>
                <button onclick="addToCart({{ $data }})" class="flex text-blue-600 p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:text-green-500" title="Thêm vào giỏ hàng">
                    <x-theme::icons.shopping-cart class="w-7"/>
                </button>
            </div>
        </div>
        @if($data->address)
            <div class="p-4 border-t text-sm text-gray-500">
                <span class="flex items-center">
                    <x-theme::icons.marker/> {{ $data->address }}
                </span>
            </div>
        @endif

        <div class="flex justify-between p-4 border-t items-center text-sm text-gray-600">
            <div class="flex">
                <x-theme::icons.star class="text-yellow-500"/>
                <x-theme::icons.star class="text-yellow-500"/>
                <x-theme::icons.star class="text-yellow-500"/>
                <x-theme::icons.star class="text-yellow-500"/>
                <x-theme::icons.star class="text-gray-400"/>
                <span class="ml-1">34 Đánh giá</span>
            </div>
            @if($data->created_at)
                <div class="flex">
                    <x-theme::icons.calendar/>
                    <span class="ml-1">{{ date_format($data->created_at, "d/m/Y") }}</span>
                </div>
            @endif
        </div>
    </div>

@endif

<script>
    function addToCart($data) {
        axios.post('{!! route('add-to-cart') !!}', {
            data: $data
        }).then((res) => {
            toast.success('Thêm vào giỏ thành công.');
        }).catch(e => {
            toast.error(e.message)
        }).finally(() => {
            // $.pjax.reload('#body', {});
        })
    }
</script>