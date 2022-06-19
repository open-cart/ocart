<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @php
        $sections = json_decode(theme_options()->getOption('section_list', []), true);
    @endphp

    @if(is_active_plugin('blog') && is_array($sections) && in_array('sec1', $sections))
        <x-theme::section.blog-slide1 keySlide="sec1" class="bg-gray-100"/>
    @endif

    @include(Theme::getThemeNamespace('components/section/coingecko'))

    @if(is_array($sections) && in_array('sec2', $sections))
    @include(Theme::getThemeNamespace('components/section/banner1'))
    @endif

    @if(is_active_plugin('blog') && is_array($sections) && in_array('sec3', $sections))
        <x-theme::section.blog-slide2 keySlide="sec3"/>
    @endif

    @if(is_active_plugin('blog') && is_array($sections) && in_array('sec4', $sections))
        <x-theme::section.blog1/>
    @endif

    @if(is_active_plugin('blog') && is_array($sections) && in_array('sec5', $sections))
        <x-theme::section.blog-slide3 keySlide="sec5" class="bg-gray-100"/>
    @endif

    @if(is_active_plugin('blog') && is_array($sections) && in_array('sec6', $sections))
        <x-theme::section.blog2/>
    @endif

    @if(is_active_plugin('blog') && is_array($sections) && in_array('sec7', $sections))
        <x-theme::section.blog3/>
    @endif

    @if(is_array($sections) && in_array('sec8', $sections))
    @include(Theme::getThemeNamespace('components/section/banner2'))
    @endif

    @if(is_active_plugin('blog') && is_array($sections) && in_array('sec9', $sections))
    <x-theme::section.blog4/>
    @endif

    @if(is_array($sections) && in_array('sec10', $sections))
    @include(Theme::getThemeNamespace('components/section/banner3'))
    @endif

    @if(is_active_plugin('blog') && is_array($sections) && in_array('sec11', $sections))
    <x-theme::section.blog5/>
    @endif

    @if(is_active_plugin('ecommerce') && is_array($sections) && in_array('sec12', $sections))
        <x-theme::section.product1 class="bg-gray-100"/>
    @endif

    @if(is_active_plugin('blog')  && is_array($sections) && in_array('sec13', $sections))
    <x-theme::section.contact1 keySlide="sec13"/>
    @endif

</x-guest-layout>
