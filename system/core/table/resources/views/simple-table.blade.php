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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                    <span>{!! trans('admin.excel') !!}</span>
                                </a>
                            @endif
                            @if(in_array('reload', $table->getDefaultButtons()))
                                <a
                                        href=""
                                        title="{!! __('admin.reload') !!}"
                                        class="space-x-2 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
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
