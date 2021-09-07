<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="pb-12 pt-3" id="page-container">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800 dark:border-gray-800">
                <div class="p-6 ">
                    <div>
                        {!! $table->searchForm !!}
                    </div>
                    <div class="flex justify-between mb-2">
                        <div>
{{--                            {!! $table->renderBulkAction() !!}--}}
                        </div>
                        <div class="flex space-x-2">
                            {!! implode(PHP_EOL.PHP_EOL, (array) $table->buttons()) !!}
                            @if(in_array('export', $table->getDefaultButtons()))
                                <a
                                        href="{{ url(url()->current() .'?'. Arr::query(array_merge(request()->except(['_pjax']), ['action' => 'excel']))) }}"
                                        title="{!! __('admin.reload') !!}"
                                        download
                                        class="blank space-x-2 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                    <i data-feather="download" width="16" height="16"></i>
                                    <span>{!! trans('admin.excel') !!}</span>
                                </a>
                            @endif
                            @if(in_array('reload', $table->getDefaultButtons()))
                                <a
                                        href=""
                                        title="{!! __('admin.reload') !!}"
                                        class="space-x-2 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                    <i data-feather="refresh-ccw" width="16" height="16"></i>
                                    <span>{!! trans('admin.reload') !!}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div>
                        {!! $table->table(['class' => 'w-full']) !!}
                    </div>
                    @if(is_object($table->data) && method_exists($table->data, 'links'))
                    <div class="mt-2">
                        {!! $table->data->links() !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
