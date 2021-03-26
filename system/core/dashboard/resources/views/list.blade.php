<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div>
                {!! apply_filters(DASHBOARD_FILTER_ADMIN_NOTIFICATIONS, null) !!}
            </div>
            <div>
                <div>
                    {!! apply_filters(DASHBOARD_FILTER_TOP_BLOCKS, null) !!}
                </div>
                <div class="flex flex-row flex-wrap flex-grow mt-2">
                    @foreach($user_widgets as $widget)
                        {!! $widget !!}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

