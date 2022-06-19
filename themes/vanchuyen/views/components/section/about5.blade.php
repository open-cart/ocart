<section
    class="sec-about5 section-custom antialiased"
    style="@if(!empty(theme_options()->getOption('bg_about_5', null))) background: url({{ TnMedia::getImageUrl(theme_options()->getOption('bg_about_5', null)) }}) center center no-repeat;background-size: cover @endif"
>
    <div class="container-custom">
        <div class="lg:grid lg:grid-cols-2 lg:gap-5 xl:gap-7">
            <div class="content-left p-4 lg:p-8 mb-4 lg:mb-0 rounded-md text-white bg-blue-400 relative">
                <div class="flex flex-wrap items-center">
                    <div class="w-24 h-24 lg:w-32 lg:h-32">
                        <img
                            data-src="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about5', null)) ? theme_options()->getOption('image_about5', null) . '?w=150' : asset('/images/no-image.jpg')) }}"
                            src="{{ asset('/images/no-image.jpg') }}"
                            class="w-full h-full object-cover rounded-full lozad"
                            alt="professional consultant 1"
                        >
                    </div>
                    <div class="flex-1 text-left ml-2 lg:ml-8 lg:pr-8">
                        <div class="text-xl lg:text-2xl font-bold">
                            {!! theme_options()->getOption('title_about5', '') !!}
                        </div>
                        <div>
                            {!! theme_options()->getOption('deps_about5', '') !!}
                        </div>
                        <div>
                            <a href="tel:{{ preg_replace( '/[^0-9]/', '', theme_options()->getOption('phone_about5', null) )}}">Phone: {!! theme_options()->getOption('phone_about5', '') !!}</a>
                        </div>
                        @if(theme_options()->getOption('zalo_about5', ''))
                        <div>
                            <a
                                href="https://zalo.me/{{ preg_replace( '/[^0-9]/', '', theme_options()->getOption('zalo_about5', null) )}}"
                                target="_blank"
                            >
                                Zalo: {!! theme_options()->getOption('zalo_about5', '') !!}
                            </a>
                        </div>
                        @endif
                        @if(theme_options()->getOption('facebook_about5', ''))
                        <div class="hidden lg:block hotline-phone-ring-wrap absolute right-5 top-5">
                            <div class="hotline-phone-ring">
                                <div class="hotline-phone-ring-circle"></div>
                                <div class="hotline-phone-ring-circle-fill bg-green-600 opacity-60"></div>
                                <div class="hotline-phone-ring-img-circle bg-green-600">
                                    <a
                                        href="{!! theme_options()->getOption('facebook_about5', '') !!}"
                                        class="pps-btn-img"
                                        target="_blank"
                                    >
                                        <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M22.0026 7.70215C14.1041 7.70215 7.70117 13.6308 7.70117 20.9442C7.70117 25.1115 9.78083 28.8286 13.0309 31.256V36.305L17.9004 33.6325C19.2 33.9922 20.5767 34.1863 22.0026 34.1863C29.9011 34.1863 36.304 28.2576 36.304 20.9442C36.304 13.6308 29.9011 7.70215 22.0026 7.70215ZM23.4221 25.5314L19.7801 21.6471L12.6738 25.5314L20.4908 17.2331L24.2216 21.1174L31.239 17.2331L23.4221 25.5314Z"
                                                  fill="white"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="content-right p-4 lg:p-8 mb-4 lg:mb-0 rounded-md text-white bg-yellow-400 relative">
                <div class="flex flex-wrap items-center">
                    <div class="w-24 h-24 lg:w-32 lg:h-32">
                        <img
                            data-src="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about5_2', null)) ? theme_options()->getOption('image_about5_2', null) . '?w=150' : asset('/images/no-image.jpg')) }}"
                            src="{{ asset('/images/no-image.jpg') }}"
                            class="w-full h-full object-cover rounded-full lozad"
                            alt="professional consultant 2"
                        >
                    </div>
                    <div class="flex-1 text-left ml-2 lg:ml-8 lg:pr-8">
                        <div class="text-xl lg:text-2xl font-bold">
                            {!! theme_options()->getOption('title_about5_2', '') !!}
                        </div>
                        <div>
                            {!! theme_options()->getOption('deps_about5_2', '') !!}
                        </div>
                        <div>
                            <a href="tel:{{ preg_replace( '/[^0-9]/', '', theme_options()->getOption('phone_about5_2', null) )}}">Phone: {!! theme_options()->getOption('phone_about5_2', '') !!}</a>
                        </div>
                        @if(theme_options()->getOption('zalo_about5_2', ''))
                        <div>
                            <a
                                href="https://zalo.me/{{ preg_replace( '/[^0-9]/', '', theme_options()->getOption('zalo_about5_2', null) )}}"
                                target="_blank"
                            >
                                Zalo: {!! theme_options()->getOption('zalo_about5_2', '') !!}
                            </a>
                        </div>
                        @endif
                        @if(theme_options()->getOption('facebook_about5_2', ''))
                        <div class="hidden lg:block hotline-phone-ring-wrap absolute right-5 top-5">
                            <div class="hotline-phone-ring">
                                <div class="hotline-phone-ring-circle"></div>
                                <div class="hotline-phone-ring-circle-fill bg-red-500 opacity-60"></div>
                                <div class="hotline-phone-ring-img-circle bg-red-500">
                                    <a
                                        href="{!! theme_options()->getOption('facebook_about5_2', '') !!}"
                                        class="pps-btn-img"
                                        target="_blank"
                                    >
                                        <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M22.0026 7.70215C14.1041 7.70215 7.70117 13.6308 7.70117 20.9442C7.70117 25.1115 9.78083 28.8286 13.0309 31.256V36.305L17.9004 33.6325C19.2 33.9922 20.5767 34.1863 22.0026 34.1863C29.9011 34.1863 36.304 28.2576 36.304 20.9442C36.304 13.6308 29.9011 7.70215 22.0026 7.70215ZM23.4221 25.5314L19.7801 21.6471L12.6738 25.5314L20.4908 17.2331L24.2216 21.1174L31.239 17.2331L23.4221 25.5314Z"
                                                  fill="white"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @-webkit-keyframes phonering-alo-circle-anim {
            0%{-webkit-transform:rotate(0) scale(0.5) skew(1deg);-webkit-opacity:0.1;}
            30%{-webkit-transform:rotate(0) scale(0.7) skew(1deg);-webkit-opacity:0.5;}
            100%{-webkit-transform:rotate(0) scale(1) skew(1deg);-webkit-opacity:0.1;}
        }
        @-webkit-keyframes phonering-alo-circle-fill-anim {
            0%{-webkit-transform:rotate(0) scale(0.7) skew(1deg);opacity:0.6;}
            50%{-webkit-transform:rotate(0) scale(1) skew(1deg);opacity:0.6;}
            100%{-webkit-transform:rotate(0) scale(0.7) skew(1deg);opacity:0.6;}
        }
        @-webkit-keyframes phonering-alo-circle-img-anim {
            0%{-webkit-transform:rotate(0) scale(1) skew(1deg);}
            10%{-webkit-transform:rotate(-25deg) scale(1) skew(1deg);}
            20%{-webkit-transform:rotate(25deg) scale(1) skew(1deg);}
            30%{-webkit-transform:rotate(-25deg) scale(1) skew(1deg);}
            40%{-webkit-transform:rotate(25deg) scale(1) skew(1deg);}
            50%{-webkit-transform:rotate(0) scale(1) skew(1deg);}
            100%{-webkit-transform:rotate(0) scale(1) skew(1deg);}
        }
        .hotline-phone-ring{
            position: relative;
            visibility: visible;
            background-color: transparent;
            width: 110px;
            height: 110px;
            cursor: pointer;
            z-index: 11;
            -webkit-backface-visibility: hidden;
            -webkit-transform: translateZ(0);
            transition: visibility .5s;
            left: 0;
            bottom: 0;
            display: block;
        }
        .hotline-phone-ring-circle {
            width: 110px;
            height: 110px;
            top: 0;
            left: 0;
            position: absolute;
            background-color: transparent;
            border-radius: 100%;
            border: 2px solid white;
            -webkit-animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
            animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
            transition: all .5s;
            -webkit-transform-origin: 50% 50%;
            -ms-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            opacity: 0.5;
        }
        .hotline-phone-ring-circle-fill {
            width: 80px;
            height: 80px;
            top: 16px;
            left: 16px;
            position: absolute;
            /*background-color: rgba(21, 100, 167, 0.7);*/
            border-radius: 100%;
            border: 2px solid transparent;
            -webkit-animation: phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
            animation: phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
            transition: all .5s;
            -webkit-transform-origin: 50% 50%;
            -ms-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
        }
        .hotline-phone-ring-img-circle {
            /*background-color: #1564a7;*/
            width: 50px;
            height: 50px;
            top: 31px;
            left: 31px;
            position: absolute;
            background-size: 20px;
            border-radius: 100%;
            border: 2px solid transparent;
            -webkit-animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
            animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
            -webkit-transform-origin: 50% 50%;
            -ms-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hotline-phone-ring-img-circle .pps-btn-img {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
        }
        .hotline-phone-ring-img-circle .pps-btn-img img, .hotline-phone-ring-img-circle .pps-btn-img svg {
            width: 50px;
            height: 50px;
        }
    </style>
</section>
