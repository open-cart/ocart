<!-- This example requires Tailwind CSS v2.0+ -->
<header x-data="{ openMobile : false }" class="relative bg-white flex justify-center hover-menu">
    <div class="bg-menu">
        <div class="menu-left">
            <ul class="a-menu">
                <li><a href="">Trang Chủ</a></li>
                <li class="hover-tab"><a href="/about">Giới Thiệu</a>
                    <div class="tab">
                        <div class="">hello</div>
                    </div>
                </li>
                <li class="hover-tab"><a href="/atriment">Thành Tựu</a>
                    <div class="tab">
                        <div class="">hello</div>
                    </div>
                </li>
                <li class="hover-tab"><a href="/information">Thông Tin</a>
                    <div class="tab">
                        <div class="">hello</div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="menu-right">
            <img src="{{ Theme::asset('/img/logo-ximang.png') }}" alt="logo">
        </div>
    </div>
</header>
