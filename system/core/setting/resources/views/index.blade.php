<x-app-layout>
    {!! Form::open(['route' => ['settings.edit']]) !!}
    <div class="py-12 pb-28 max-w-screen-lg mx-auto">
        <div class="sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3 pt-6">
                    <h3 class="text-2xl">
                        {{ trans('core/setting::setting.general.general_block') }}
                    </h3>
                    <p>{{ trans('core/setting::setting.general.description') }}</p>
                </div>
                <div class="col-span-9 space-y-4">
                    <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 space-y-4">
                            <div class="flex flex-col">
                                <label for="admin_email" class>
                                    {{ trans('core/setting::setting.general.admin_email') }}
                                </label>
                                <x-input id="admin_email"
                                         value="{{ setting('admin_email') }}"
                                         name="admin_email"></x-input>
                            </div>
{{--                            <div class="flex flex-col">--}}
{{--                                <label for="time_zone">{{ trans('core/setting::setting.general.time_zone') }}</label>--}}
{{--                                <x-input id="time_zone" name="time_zone" value="{{ setting('time_zone') }}"/>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <label for="time_zone">{{ trans('core/setting::setting.general.time_zone') }}</label>--}}
{{--                                <x-input id="time_zone" name="time_zone" value="{{ setting('time_zone') }}"/>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div><hr></div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3 pt-6">
                    <h3 class="text-2xl">
                        {{ trans('core/setting::setting.general.admin_appearance_title') }}
                    </h3>
                    <p>{{ trans('core/setting::setting.general.admin_appearance_description') }}</p>
                </div>
                <div class="col-span-9 space-y-4">
                    <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 space-y-4">
                            <div class="flex flex-col">
                                <label for="admin_logo" class>
                                    {{ trans('core/setting::setting.general.admin_logo') }}
                                </label>
                                <div>
                                    {{ Form::mediaImage('admin_logo', setting('admin_logo')) }}
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label for="admin_favicon" class>
                                    {{ trans('core/setting::setting.general.admin_favicon') }}
                                </label>
                                <div>
                                    {{ Form::mediaImage('admin_favicon', setting('admin_favicon')) }}
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label for="admin_title" class>
                                    {{ trans('core/setting::setting.general.admin_title') }}
                                </label>
                                <x-input id="admin_title"
                                         value="{{ setting('admin_title') }}"
                                         name="admin_title"></x-input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! apply_filters(BASE_FILTER_AFTER_SETTING_CONTENT, null) !!}

            <div class="text-center">
                <x-button>{{ trans('admin.save_settings') }}</x-button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</x-app-layout>
