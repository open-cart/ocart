<x-app-layout>
    <x-slot name="header">
        123
    </x-slot>
    <div class="py-12 pb-28 max-w-screen-lg mx-auto">
        <div class="sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3">
                    <h3 class="text-2xl">{{ trans('plugins/payment::payment.payment_methods') }}</h3>
                    <p>{{ trans('plugins/payment::payment.setup_payment_method_for_website') }}</p>
                </div>

                <div class="col-span-9 space-y-4" id="form-method-payment">
                    <div x-data="paymentMethodAlpine()" class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 space-y-2">
                            <div class="flex flex-col">
                                @php $paymentMethods = \Ocart\Payment\Enums\PaymentMethodEnum::toArray() @endphp
                                <label>
                                    <span>{{ trans('plugins/payment::payment.default_payment_method') }}</span>
                                    <x-select name="default_payment_method"
                                              id="default_payment_method"
                                              class="w-full">
                                        @foreach($paymentMethods as $key)
                                            <option value="{{ $key }}" @if(setting('default_payment_method') == $key) selected @endif>
                                                {{ \Ocart\Payment\Enums\PaymentMethodEnum::getLabel($key) }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                </label>
                            </div>
                            <x-button x-on:click.prevent="postSaveSetting">{{ trans('admin.save') }}</x-button>
                        </div>
                    </div>

                    {!! apply_filters(PAYMENT_METHODS_SETTINGS_PAGE, null) !!}

                    <div class="bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200">
                            <div class="flex space-x-2">
                                <div class="flex-none border-r p-2">
                                    <img src="{{ asset('images/dollar.svg') }}"
                                         class="w-10 h-10"
                                         alt="money"/>
                                </div>
                                <div class="flex-grow flex">
                                    <div class="flex-none p-2">
                                        {{ trans('plugins/payment::payment.payment_methods') }}
                                    </div>
                                    <div class="flex-grow p-2">
                                        {{ trans('plugins/payment::payment.guide_customers_to_pay_direct_you_can_choose_to_pay_by_delivery_or_bank_transfer') }}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                {!! Form::open() !!}
                                {!! Form::hidden('type', 'cod', ['class' => 'payment_type']) !!}
                                @php
                                    $codStatus = setting('payment_cod_status', 0);
                                    $editHidden = '';
                                    $settingHidden = '';
                                    if ($codStatus == 0) $editHidden = ' hidden';
                                    if ($codStatus == 1) $settingHidden = ' hidden';
                                @endphp
                                <div class="flex justify-between p-2">
                                    <div>
                                        {{ trans('plugins/payment::payment.use') }}:
                                        {{ setting('payment_cod_name', \Ocart\Payment\Enums\PaymentMethodEnum::getLabel(\Ocart\Payment\Enums\PaymentMethodEnum::COD)) }}
                                    </div>
                                    <div>
                                        <x-button :class="$editHidden .' toggle-payment-item'" type="button">{{ trans('admin.edit') }}</x-button>
                                        <x-button :class="$settingHidden .' toggle-payment-item'" type="button">{{ trans('admin.settings') }}</x-button>
                                    </div>
                                </div>
                                <div class="payment-content-item hidden">
                                    <hr>
                                    <div class="px-6 py-2 space-y-2">
                                        <div>
                                            <label class="flex flex-col">
                                            <span>
                                               {{ trans('plugins/payment::payment.method_name') }}
                                            </span>
                                                <x-input name="payment_cod_name" value="{{ setting('payment_cod_name', \Ocart\Payment\Enums\PaymentMethodEnum::getLabel(\Ocart\Payment\Enums\PaymentMethodEnum::COD)) }}"/>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex flex-col">
                                            <span>
                                               {{ trans('plugins/payment::payment.payment_guide') }}
                                            </span>
                                                <x-input name="payment_cod_description" value="{{ setting('payment_cod_description', '') }}"/>
                                            </label>
                                        </div>
                                        <div class="w-full flex justify-between">
                                            <div>&nbsp;</div>
                                            <div>
                                                <x-button :class="$settingHidden .' active-payment-item'">{{ trans('admin.activate') }}</x-button>
                                                <x-button :class="$editHidden .' disable-payment-item'" >{{ trans('admin.deactivate') }}</x-button>
                                                <x-button :class="$editHidden .' save-payment-item'">{{ trans('admin.update') }}</x-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <hr>
                            <div>
                                {!! Form::open() !!}
                                {!! Form::hidden('type', 'bank_transfer', ['class' => 'payment_type']) !!}
                                @php
                                    $codStatus = setting('payment_bank_transfer_status', 0);
                                    $editHidden = '';
                                    $settingHidden = '';
                                    if ($codStatus == 0) $editHidden = 'hidden';
                                    if ($codStatus == 1) $settingHidden = 'hidden';
                                @endphp
                                <div class="flex justify-between p-2">
                                    <div>
                                        {{ trans('plugins/payment::payment.use') }}:
                                        {{ setting('payment_bank_transfer_name', \Ocart\Payment\Enums\PaymentMethodEnum::getLabel(\Ocart\Payment\Enums\PaymentMethodEnum::BANK_TRANSFER)) }}
                                    </div>
                                    <div>
                                        <x-button :class="$editHidden . ' toggle-payment-item'" type="button">{{ trans('admin.edit') }}</x-button>
                                        <x-button :class="$settingHidden . ' toggle-payment-item'" type="button">{{ trans('admin.settings') }}</x-button>
                                    </div>
                                </div>
                                <div class="payment-content-item hidden">
                                    <hr>
                                    <div class="px-6 py-2 space-y-2">
                                        <div>
                                            <label class="flex flex-col">
                                            <span>
                                               {{ trans('plugins/payment::payment.method_name') }}
                                            </span>
                                                <x-input name="payment_bank_transfer_name" value="{{ setting('payment_bank_transfer_name', \Ocart\Payment\Enums\PaymentMethodEnum::getLabel(\Ocart\Payment\Enums\PaymentMethodEnum::BANK_TRANSFER)) }}"/>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="flex flex-col">
                                            <span>
                                               {{ trans('plugins/payment::payment.payment_guide') }}
                                            </span>
                                                <x-input name="payment_bank_transfer_description" value="{{ setting('payment_bank_transfer_description', '') }}"/>
                                            </label>
                                        </div>
                                        <div class="w-full flex justify-between">
                                            <div>&nbsp;</div>
                                            <div>
                                                <x-button :class="$settingHidden . ' active-payment-item'">{{ trans('admin.activate') }}</x-button>
                                                <x-button :class="$editHidden .' disable-payment-item'">{{ trans('admin.deactivate') }}</x-button>
                                                <x-button :class="$editHidden .' save-payment-item'">{{ trans('admin.update') }}</x-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        if (typeof window['initPaymentMehtod'] !== 'function') {

            function initPaymentMehtod() {
                function showError(e) {
                    if (e?.errors) {
                        toast.error(Object.values(e.errors).find(Boolean));
                    } else {
                        toast.error(e.message);
                    }
                    throw e;
                }

                const container = $(document);

                container.on('click', ".toggle-payment-item", function() {
                    const form = $(this).closest('form');
                    const content = form.find('.payment-content-item');
                    if (content.hasClass('hidden')) {
                        content.removeClass('hidden');
                    } else {
                        content.addClass('hidden');
                    }
                });
                container.on('click','.disable-payment-item',function (e) {
                    e.preventDefault();

                    const form = $(this).closest('form');
                    const content = form.find('.payment-content-item');

                    const cf = confirm('Do you really want to deactivate this payment method?');

                    if (!cf) {
                        return;
                    }
                    $(this).addClass('button-loading')
                    axios.post('{{ route('payments.methods.update_status') }}', {
                        type: form.find('[name=type]').val(),
                    }).then(res => {
                        toast.success(res.message);
                        const items = form.find('.toggle-payment-item,.active-payment-item,.disable-payment-item,.save-payment-item');
                        items.each(function () {
                            const item = $(this).first();
                            if (item.hasClass('hidden')) {
                                item.removeClass('hidden');
                            } else {
                                item.addClass('hidden');
                            }
                        });
                    }).catch(showError).finally(() => {
                        $(this).removeClass('button-loading')
                    });
                })

                container.on('click','.save-payment-item',function (e) {
                    e.preventDefault();

                    const form = $(this).closest('form');
                    const content = form.find('.payment-content-item');

                    const o = {};
                    $.each(form.serializeArray(), function () {
                        if (o[this.name]) {
                            if (!o[this.name].push) {
                                o[this.name] = [o[this.name]];
                            }
                            o[this.name].push(this.value || '');
                        } else {
                            o[this.name] = this.value || '';
                        }
                    });
                    $(this).addClass('button-loading')
                    axios.post('{{ route('payments.methods.update') }}', o).then(res => {
                        toast.success(res.message);
                    }).catch(showError).finally(() => {
                        $(this).removeClass('button-loading')
                    })
                })
                container.on('click','.active-payment-item',function (e) {
                    e.preventDefault();

                    const form = $(this).closest('form');
                    const content = form.find('.payment-content-item');

                    const o = {};
                    $.each(form.serializeArray(), function () {
                        if (o[this.name]) {
                            if (!o[this.name].push) {
                                o[this.name] = [o[this.name]];
                            }
                            o[this.name].push(this.value || '');
                        } else {
                            o[this.name] = this.value || '';
                        }
                    });
                    $(this).addClass('button-loading')
                    axios.post('{{ route('payments.methods.update') }}', o).then(res => {
                        toast.success(res.message);
                        const items = form.find('.toggle-payment-item,.active-payment-item,.disable-payment-item,.save-payment-item');
                        items.each(function () {
                            const item = $(this).first();
                            if (item.hasClass('hidden')) {
                                item.removeClass('hidden');
                            } else {
                                item.addClass('hidden');
                            }
                        });
                    }).catch(showError).finally(() => {
                        $(this).removeClass('button-loading')
                    })
                })
            }

            initPaymentMehtod();
        }

        function paymentMethodAlpine() {
            function showError(e) {
                if (e?.errors) {
                    toast.error(Object.values(e.errors).find(Boolean));
                } else {
                    toast.error(e.message);
                }
                throw e;
            }

            return {
                open: false,
                postSaveSetting(e) {
                    $(e.target).addClass('button-loading')
                    axios.post('{{ route('payments.methods.update_setting')}}', {
                        default_payment_method: $("#default_payment_method").val()
                    })
                    .then(res => {
                        toast.success(res.message);
                    }).catch(showError).finally(() => {
                        $(e.target).removeClass('button-loading')
                    })
                }
            }
        }
    </script>
</x-app-layout>
