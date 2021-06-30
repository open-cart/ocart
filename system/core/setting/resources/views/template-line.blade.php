<div>
    <hr>
</div>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-3 pt-6">
        <h3 class="text-2xl">{{ trans($data['name']) }}</h3>
        <p>{{ trans($data['description']) }}</p>
    </div>
    <div class="col-span-9 space-y-4">
        <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 space-y-4">
                <table class="table-auto w-full">
                    <thead>
                    <tr class="border-t">
                        <th class="text-left py-2">{{ trans('core/setting::setting.template') }}</th>
                        <th class="text-left py-2">{{ trans('core/setting::setting.description') }}</th>
                        @if($module != 'base')
                            <th class="py-2">
                                {{ trans('core/setting::setting.enable') }}
                            </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data['templates'] as $key => $template)
                        <tr class="border-t">
                            <td class="py-2">
                                <x-link href="{{ route('settings.email.template.edit', ['name' => $module, 'template' => $key]) }}">
                                    {{ trans($template['title']) }}
                                </x-link>
                            </td>
                            <td class="py-2">
                                {{ trans($template['description']) }}
                            </td>
                            @if($module != 'base' && Arr::get($template, 'can_off', false))
                                <td class="py-2">
                                    <x-switch
                                            checked="{!! get_setting_email_status($key, $module) == 1 ? 'true' : 'false' !!}"
                                            name="{{ get_setting_email_status_key($key) }}"
                                            value_false="0"
                                            color="bg-green-600"
                                    />
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>