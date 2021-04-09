<div class="bg-white max-w-xl p-10 pt-8 shadow-md">
    <div class="mb-4">
        <h1 class="text-4xl font-extrabold capitalize">Bạn cần tư vấn mua bất động sản?</h1>
    </div>
    <form class="mb-4">
        <div class="mb-4">
            <div class="relative">
                <x-theme::form.input type="text" class="pl-12" placeholder="Họ tên" name="full_name"/>
                <x-theme::icons.user-circle class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
            </div>
        </div>
        <div class="mb-4">
            <div class="relative">
                <x-theme::form.input type="text" class="pl-12" placeholder="Số điện thoại" name="phone"/>
                <x-theme::icons.phone class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
            </div>
        </div>
        <div class="mb-4">
            <div class="relative">
                <x-theme::form.input type="email" class="pl-12" placeholder="Địa chỉ Email" name="email"/>
                <x-theme::icons.location-marker class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
            </div>
        </div>
        <div class="hero-search-action">
            <button type="submit" class="btn block text-xl text-white bg-blue-600 p-5 w-full text-center rounded-md" name="submit">Gửi cho chúng tôi</button>
        </div>
    </form>
</div>