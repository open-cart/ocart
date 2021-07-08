<x-app-layout>
    <div class="pb-12 pt-3 max-w-screen-xl mx-auto">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="pb-6 text-xl font-bold">
                        {{ trans('core/base::cache.cache_commands') }}
                    </h3>

                    <table class="table w-full" x-data="cleanCacheData()">
                        <tbody>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                               {{ trans("core/base::cache.commands.clear_cms_cache.description") }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_cms_cache')">
                                    {{ trans('core/base::cache.commands.clear_cms_cache.title') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                                {{ trans('core/base::cache.commands.clear_image_cache.description') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_image_cache')">
                                    {{ trans('core/base::cache.commands.clear_image_cache.title') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                               {{ trans('core/base::cache.commands.refresh_compiled_views.description') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'refresh_compiled_views')">
                                    {{ trans('core/base::cache.commands.refresh_compiled_views.title') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                                {{ trans('core/base::cache.commands.clear_config_cache.description') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_config_cache')">
                                    {{ trans('core/base::cache.commands.clear_config_cache.title') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                                {{ trans('core/base::cache.commands.clear_route_cache.description') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_route_cache')">
                                    {{ trans('core/base::cache.commands.clear_route_cache.title') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                                {{ trans('core/base::cache.commands.clear_log.description') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_log')">
                                    {{ trans('core/base::cache.commands.clear_log.title') }}
                                </x-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        if (typeof cleanCacheData === 'undefined') {
            function cleanCacheData() {
                return {
                    clearCache(e, type) {
                        const el = buttonLoading($(e.target))
                        el.show();
                        axios.post('{{ route('system.cache.clear') }}', {
                            type
                        }).then(res => {
                            toast.success(res.message);
                        }).catch(showError).finally(() => {
                            el.hide();
                        })
                    }
                }
            }
        }
    </script>
</x-app-layout>
