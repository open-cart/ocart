<footer class="text-gray-300 dark-footer skin-dark-footer">
    <div class="bg-gray-800">
        <div class="container-custom py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:justify-items-end">
                <div class="footer-widget">
                    <a href="{!! route('home') !!}">
                        @php
                            $logo = get_logo_footer();
                        @endphp
                        <img src="{{ $logo }}" class="img-footer w-2/4 mb-3" alt="">
                    </a>
                    <h4 class="widget-title mb-3 font-bold text-lg text-white">{!! get_deps_footer() !!}</h4>
                    <p>Văn phòng đại diện: {!! get_address() !!}</p>
                    <p>Xưởng sản xuất: {!! get_address2() !!}</p>
                    <p>Hotline: {!! get_phone() !!}</p>
                </div>
                @php
                    $menuFooter = get_menu_footer();
                @endphp
                @if(!empty($menuFooter) && !empty($menuFooter->data) && is_array($menuFooter->data))
                    @foreach($menuFooter->data as $item)
                        <div class="footer-widget">
                            <h4 class="widget-title mb-3 font-bold text-lg text-white">{{ $item->title }}</h4>
                            @if(!empty($item->menu) && is_array($item->menu))
                                <ul class="footer-menu">
                                    @foreach($item->menu as $i)
                                        @if(!empty($i->slug))
                                            <li><a href="{{ $i->slug }}">{{ $i->name }}</a></li>
                                        @else
                                            <li>{{ $i->name }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="footer-bottom bg-gray-900">
        <div class="container-custom align-items-center py-4">
            @php
                $domain = get_domain();
            @endphp
            <p class="mb-0">© 2021 {{ $domain }} Designd By <a href="https://sevenweb.vn">SevenWeb</a> All Rights
                Reserved</p>
        </div>
    </div>
</footer>
