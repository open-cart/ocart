<footer class="text-gray-300 dark-footer skin-dark-footer">
    <div class="bg-gray-800">
        <div class="container-custom py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="footer-widget col-span-2">
                    @php
                        $address1 = theme_options()->getOption('address1', null);
                        $address2 = theme_options()->getOption('address2', null);
                        $hotline1 = theme_options()->getOption('phone1', null);
                        $hotline2 = theme_options()->getOption('phone2', null);
                        $email = theme_options()->getOption('email', null);
                    @endphp
                    <h4 class="widget-title mb-3 font-bold text-lg text-white">{!! get_title() !!}</h4>
                    <p>{!! get_deps_footer() !!}</p>
                    @if($hotline1)
                        <p>Hotline: {!! $hotline1 !!}
                        @if($hotline2)
                            <span> - {!! $hotline2 !!}</span>
                        @endif
                        </p>
                    @endif
                    @if($email)
                        <p>Email: {!! $email !!}</p>
                    @endif
                    @if($address1)
                    <p>Địa chỉ 1: {!! $address1 !!}</p>
                    @endif
                    @if($address2)
                    <p>Địa chỉ 2: {!! $address2 !!}</p>
                    @endif
                </div>

                <!-- Menu Footer -->
                @if(function_exists('footer_navigation'))
                    @php
                        $menuFooter = footer_navigation();
                        $menuFooter = parent_recursive($menuFooter->toArray());
                    @endphp
                    @if(!empty($menuFooter) && is_array($menuFooter))
                        @foreach($menuFooter as $item)
                            @php
                                $children = Arr::get($item, 'children');
                            @endphp

                            @if(!empty($children))
                                <div class="footer-widget">
                                    <h4 class="widget-title mb-3 font-bold text-lg text-white">
                                        {{ Arr::get($item, 'title') }}
                                    </h4>
                                    <ul class="footer-menu">
                                        @foreach($children as $i)
                                            @if(!empty(Arr::get($i, 'url')))
                                                <li><a href="{{ Arr::get($i, 'url') }}" target="{{ Arr::get($i, 'target') }}">{{ Arr::get($i, 'title') }}</a></li>
                                            @else
                                                <li>{{ Arr::get($i, 'title') }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endif

            </div>
        </div>
    </div>

    <div class="footer-bottom bg-gray-900 mb-12 lg:mb-0" >
        <div class="container-custom align-items-center py-4">
            @php
                $domain = theme_options()->getOption('domain_web', '');
            @endphp
            <p class="mb-0">© 2021 {{ $domain }} Designd By <a href="https://zalo.me/0972675428" rel="noreferrer nofollow" target="_blank">SevenWeb</a> All Rights
                Reserved</p>
        </div>
    </div>
</footer>
