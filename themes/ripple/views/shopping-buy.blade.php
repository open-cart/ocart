<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom mt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            <div>
                <h2 class="text-4xl font-bold text-blue-600 capitalize mb-4">Đặt hàng</h2>
                <form class="mb-4">
                    <div class="mb-4">
                        <div class="relative">
                            <x-theme::form.input type="text" class="pl-12" placeholder="Họ tên"/>
                            <x-theme::icons.user-circle class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="relative">
                            <x-theme::form.input type="text" class="pl-12" placeholder="Số điện thoại"/>
                            <x-theme::icons.phone class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="relative">
                            <x-theme::form.input type="text" class="pl-12" placeholder="Email"/>
                            <x-theme::icons.mail class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="relative">
                            <x-theme::form.input type="text" class="pl-12" placeholder="Địa chỉ giao hàng"/>
                            <x-theme::icons.location-marker class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
                        </div>
                    </div>
                    <div class="hero-search-action">
                        <button type="submit" class="btn block text-xl text-white bg-blue-600 p-5 w-full text-center rounded-md">Đặt hàng</button>
                    </div>
                    <div class="mt-2 text-base text-gray-500">
                        Bằng cách nhấp vào 'Đặt hàng', bạn đồng ý với chúng tôi <a href="#" class="underline" title="Chính sách bảo mật" target="_blank">Chính sách bảo mật</a> và <a href="#" class="underline" title="điều khoản dịch vụ" target="_blank">điều khoản dịch vụ</a>. Bạn cũng đồng ý nhận cập nhật email định kỳ, giảm giá và ưu đãi đặc biệt.
                    </div>
                </form>
            </div>
            <div>
                <div class="flex justify-between items-center border-b pb-4">
                    <h1 class="font-semibold text-2xl">Thông tin đơn hàng</h1>
                    <a href="{!! route('shopping-cart') !!}" class="font-semibold text-sm text-blue-600 hover:text-blue-700">Chỉnh sửa đơn hàng</a>
                </div>
                <div class="mb-4">
                    @foreach($cart as $item)
                        <div class="flex items-center border-b hover:bg-gray-100 px-6 py-5">
                            <div class="flex w-4/5"> <!-- product -->
                                <div class="w-16">
                                    <img class="h-16" src="{{ TnMedia::url($item->options->image ?? '/images/no-image.jpg') }}" alt="">
                                </div>
                                <div class="flex-1 flex-col justify-between ml-4 flex-grow">
                                    <span class="font-bold text-sm line-clamp-2">{{ $item->name }}</span>
                                    <span class="text-red-500 text-xs">{{ $item->price }}</span>
                                </div>
                            </div>
                            <div class="text-right w-1/5 font-semibold text-sm">Số lượng: {{ $item->qty }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between items-center">
                    <div class="font-bold text-2xl">Tổng cộng</div>
                    <div href="{!! route('shopping-cart') !!}" class="font-bold text-2xl text-red-600">{{ Cart::priceTotal(0, '.', '.') }}</div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
