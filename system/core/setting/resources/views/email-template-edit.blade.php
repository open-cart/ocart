<x-app-layout>
    <div class="p-6">
        <ul class="flex text-gray-500 text-sm lg:text-base">
            <li class="inline-flex items-center"><a href="/">Dashboard</a>
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-5 w-auto text-gray-400">
                    <path fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="inline-flex items-center"><a href="{{ route('settings.email') }}">Settings</a>
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-5 w-auto text-gray-400">
                    <path fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="inline-flex items-center"><a href="{{ route('settings.email') }}">Email</a>
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-5 w-auto text-gray-400">
                    <path fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="inline-flex items-center"><a href="javascript:void(0)" class="text-gray-400">
                    {{ trans('core/setting::setting.email.title') }}
                </a></li>
        </ul>
    </div>
    {!! Form::open(['url' => url()->full()]) !!}
    <div class="py-12 pb-28 max-w-screen-lg mx-auto">
        <div class="sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-4 pt-3">
                    <h2 class="text-2xl">{{ trans('core/setting::setting.email.title') }}</h2>
                    <div>
                        <p>
                            {{ trans('core/setting::setting.email.description') }}
                        </p>
                        <div class="space-y-2">
                            @foreach(\Ocart\Core\Facades\EmailHandler::getVariables('core') as $coreKey => $coreVariable)
                                <p><code class="text-red-500 shadow text-xs">{{ $coreKey }}</code>: {{ $coreVariable }}
                                </p>
                            @endforeach
                            @foreach(\Ocart\Core\Facades\EmailHandler::getVariables($pluginData['name']) as $moduleKey => $moduleVariable)
                                <p>
                                    <code class="text-red-500 shadow text-xs">{{ $moduleKey }}</code>: {{ trans($moduleVariable) }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-8 space-y-4">
                    <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 space-y-4">
                            <div class="flex flex-col">
                                <label for="subject">{{ trans('Subject') }}</label>
                                <x-input name="subject" id="subject"
                                         value="{{ $emailSubject }}"></x-input>
                            </div>
                            <div>
                                <label for="email_content">{{ trans('Content') }}</label>
                                <textarea id="email_content" name="email_content" class="w-full border"
                                          rows="10">{{ $emailContent }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <x-button>{{ trans('Reset to default') }}</x-button>
                <x-button>{{ trans('admin.save_settings') }}</x-button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</x-app-layout>
