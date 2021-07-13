<x-app-layout>
    {!! Form::open(['route' => ['settings.edit']]) !!}
    <div class="py-12 pb-28 max-w-screen-lg mx-auto">
        <div class="sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-4 pt-6">
                    <h3 class="text-2xl">
                        {{ trans('core/setting::setting.permalink.title') }}
                    </h3>
                    <p>{{ trans('core/setting::setting.permalink.description') }}</p>
                </div>
                <div class="col-span-8 space-y-4">
                    <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-400 space-y-4">
                            @php
                                $prefixes = \Ocart\Core\Facades\Slug::getPrefixes();
                            @endphp
                            @foreach($prefixes as $key => $prefix)
                                <div class="flex flex-col">
                                    <label for="">{{ Arr::get($prefix, 'label') }}</label>
                                    <x-input value="{{ \Ocart\Core\Facades\Slug::getPrefix($key, Arr::get($prefix, 'value')) }}"/>
                                    <div class="bg-blue-100 p-2 my-1" role="alert">
                                        <span>Preview: </span>
                                        <x-link href="javascript:void(0)">
                                            {{ url(\Ocart\Core\Facades\Slug::getPrefix($key, Arr::get($prefix, 'value')) .'/your-url-here') }}
                                        </x-link>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <x-button>{{ trans('admin.save_settings') }}</x-button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</x-app-layout>
