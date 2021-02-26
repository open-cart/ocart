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
                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($themes as $key => $theme)
                        <div class="rounded overflow-hidden shadow-lg">
                            <img class="w-full" src="/themes/{!! $key !!}/screenshot.png" alt="Forest">
                            <div class="px-6 py-4">
                                <div class="font-bold text-3xl mb-2 capitalize">
                                    {!! $theme->name !!}
                                </div>
                                <p class="text-gray-700 text-base">
                                    {!! $theme->description !!}
                                </p>
                            </div>
                            <div
                                x-data="themeActions()"
                                class="px-6 pt-4 pb-2">
                                    @if($theme->active)
                                    <a
                                        href="javascript:void(0)"
                                        x-on:click="activate('{!! $key !!}')"
                                        class="inline-block bg-blue-500 hover:bg-blue-600 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">
                                        <span class="flex">
                                            <i data-feather="check" width="18" height="18"></i>
                                            Activated
                                        </span>
                                    </a>
                                    @else
                                    <a
                                        href="javascript:void(0)"
                                        x-on:click="activate('{!! $key !!}')"
                                        class="inline-block bg-gray-500 hover:bg-gray-600 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">
                                        Activate
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
                activate(theme) {
                    axios.post('{!! route('theme.active') !!}', {
                        theme
                    }).then(() => {
                        toast.success('Your work has been saved');
                    }).catch(e => {
                        toast.error(e.message);
                    }).finally(() => {
                        $.pjax.reload('#body', {});
                    })
                }
            }
        }
    </script>
</x-app-layout>

