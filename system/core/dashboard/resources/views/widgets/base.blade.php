<div class="w-1/2 p-3 widget_item" data-url="{{ $widget->getUrl() }}" id="{{ $widget->key }}">
    <div class="bg-white border border-gray-200 dark:border-gray-600 rounded shadow dark:bg-gray-800 dark:text-gray-300 overflow-hidden">
        <div class="border-b border-gray-200 dark:border-gray-600 p-3 flex justify-between">
            <div>
                <i class="{!! $widget->icon ?? 'fa fa-users' !!}"></i>
                {!! $widget->title !!}
            </div>
            <div>
                <a href="#" class="reload">Làm mới</a>
            </div>
        </div>
        <div class="p-3 relative widget-content {{ $widget->bodyClass }} {{ Arr::get(!empty($widget->setting) ? $widget->setting->settings : [], 'state') }}"></div>
    </div>
</div>