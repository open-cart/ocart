<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10 border-t border-gray-100">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Giỏ hàng</h1>
                    <h2 class="font-semibold text-2xl">{{ Cart::count() }} sản phẩm</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Chi tiết sản phẩm</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Số lượng</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Giá</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Tổng</h3>
                </div>
                @foreach($cart as $item)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/5"> <!-- product -->
                            <div class="w-20">
                                <img class="h-24" src="{{ $item->options->image }}" alt="">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm">{{ $item->name }}</span>
                                @if($item->options && $item->options->category)
                                    <span class="text-red-500 text-xs">{{ $item->options->category['name'] }}</span>
                                @endif
                                <button onclick="removeToCart('{{ $item->rowId }}')" class="w-5 text-gray-400 rounded-full hover:text-red-500 focus:outline-none focus:text-red-500" title="Xóa sản phẩm">
                                    <x-theme::icons.trash class="w-5"/>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5">
                            <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                            </svg>

                            <input class="mx-2 border text-center w-8" type="text" value="{{ $item->qty }}">

                            <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                                <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                            </svg>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">{{ $item->price }}</span>
                        <span class="text-center w-1/5 font-semibold text-sm">{{ $item->qty * $item->price }}</span>
                    </div>
                @endforeach


                <a href="/" class="flex font-semibold text-blue-600 text-sm mt-10">

                    <svg class="fill-current mr-2 text-blue-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                    Tiếp tục mua sắm
                </a>
            </div>

            <div id="summary" class="w-1/4 px-8 py-10 bg-gray-100">
                <h1 class="font-semibold text-2xl border-b pb-8">Tổng phụ</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">{{ Cart::count() }} sản phẩm</span>
                    <span class="font-semibold text-sm">{{ Cart::initial(0, '.', '.') }}</span>
                </div>
                {{--<div>--}}
                    {{--<label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>--}}
                    {{--<select class="block p-2 text-gray-600 w-full text-sm">--}}
                        {{--<option>Standard shipping - $10.00</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="py-10">--}}
                    {{--<label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Promo Code</label>--}}
                    {{--<input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">--}}
                {{--</div>--}}
                {{--<button class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase rounded-md">Apply</button>--}}
                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Tổng đơn</span>
                        <span>{{ Cart::priceTotal(0, '.', '.') }}</span>
                    </div>
                    <button class="bg-blue-600 font-semibold hover:bg-blue-700 py-3 text-sm text-white uppercase w-full rounded-md">Tiến hành đặt hàng</button>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>

<script type="text/javascript">
    function removeToCart(rowId) {
        axios.post('{!! route('remove-to-cart') !!}', {
            rowId: rowId
        }).then((res) => {
            toast.success('Xóa sản phẩm khỏi giỏ hàng thành công.');
        }).catch(e => {
            toast.error(e.message)
        }).finally(() => {
            $.pjax.reload('#body', {});
        })
    }
</script>