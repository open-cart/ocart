<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom my-10">
        @if(get_cart_count() > 0)
            {!! Form::open(['route' => ROUTE_SHOPPING_BUY_SCREEN_NAME]) !!}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div>
                    <div class="mb-4 form-order-buy space-y-8">
                        <div>
                            <h2 class="text-4xl font-bold text-blue-600 capitalize mb-4">Đặt hàng</h2>
                            <div class="mb-4">
                                <div class="relative">
                                    <x-theme::form.input value="{{ Arr::get($info, 'name') }}" name="name" id="name" type="text" class="pl-12" placeholder="Họ tên" required/>
                                    <x-theme::icons.user-circle class="w-5 text-gray-400 absolute top-7 left-4 transform -translate-y-2/4"/>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="relative">
                                    <x-theme::form.input value="{{ Arr::get($info, 'phone') }}" name="phone" id="phone" type="tel" class="pl-12" placeholder="Số điện thoại" required/>
                                    <x-theme::icons.phone class="w-5 text-gray-400 absolute top-7 left-4 transform -translate-y-2/4"/>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="relative">
                                    <x-theme::form.input value="{{ Arr::get($info, 'email') }}" name="email" id="email" type="text" class="pl-12" placeholder="Email" required/>
                                    <x-theme::icons.mail class="w-5 text-gray-400 absolute top-7 left-4 transform -translate-y-2/4"/>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="relative">
                                    <x-theme::form.input value="{{ Arr::get($info, 'address') }}" name="address" id="address" type="text" class="pl-12" placeholder="Địa chỉ giao hàng" required/>
                                    <x-theme::icons.location-marker class="w-5 text-gray-400 absolute top-7 left-4 transform -translate-y-2/4"/>
                                </div>
                            </div>
                            <input type="hidden" name="country" value="VN">
                        </div>
                        <div>
                            <h2  class="text-4xl font-bold text-blue-600 capitalize mb-4">Shipping method</h2>
                            <div>
                                <ul class="border-l border-r border-b">
                                    @foreach($shippingMethods as $shippingMethod)
                                        <li >
                                            <label class="block border-t p-3">
                                                <input type="radio"
                                                       onclick="reloadInfomation()"
                                                       name="shipping_option"
                                                       @if(Arr::get($info, 'shipping_option') == $shippingMethod['value']) checked @endif
                                                       value="{{ $shippingMethod['value'] }}">
                                                <span>{{ $shippingMethod['name'] }}</span>
                                                -
                                                @if ($shippingMethod['price'] > 0)
                                                    {{ format_price($shippingMethod['price']) }}
                                                @else
                                                    <strong>{{ trans('Free shipping') }}</strong>
                                                @endif
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-4xl font-bold text-blue-600 capitalize mb-4">Paymment method</h2>
                            <div>
                                <ul x-data="{tab: '{{ setting('default_payment_method') }}'}">
                                    @if (setting('payment_cod_status') == 1)
                                        <li class="border-b p-2" x-on:click="tab = 'cod'">
                                            <label>
                                                <input name="payment_method" @if(setting('default_payment_method') == 'cod') checked @endif value="cod" type="radio" />
                                                <span>
                                                        {{ get_payment_setting('name', 'cod', trans('Cash on delivery (COD)')) }}
                                                    </span>
                                            </label>
                                            <template x-if="true">
                                                <div x-show="tab === 'cod'">
                                                    {{ get_payment_setting('description', 'cod', trans('Please pay money directly to the postman, if you choose cash on delivery method (COD).')) }}
                                                </div>
                                            </template>
                                        </li>
                                    @endif
                                    @if (setting('payment_bank_transfer_status') == 1)
                                        <li class="p-2" x-on:click="tab = 'bank_transfer'">
                                            <label class="">
                                                <input name="payment_method" @if(setting('default_payment_method') == 'bank_transfer') checked @endif value="bank_transfer" type="radio">
                                                <span>
                                                        {{ get_payment_setting('name', 'bank_transfer', trans('Bank transfer')) }}
                                                    </span>
                                            </label>
                                            <template x-if="true">
                                                <div x-show="tab === 'bank_transfer'">
                                                    {{ get_payment_setting('description', 'bank_transfer', trans('Please send money to our bank account: VCB - 0011004423412')) }}
                                                </div>
                                            </template>
                                        </li>
                                    @endif
                                    @php
                                        $payload = [
        'amount' => get_cart_pricetotal(),
        'currency' => Str::upper(get_application_currency()->title),
        'name' => null];
                                        echo apply_filters(PAYMENT_FILTER_ADDITIONAL_PAYMENT_METHODS, null, $payload)
                                    @endphp
                                </ul>
                            </div>
                        </div>

                        <div class="hero-search-action">
                            <button type="submit"
                                    {{--                                        onclick="submit({{ $cart }})"--}}
                                    id="payment-checkout-btn"
                                    class="btn block text-xl text-white bg-blue-600 p-5 w-full text-center rounded-md">Đặt hàng</button>
                        </div>
                        <div class="mt-2 text-base text-gray-500">
                            Bằng cách nhấp vào 'Đặt hàng', bạn đồng ý với chúng tôi <a href="#" class="underline" title="Chính sách bảo mật" target="_blank">Chính sách bảo mật</a> và <a href="#" class="underline" title="điều khoản dịch vụ" target="_blank">điều khoản dịch vụ</a>. Bạn cũng đồng ý nhận cập nhật email định kỳ, giảm giá và ưu đãi đặc biệt.
                        </div>
                    </div>
                </div>
                <div id="information-order-checkout">
                    <div class="flex justify-between items-center border-b pb-4">
                        <h1 class="font-semibold text-2xl">Thông tin đơn hàng</h1>
                        <a href="{!! route(ROUTE_SHOPPING_CART_SCREEN_NAME) !!}" class="font-semibold text-sm text-blue-600 hover:text-blue-700">Chỉnh sửa đơn hàng</a>
                    </div>
                    <div class="mb-4">
                        @foreach($cart as $item)
                            <div class="flex items-center border-b hover:bg-gray-100 px-2 md:px-6 py-5">
                                <div class="flex w-4/5"> <!-- product -->
                                    <div class="w-16">
                                        <img class="h-16" src="{{ TnMedia::url($item->options->image ?? asset('/images/no-image.jpg')) }}" alt="">
                                    </div>
                                    <div class="flex-1 flex-col justify-between ml-4 flex-grow">
                                        <span class="font-bold text-sm line-clamp-2">{{ $item->name }}</span>
                                        <span class="text-red-500 text-xs">{{ format_price($item->price) }} đ</span>
                                    </div>
                                </div>
                                <div class="text-right w-1/5 font-semibold text-sm"><span class="hidden md:inline-block">Số lượng: </span> {{ $item->qty }}</div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="flex justify-between items-center">
                        <div class="font-bold text-xl">{{ trans('Subtotal') }}</div>
                        <div class="font-bold text-2xl text-red-600">{{ format_price(get_cart_subtotal()) }}</div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="font-bold text-xl">{{ trans('Shipping fee') }}</div>
                        <div class="font-bold text-2xl text-red-600">{{ format_price($shippingAmount) }}</div>
                    </div>
                    <hr>
                    <div class="flex justify-between items-center">
                        <div class="font-bold text-2xl">Tổng cộng</div>
                        <div class="font-bold text-2xl text-red-600">{{ format_price($amount) }}</div>
                    </div>

                </div>
            </div>
            </form>
        @else
            <div class="my-10 md:my-32 text-center">
                <h1 class="text-4xl text-red-600 mb-4">Giở hàng trống.</h1>
                <a href="/" class="text-blue-600 hover:text-blue-700">Tiếp tục mua hàng</a>
            </div>
        @endif

    </div>
    <script>
        function showError(e) {
            if (e?.errors) {
                toast.error(Object.values(e.errors).find(Boolean));

                var keyserror = Object.keys(e.errors)
                if (keyserror) {
                    for (x in keyserror) {
                        $("#" + keyserror[x]).addClass('text-red-600 border border-red-500 error:focus:border-red-500');
                    }
                }

            } else {
                toast.error(e.message);
            }
        }

        if (typeof reloadInfomation === 'undefined') {
            function reloadInfomation() {
                const name = $("#name").val();
                const phone = $("#phone").val();
                const email = $("#email").val();
                const address = $("#address").val();
                const shipping_option = $("[name=shipping_option]:checked").val();
                const shipping_method = $("[name=shipping_method]").val();

                axios.get('{!! route(ROUTE_SHOPPING_BUY_SCREEN_NAME) !!}', {
                    params: {
                        name: name,
                        phone: phone,
                        email: email,
                        address: address,
                        shipping_option: shipping_option,
                        country: 'VN',
                        shipping_method,
                        _pjax: '#information-order-checkout'
                    },
                    headers: {
                        'X-PJAX': 'true',
                        'X-PJAX-Container': '#information-order-checkout'
                    }
                }).then((res) => {
                    console.log('render html')
                    document.getElementById('information-order-checkout').innerHTML = res;
                });
            }
        }
    </script>
</x-guest-layout>
