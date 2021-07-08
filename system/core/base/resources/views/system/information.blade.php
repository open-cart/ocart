<x-app-layout>
    <div class="pb-12 pt-3">
        <div class="sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-8 space-y-4">
                    System information
                </div>
                <div class="col-span-4 space-y-4">
                    <div class="bg-white border
                     dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300
                     p-4 rounded-md space-y-3"
                    >
                        <div>
                            <strong class="text-blue-500">{{ trans('core/base::system.system_environment') }}</strong>
                        </div>
                        @foreach($systemEnv as $k => $v)
                            <div class="border-t -mx-4 dark:border-gray-600"></div>
                            <div class="">
                                @if(gettype($v) == 'boolean')
                                    @if($v)
                                        {{ trans('core/base::system.'.$k) }}: <i class="fa fa-check text-green-500"></i>
                                    @else
                                        {{ trans('core/base::system.'.$k) }}: <i class="fa fa-close"></i>
                                    @endif
                                @else
                                    {{ trans('core/base::system.'.$k) }}: {{ $v }}
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="bg-white border
                     dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300
                     p-4 rounded-md space-y-3"
                    >
                        <div>
                            <strong class="text-blue-500">
                                {{ trans('core/base::system.server_environment') }}
                            </strong>
                        </div>
                        @foreach($serverEnv as $k => $v)
                            <div class="border-t -mx-4 dark:border-gray-600"></div>
                            <div class="">
                                @if(gettype($v) == 'boolean')
                                    @if($v)
                                        {{ trans('core/base::system.'.$k) }}: <i class="fa fa-check text-green-500"></i>
                                    @else
                                        {{ trans('core/base::system.'.$k) }}: <i class="fa fa-close"></i>
                                    @endif
                                @else
                                    {{ trans('core/base::system.'.$k) }}: {{ $v }}
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
