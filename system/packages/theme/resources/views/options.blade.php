<x-app-layout>
    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                {!! Form::open(['route' => 'theme.options', 'method' => 'POST']) !!}
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="border-b-4 p-6 border-blue-800 dark:border-blue-900 bg-gray-800 dark:bg-gray-700 text-white">
                        <h3 class="text-3xl">{{ trans('packages/theme::theme.theme_options') }}</h3>
                    </div>
                    <div class="flex justify-between border-b p-3 dark:border-gray-700">
                        <div>
                            @if(Session::has('message'))
                                <p class="alert alert-danger">{{ Session::get('message') }}</p>
                            @endif
                        </div>
                        <div>
                            <x-button>{{ trans('admin.save_changes') }}</x-button>
                        </div>
                    </div>
                    <div class="flex" x-data="{active: '{{ Arr::first(ThemeOption::constructSections())['id'] }}'}">
                        <div class="w-60 flex-none border-r dark:border-gray-700">
                            <ul>
                                @foreach(ThemeOption::constructSections() as $section)
                                <li>
                                    <a class="block rounded-t bg-gray-200 opacity-70 dark:bg-gray-600 -mb-px py-2 px-2 hover:bg-white hover:border-white dark:hover:bg-gray-700 dark:border-gray-700"
                                       x-bind:class="{'selected:bg-white selected:border-white selected:dark:bg-gray-800 selected:dark:border-gray-800': active == '{{ $section['id'] }}'}"
                                       x-on:click="active = '{{ $section['id'] }}'"
                                       href="javascript:void(0)">
                                        @if(Arr::get($section, 'icon'))
                                            <i class="{{ Arr::get($section, 'icon') }}"></i>
                                        @endif
                                        <span>{{ Arr::get($section, 'title') }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="flex-grow p-4">
                            @foreach(ThemeOption::constructSections() as $section)
                                <div x-show="active == '{{ $section['id'] }}'"
                                     class="tab-pane"
                                     style="display: none"
                                     id="tab_{{ $section['id'] }}">
                                    @foreach(ThemeOption::constructFields($section['id']) as $field)
                                        {!! $field->render() !!}
                                        @if(!$loop->last)
                                            <hr class="mt-6 mb-3 dark:border-gray-600">
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex justify-between border-t p-3 dark:border-gray-700">
                        <div>
                           &nbsp;
                        </div>
                        <div>
                            <x-button>{{ trans('admin.save_changes') }}</x-button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</x-app-layout>
