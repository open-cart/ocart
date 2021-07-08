<x-app-layout>
    <div class="pb-12 pt-3 max-w-screen-xl mx-auto">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="table w-full" x-data="cleanCacheData()">
                        <tbody>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                               {{ trans("Clear CMS caching: database caching, static blocks... Run this command when you don't see the changes after updating data.") }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_cms_cache')">
                                    {{ trans('Clear cms cache') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                                {{ trans('Clear image resize to make image up to date.') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_image_cache')">
                                    {{ trans('Clear image cache') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                               {{ trans('Clear compiled views to make views up to date.') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'refresh_compiled_views')">
                                    {{ trans('Refresh compiled views') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                                {{ trans('You might need to refresh the config caching when you change something on production environment.') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_config_cache')">
                                    {{ trans('Clear config cache') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                                {{ trans('Clear cache routing.') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_route_cache')">
                                    {{ trans('Clear route cache') }}
                                </x-button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-3 py-2 dark:border-gray-700">
                                {{ trans('Clear system log files.') }}
                            </td>
                            <td class="border px-3 py-2 w-72 dark:border-gray-700">
                                <x-button class="w-full justify-center" x-on:click="clearCache($event, 'clear_log')">
                                    {{ trans('Clear log') }}
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

                        }).catch(showError).finally(() => {
                            el.hide();
                        })
                    }
                }
            }
        }
    </script>
</x-app-layout>
