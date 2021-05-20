<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="pb-12 pt-3" id="page-container">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 border-b border-gray-200 dark:border-gray-600">
                    <div>
                        {!! $table->searchForm !!}
                    </div>
                    <div class="flex justify-between mb-2">
                        <div>
{{--                            {!! $table->renderBulkAction() !!}--}}
                        </div>
                        <div >
                            {!! implode(PHP_EOL.PHP_EOL, (array) $table->buttons()) !!}
                            <div class="inline-block">
                                <a
                                    href=""
                                    title="{!! __('admin.add_new') !!}"
                                    class="space-x-2 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                    <i data-feather="refresh-ccw" width="16" height="16"></i>
                                    <span>{!! trans('admin.reload') !!}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        {!! $table->table(['class' => 'w-full']) !!}
                    </div>
                    <div class="mt-2">
                        {!! $table->data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
