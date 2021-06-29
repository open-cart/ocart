<x-app-layout>
    <x-slot name="header">
        123
    </x-slot>
    {!! Form::open(['route' => ['settings.email.edit']]) !!}
    <div class="py-12 pb-28 max-w-screen-lg mx-auto">
        <div class="sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3 pt-6">
                    <h3 class="text-2xl">{{ trans('core/setting::setting.email_settings') }}</h3>
                    <p>{{ trans('core/setting::setting.email_template_using_html_and_system_variables') }}</p>
                </div>
                <div class="col-span-9 space-y-4">
                    <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 space-y-4">
                            <div class="flex flex-col">
                                <label for="email_driver">
                                    {{ trans('core/setting::setting.mailer') }}
                                </label>
                                <x-select name="email_driver" id="email_driver">
                                    <option value="smtp" @if (setting('email_driver', config('mail.default')) == 'smtp') selected @endif>SMTP</option>
{{--                                    <option value="sendmail" @if (setting('email_driver', config('mail.default')) == 'sendmail') selected @endif>Sendmail</option>--}}
{{--                                    <option value="mailgun" @if (setting('email_driver', config('mail.default')) == 'mailgun') selected @endif>Mailgun</option>--}}
{{--                                    <option value="ses" @if (setting('email_driver', config('mail.default')) == 'ses') selected @endif>SES</option>--}}
{{--                                    <option value="postmark" @if (setting('email_driver', config('mail.default')) == 'postmark') selected @endif>Postmark</option>--}}
{{--                                    <option value="log" @if (setting('email_driver', config('mail.default')) == 'log') selected @endif>Log</option>--}}
{{--                                    <option value="array" @if (setting('email_driver', config('mail.default')) == 'array') selected @endif>Array</option>--}}
                                </x-select>
                            </div>
                            <div data-type="smtp" class="space-y-4 setting-wrapper  @if (setting('email_driver', config('mail.default')) !== 'smtp') hidden @endif">
                                <div class="flex flex-col">
                                    <label for="mailer_port">
                                        {{ trans('core/setting::setting.port') }}
                                    </label>
                                    <x-input name="mailer_port"
                                             id="mailer_port"
                                             placeholder="{{ trans('core/setting::setting.port_placeholder') }}"
                                             value="{{ setting('mailer_port', config('mail.mailers.smtp.port')) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <label for="mailer_host">
                                        {{ trans('core/setting::setting.host') }}
                                    </label>
                                    <x-input name="mailer_host"
                                             id="mailer_host"
                                             placeholder="{{ trans('core/setting::setting.host_placeholder') }}"
                                             value="{{ setting('mailer_host', config('mail.mailers.smtp.host')) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <label for="mailer_username">
                                        {{ trans('core/setting::setting.username') }}
                                    </label>
                                    <x-input name="mailer_username"
                                             id="mailer_username"
                                             placeholder="{{ trans('core/setting::setting.username_to_login_to_mail_server') }}"
                                             value="{{ setting('mailer_username', config('mail.mailers.smtp.username')) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <label for="mailer_password">
                                        {{ trans('core/setting::setting.password') }}
                                    </label>
                                    <x-input name="mailer_password"
                                             id="mailer_password"
                                             type="password"
                                             placeholder="{{ trans('core/setting::setting.password_to_login_to_mail_server') }}"
                                             value="{{ setting('mailer_password',config('mail.mailers.smtp.password')) }}"/>
                                </div>
                                <div class="flex flex-col">
                                    <label for="mailer_encryption">
                                        {{ trans('core/setting::setting.encryption') }}
                                    </label>
                                    <x-input name="mailer_encryption"
                                             id="mailer_encryption"
                                             placeholder="{{ trans('core/setting::setting.encryption_placeholder') }}"
                                             value="{{ setting('mailer_encryption', config('mail.mailers.smtp.encryption')) }}"/>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label for="mailer_send_name">
                                    {{ trans('core/setting::setting.send_name') }}
                                </label>
                                <x-input name="email_from_name"
                                         id="mailer_send_name"
                                         placeholder="{{ trans('core/setting::setting.send_name_placeholder') }}"
                                         value="{{ setting('email_from_name', config('mail.from.name')) }}"/>
                            </div>
                            <div class="flex flex-col">
                                <label for="mailer_send_mail">
                                    {{ trans('core/setting::setting.send_mail') }}
                                </label>
                                <x-input name="email_from_address"
                                         id="mailer_send_mail"
                                         placeholder="{{ trans('core/setting::setting.send_mail_placeholder') }}"
                                         value="{{ setting('email_from_address', config('mail.from.address')) }}"/>
                            </div>
                            <div class="">
                                <x-button type="button" data-target="#test-email-modal" data-toggle="modal">
                                    {{ trans('core/setting::setting.send_mail_test') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! apply_filters(BASE_FILTER_AFTER_SETTING_EMAIL_CONTENT, null) !!}

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3 pt-6">
                </div>
                <div class="col-span-9 py-6">
                    <x-button>{{ trans('admin.save_settings') }}</x-button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <x-core.setting::test-email></x-core.setting::test-email>
    <script>
        (function() {
            $("#email_driver").change(function() {
                const typeChange = $(this).val();
                const wrapper = $(".setting-wrapper");
                wrapper.each(function() {
                    const _self = $(this);
                    const type = _self.attr('data-type');
                    if (!_self.hasClass('hidden')) {
                        _self.addClass('hidden')
                    }
                    if (type === typeChange) {
                        _self.removeClass('hidden');
                    }
                })
            })
        })()
    </script>
</x-app-layout>
