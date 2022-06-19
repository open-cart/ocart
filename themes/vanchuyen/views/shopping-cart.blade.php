<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @if(is_active_plugin('ecommerce'))
        @if(get_cart_count() > 0)
            <div class="container-custom mt-10">
                <div class="lg:flex shadow-md my-10">
                    <div class="w-full lg:w-3/4 bg-white px-2 md:px-4 lg:px-10 py-10 border-t border-gray-100">
                        <div class="flex justify-between border-b pb-8">
                            <h1 class="font-semibold text-2xl text-blue-600">Giỏ hàng</h1>
                            <h2 class="font-semibold text-2xl">
                                <span class="cart-count">{{ get_cart_count() }}</span> sản phẩm
                            </h2>
                        </div>
                        <div class="flex mt-10 mb-5">
                            <h3 class="font-semibold text-gray-600 text-xs uppercase w-4/5">Chi tiết sản phẩm</h3>
                            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Số
                                lượng</h3>
                        </div>
                        @foreach($cart as $item)
                            <div x-data='shoppingCartData(@json($item))'
                                 class="flex items-center hover:bg-gray-100 lg:-mx-6 lg:px-6 py-5">
                                <div class="flex w-4/5"> <!-- product -->
                                    <div class="w-20">
                                        <img class="h-24"
                                             src="{{ TnMedia::getImageUrl($item->options->image, 'medium', asset('/images/no-image.jpg')) }}"
                                             alt="{{ $item->name }}">
                                    </div>
                                    <div class="flex flex-col justify-between ml-4 flex-grow">
                                        <a href="/product/{{ $item->options->slug }}"
                                           class="font-bold text-sm hover:text-blue-700 line-clamp-2">{{ $item->name }}</a>
                                        <div class="text-red-500 text-xs">{{ format_price($item->price) }}</div>
                                        <div class="text-gray-500 text-xs">
                                            @if($item->options->attrs)
                                                @foreach($item->options->attrs as $key => $iitem)
                                                    <span>{{ $iitem['attribute_group']['title'] }}:{{ $iitem['attribute']['title'] }}</span>
                                                    @if(count($item->options->attrs) != $key+1)
                                                        <span>, </span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <button x-on:click="removeProduct()"
                                                class="w-5 text-gray-400 rounded-full hover:text-red-500 focus:outline-none focus:text-red-500"
                                                title="Xóa sản phẩm">
                                            <x-theme::icons.trash class="w-5"/>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex justify-center w-1/5">
                                    <button class="hidden sm:block"
                                            x-on:click="product.qty = Number(product.qty)-1"
                                            x-on:click.debounce="updateQuantity()"
                                            x-bind:disabled="product.qty < 2">
                                        <x-theme::icons.minus class="fill-current text-gray-600"/>
                                    </button>

                                    <input class="mx-2 border text-center w-12"
                                           type="number"
                                           min="1"
                                           x-on:input.debounce="updateQuantity()"
                                           x-model="product.qty"
                                    >

                                    <button class="hidden sm:block"
                                            x-on:click="product.qty = Number(product.qty)+1"
                                            x-on:click.debounce="updateQuantity()">
                                        <x-theme::icons.plus class="fill-current text-gray-600"/>
                                    </button>

                                </div>
                            </div>
                        @endforeach

                        <a href="/" class="flex font-semibold text-blue-600 text-sm mt-10">

                            <svg class="fill-current mr-2 text-blue-600 w-4 h-4" viewBox="0 0 448 512">
                                <path
                                    d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
                            </svg>
                            Tiếp tục mua sắm
                        </a>
                    </div>

                    <div id="summary" class="w-full lg:w-1/4 px-4 lg:px-8 py-10 bg-gray-100">
                        <h1 class="font-semibold text-2xl border-b pb-8">Thông tin</h1>
                        <div class="flex justify-between mt-10 mb-5">
                            <span class="font-semibold text-sm uppercase"><span
                                    class="cart-count">{{ get_cart_count() }}</span> sản phẩm</span>
                            <span class="font-semibold text-sm">{{ format_price(get_cart_subtotal()) }}</span>
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
                                <span class="font-bold">Tổng đơn</span>
                                <span class="text-red-600 font-bold">{{ format_price(get_cart_pricetotal()) }}</span>
                            </div>
                            @if(get_cart_count() > 0)
                                <a href="{{ route(ROUTE_SHOPPING_BUY_SCREEN_NAME) }}"
                                   class="inline-block text-center bg-blue-600 font-semibold hover:bg-blue-700 py-3 text-sm text-white uppercase w-full rounded-md">
                                    Tiến hành đặt hàng</a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <script type="text/javascript">
                function shoppingCartData(item) {
                    return {
                        product: item,
                        updateQuantity() {
                            if (this.product.qty < 1) {
                                this.product.qty = 1;
                            }
                            if (this.product.qty > 100) {
                                this.product.qty = 100;
                            }

                            axios.post('{!! route(ROUTE_UPDATE_TO_CART_NAME) !!}', {
                                rowId: this.product.rowId,
                                qty: this.product.qty
                            }).then((res) => {
                                toast.success(res.message);
                                $(".cart-count").text(res.count);
                                $.pjax.reload('#body', {});
                            }).catch(e => {
                                toast.error(e.message)
                            }).finally(() => {
                                // $.pjax.reload('#body', {});
                            })
                        },
                        removeProduct() {
                            axios.post('{!! route(ROUTE_REMOVE_TO_CART_NAME) !!}', {
                                rowId: this.product.rowId,
                            }).then((res) => {
                                toast.success(res.message);
                                $(".cart-count").text(res.count);
                                $.pjax.reload('#body', {});
                            }).catch(e => {
                                toast.error(e.message)
                            }).finally(() => {
                                // $.pjax.reload('#body', {});
                            })
                        }
                    }
                }
            </script>
        @else
            <section class="bg-gray-100 h-screen">
                <div class="container-custom">
                    <div class="py-10">
                        <h2 class="text-xl font-bold mb-2">Giỏ hàng</h2>
                        <div class="bg-white py-10 px-2 text-center">
                            <img
                                src="/images/shopping-cart.png?w=300"
                                alt="cart"
                                class="w-48 mx-auto mb-6"
                            >

                            <div class="mb-6 px-4">
                                Không có sản phẩm nào trong giỏ hàng của bạn.
                            </div>
                            <a
                                href="/"
                                class="inline-block font-bold bg-yellow-300 text-sm px-10 py-3 rounded-sm"
                            >
                                Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif
</x-guest-layout>
