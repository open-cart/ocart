<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom my-10">
        @if(get_cart_count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-4xl font-bold text-blue-600 capitalize mb-4">Đặt hàng</h2>
                    <div x-data="{name: '', phone: '', email: '', address: ''}" class="mb-4 form-order-buy">
                        <div class="mb-4">
                            <div class="relative">
                                <x-theme::form.input x-model="name" id="name" type="text" class="pl-12" placeholder="Họ tên" required/>
                                <x-theme::icons.user-circle class="w-5 text-gray-400 absolute top-7 left-4 transform -translate-y-2/4"/>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="relative">
                                <x-theme::form.input x-model="phone" id="phone" type="tel" class="pl-12" placeholder="Số điện thoại" required/>
                                <x-theme::icons.phone class="w-5 text-gray-400 absolute top-7 left-4 transform -translate-y-2/4"/>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="relative">
                                <x-theme::form.input x-model="email" id="email" type="text" class="pl-12" placeholder="Email" required/>
                                <x-theme::icons.mail class="w-5 text-gray-400 absolute top-7 left-4 transform -translate-y-2/4"/>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="relative">
                                <x-theme::form.input x-model="address" id="address" type="text" class="pl-12" placeholder="Địa chỉ giao hàng" required/>
                                <x-theme::icons.location-marker class="w-5 text-gray-400 absolute top-7 left-4 transform -translate-y-2/4"/>
                            </div>
                        </div>
                        <div class="hero-search-action">
                            <button type="button" onclick="submit({{ $cart }})" class="btn block text-xl text-white bg-blue-600 p-5 w-full text-center rounded-md">Đặt hàng</button>
                        </div>
                        <div class="mt-2 text-base text-gray-500">
                            Bằng cách nhấp vào 'Đặt hàng', bạn đồng ý với chúng tôi <a href="#" class="underline" title="Chính sách bảo mật" target="_blank">Chính sách bảo mật</a> và <a href="#" class="underline" title="điều khoản dịch vụ" target="_blank">điều khoản dịch vụ</a>. Bạn cũng đồng ý nhận cập nhật email định kỳ, giảm giá và ưu đãi đặc biệt.
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center border-b pb-4">
                        <h1 class="font-semibold text-2xl">Thông tin đơn hàng</h1>
                        <a href="{!! route('shopping-cart') !!}" class="font-semibold text-sm text-blue-600 hover:text-blue-700">Chỉnh sửa đơn hàng</a>
                    </div>
                    <div class="mb-4">
                        @foreach($cart as $item)
                            <div class="flex items-center border-b hover:bg-gray-100 px-2 md:px-6 py-5">
                                <div class="flex w-4/5"> <!-- product -->
                                    <div class="w-16">
                                        <img class="h-16" src="{{ TnMedia::url($item->options->image ?? '/images/no-image.jpg') }}" alt="">
                                    </div>
                                    <div class="flex-1 flex-col justify-between ml-4 flex-grow">
                                        <span class="font-bold text-sm line-clamp-2">{{ $item->name }}</span>
                                        <span class="text-red-500 text-xs">{{ format_price($item->price_sell) }}</span>
                                    </div>
                                </div>
                                <div class="text-right w-1/5 font-semibold text-sm"><span class="hidden md:inline-block">Số lượng: </span> {{ $item->qty }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="font-bold text-2xl">Tổng cộng</div>
                        <div href="{!! route('shopping-cart') !!}" class="font-bold text-2xl text-red-600">{{ format_price(get_cart_pricetotal()) }}</div>
                    </div>

                </div>
            </div>
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
        function submit(order) {
            if (order.length < 1) {
                return;
            }
            const name = $("#name").val();
            const phone = $("#phone").val();
            const email = $("#email").val();
            const address = $("#address").val();

            $(".form-order-buy input").removeClass('text-red-600 border border-red-500 error:focus:border-red-500');

            data = Object.values(order);
            this.data = this.data.map(product => ({id: product.id, qty: product.qty}));

            return axios.post('{!! route('shopping-buy') !!}', {
                name: name,
                phone: phone,
                email: email,
                address: address,
                products: this.data
            }).then((res) => {
                $(".cart-count").text(0);
                $.pjax.reload('#body', {
                    url: '{!! route('shopping-thank') !!}'
                });
                toast.success('Đặt mua hàng thành công.');
            }).catch(showError).finally(() => {
            });
        }
    </script>

</x-guest-layout>
