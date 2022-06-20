<div class="section-contact1 antialiased bg-blue-500">
    <div class="container-custom call-to-act py-14 block sm:flex items-center">
        <div class="call-to-act-head text-white flex-1 mb-8 sm:mb-0">
            <h3 class="text-base md:text-2xl font-bold">
                {{ theme_options()->getOption('title_contact1', 'Đăng ký nhận bản tin') }}
            </h3>
            <span class="text-xs md:text-base">
                {{ theme_options()->getOption('deps_contact1', 'Nhận thông báo về dịch vụ, khuyến mãi, sản phẩm mới') }}
            </span>
        </div>
        <a href="javascript:void(0)"
           data-toggle="modal"
           data-target="#form-contact-modal"
           class="btn btn-call-to-act bg-white border-4 border-blue-400 rounded-full py-2 px-4 md:py-4 md:px-8"
        >
            Đăng ký ngay
        </a>
    </div>
</div>
<x-theme::form.contact-modal/>

