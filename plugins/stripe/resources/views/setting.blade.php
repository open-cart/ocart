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
                    <img src="{{ asset('images/stripe_logo.svg') }}" alt="" class="w-20">
                </div>
                <div class="flex-grow p-2">
                    <x-link class="blank" target="_blank" href="https://stripe.com">Stripe</x-link>
                    <p>
                        {{ trans('Customer can buy product and pay directly using Visa, Credit card via Stripe') }}
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <div>
            {!! Form::open() !!}
            {!! Form::hidden('type', STRIPE_PAYMENT_METHOD_NAME, ['class' => 'payment_type']) !!}
            @php
                $codStatus = get_payment_setting('status', STRIPE_PAYMENT_METHOD_NAME);
                $editHidden = '';
                $settingHidden = '';
                if ($codStatus == 0) $editHidden = ' hidden';
                if ($codStatus == 1) $settingHidden = ' hidden';
            @endphp
            <div class="flex justify-between p-2">
                <div>
                    {{ trans('plugins/payment::payment.use') }}:
                    {{ setting('payment_stripe_name', __('Pay online via Stripe')) }}
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
                            <x-input name="payment_stripe_name" value="{{ setting('payment_stripe_name', __('Pay online via Stripe')) }}"/>
                        </label>
                    </div>
                    <div>
                        <label class="flex flex-col">
                            <span>
                               {{ trans('plugins/payment::payment.payment_guide') }}
                            </span>
                            <x-input name="payment_stripe_description" value="{{ setting('payment_stripe_description', '') }}"/>
                        </label>
                    </div>
                    <div class="py-4">
                        {{ trans('Please provide information') }} <x-link target="_blank" class="blank" href="https://stripe.com">Stripe</x-link>:
                    </div>
                    <div>
                        <label class="flex flex-col">
                            <span>
                              {{ trans('Stripe Public Key') }}
                            </span>
                            <x-input name="stripe_public_key" value="{{ setting('stripe_public_key', '') }}"/>
                        </label>
                    </div>
                    <div>
                        <label class="flex flex-col">
                            <span>
                               {{ trans('Stripe Private Key') }}
                            </span>
                            <x-input name="stripe_private_key" type="password" placeholder="******" value="{{ setting('stripe_private_key', '') }}"/>
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
    </div>
</div>