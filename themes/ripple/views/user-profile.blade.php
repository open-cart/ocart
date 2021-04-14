<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @if(Auth::user())
        <div class="container-custom flex flex-wrap py-6">
            @include(Theme::getThemeNamespace('layouts.sidebar-profile'))

            <div x-data="{edit: false}" class="lg:w-3/4 w-full">
                <div class="text-xl font-bold mb-4">Thông tin cá nhân</div>
                <div class="p-6 grid grid-cols-3 gap-4">
                    <div class="mb-6">
                        <label>Họ tên</label>
                        <x-theme::form.input type="text" placeholder="Họ tên" x-bind:disabled="!edit" value="{{ Auth::user()->name }}"/>
                    </div>
                    <div class="mb-6">
                        <label>Email</label>
                        <x-theme::form.input type="text" placeholder="Email" disabled value="{{ Auth::user()->email }}"/>
                    </div>
                    <div class="mb-6">
                        <label>Số điện thoại</label>
                        <x-theme::form.input type="text" placeholder="Số điện thoại" disabled/>
                    </div>
                    <div class="mb-6">
                        <label>Ngày sinh</label>
                        <x-theme::form.input type="text" placeholder="Ngày sinh" disabled/>
                    </div>
                    <div class="mb-6">
                        <label>Giới tính</label>
                        <x-theme::form.input type="text" placeholder="Giới tính" disabled/>
                    </div>
                    <div class="mb-6">
                        <label>Mã số thuế</label>
                        <x-theme::form.input type="text" placeholder="Mã số thuế" disabled/>
                    </div>
                    <div>
                        <button x-on:click="edit = true" type="submit" x-show="!edit" class="btn block text-lg text-white bg-blue-600 p-3 w-full text-center rounded-md mt-3">Sửa thông tin</button>
                        <button type="submit" x-show="!edit" class="btn block text-lg text-white bg-blue-600 p-3 w-full text-center rounded-md mt-3">Đổi mật khẩu</button>
                        <button type="submit" x-show="edit" class="btn block text-lg text-white bg-green-600 p-3 w-full text-center rounded-md mt-3">Lưu thay đổi</button>

                    </div>
                </div>
            </div>
        </div>

    @endif

</x-guest-layout>
