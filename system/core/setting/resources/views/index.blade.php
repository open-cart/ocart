<x-app-layout>
    {!! Form::open(['route' => ['settings.edit']]) !!}
    <div class="py-12 pb-28 max-w-screen-lg mx-auto">
        <div class="sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-4 pt-6">
                    <h3 class="text-2xl">
                        {{ trans('core/setting::setting.general.general_block') }}
                    </h3>
                    <p>{{ trans('core/setting::setting.general.description') }}</p>
                </div>
                <div class="col-span-8 space-y-4">
                    <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-400 space-y-4">
                            <div class="flex flex-col">
                                <label for="admin_email" class>
                                    {{ trans('core/setting::setting.general.admin_email') }}
                                </label>
                                <x-input id="admin_email"
                                         value="{{ setting('admin_email') }}"
                                         name="admin_email"></x-input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Admin appearance -->
            <div><hr class="dark:border-gray-500"></div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-4 pt-6">
                    <h3 class="text-2xl">
                        {{ trans('core/setting::setting.general.admin_appearance_title') }}
                    </h3>
                    <p>{{ trans('core/setting::setting.general.admin_appearance_description') }}</p>
                </div>
                <div class="col-span-8 space-y-4">
                    <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-400 space-y-4">
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

            <!-- Cacheable -->
            <div><hr class="dark:border-gray-500"></div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-4 pt-6">
                    <h3 class="text-2xl">
                        {{ trans('core/setting::setting.general.cache_admin_menu') }}
                    </h3>
                    <p>{{ trans('core/setting::setting.general.cache_description') }}</p>
                </div>
                <div class="col-span-8 space-y-4">
                    <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-400 space-y-4">
                            <div class="flex flex-col">
                                <label for="admin_logo" class>
                                    {{ trans('core/setting::setting.general.enable_cache') }}
                                </label>
                                <div>
                                    <x-switch
                                            checked="{{ is_enable_cache() ? 'true' : 'false' }}"
                                            name="enable_cache"
                                            color="bg-green-600"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label for="admin_title" class>
                                    {{ trans('core/setting::setting.general.cache_time') }}
                                </label>
                                <x-input id="admin_title"
                                         value="{{ setting('cache_time', 10) }}"
                                         name="cache_time"></x-input>
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
