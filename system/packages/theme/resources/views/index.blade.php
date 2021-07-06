<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Theme') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(Session::has('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($themes as $key => $theme)
                        <div class="rounded overflow-hidden shadow-lg">
                            <img class="w-full" src="{{ asset("/themes/{$key}/screenshot.png") }}?v={{ time() }}" alt="Forest">
                            <div class="px-6 py-4">
                                <div class="font-bold text-3xl mb-2 capitalize">
                                    {!! $theme['name'] !!}
                                </div>
                                <p class="text-gray-700 text-base">
                                    {!! Arr::get($theme, 'description') !!}
                                </p>
                            </div>
                            <div
                                x-data="themeActions()"
                                class="px-6 pt-4 pb-2">
                                @if($theme['active'])
                                    <a
                                        href="javascript:void(0)"
                                        x-on:click="activate($event, '{!! $key !!}')"
                                        class="inline-block bg-blue-500 hover:bg-blue-600 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">
                                        <span class="flex">
{{--                                            <i data-feather="check" width="18" height="18"></i>--}}
                                            {{ trans('Activated') }}
                                        </span>
                                    </a>
                                @endif
                                @if(Arr::get($theme, 'update'))
                                    <a
                                        href="javascript:void(0)"
                                        x-on:click="update($event, '{!! $key !!}', '{{ $theme['reference'] }}')"
                                        class="inline-block bg-yellow-500 hover:bg-yellow-600 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">
                                        <span class="flex">
                                            {{ trans('Update') }}
                                        </span>
                                    </a>
                                @endif
                                @if(!$theme['active'])
                                    <a
                                        href="javascript:void(0)"
                                        x-on:click="activate($event, '{!! $key !!}')"
                                        class="inline-block bg-gray-500 hover:bg-gray-600 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">
                                        {{ trans('Activate') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function themeActions() {
            return {
                activate(e, theme) {
                    const btnLoading = buttonLoading($(e.target));

                    btnLoading.show();
                    axios.post('{!! route('themes.activate') !!}', {
                        theme
                    }).then((res) => {
                        toast.success(res.message);
                    }).catch(e => {
                        toast.error(e.message);
                    }).finally(() => {
                        btnLoading.hide();
                        $.pjax.reload('#body', {});
                    })
                },
                update(e, theme, reference) {
                    const btnLoading = buttonLoading($(e.target));

                    btnLoading.show();
                    axios.post('{!! route('themes.update') !!}', {
                        theme,
                        reference
                    }).then((res) => {
                        toast.success(res.message);
                    }).catch(e => {
                        toast.error(e.message);
                    }).finally(() => {
                        btnLoading.hide();
                        $.pjax.reload('#body', {});
                    })
                }
            }
        }
    </script>
</x-app-layout>

