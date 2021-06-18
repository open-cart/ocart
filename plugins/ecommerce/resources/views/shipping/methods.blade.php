<x-app-layout>
    <x-slot name="header">
        Shipping
    </x-slot>
    <div class="py-12 pb-28">
        <div class="sm:px-6 lg:px-8 max-w-screen-lg mx-auto">
            <a href="">Reload</a>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-4">
                    <div class="mb-3">
                        <h3 class="text-3xl">
                            {{ trans('plugins/ecommerce::shipping.shipping_rules') }}
                        </h3>
                        <p>
                            {{ trans('plugins/ecommerce::shipping.rule_to_calculate_fee') }}
                        </p>
                    </div>
                    <div>
                        <x-button data-toggle="modal"
                                  data-target="#select-country-modal">
                            {{ trans('plugins/ecommerce::shipping.select_country') }}
                        </x-button>
                    </div>
                </div>
                @if(count($shippings))
                <div class="col-span-8 space-y-4">
                    <div class="bg-white border border-white shadow-md
                     dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300
                     p-4 rounded space-y-4"
                    >
                        @foreach($shippings as $shipping)
                            <div class="flex justify-between">
                                <div>
                                    <span>{{ trans('plugins/ecommerce::shipping.country') }}:</span>
                                    <strong>{{ $shipping->title }}</strong>
                                </div>
                                <div>
                                    <a href="javascript:void(0)"
                                       x-on:click="$store.shipping_method.deleteShippingRegion({{ $shipping->id }})"
                                       class="text-red-500 mr-2">{{ trans('admin.delete') }}</a>
                                    <a href="javascript:void(0)"
                                       data-toggle="modal"
                                       data-target="#add-shipping-rule-modal"
                                       data-shipping-id="{{ $shipping->id }}"
                                       x-on:click="$store.shipping_method.openAddShippingRule($event)"
                                       class="text-blue-600">
                                        {{ trans('plugins/ecommerce::shipping.add_shipping_rule') }}
                                    </a>
                                </div>
                            </div>
                            <div>
                                @foreach ($shipping->rules as $rule)
                                    <div class="mt-3">
                                        <a href="javascript:void(0)"
                                           data-toggle="modal"
                                           data-target="#update-shipping-rule-modal"
                                           x-on:click='$store.shipping_method.openUpdateShippingRule(@json($rule))'
                                           class="text-blue-400">{{ $rule->name }}</a>
                                        <span>|</span>
                                        <a href="javascript:void(0)"
                                           class="text-red-500"
                                           x-on:click="$store.shipping_method.deleteShippingRule({{ $rule->id }})">
                                            {{ trans('admin.delete') }}
                                        </a>
                                        <div class="flex justify-between">
                                            <div>
                                            @if(is_null($rule->to))
                                                <span>
                                                    {{ trans('plugins/ecommerce::shipping.greater_than') }}
                                                    {{ format_price($rule->from) }}
                                                </span>
                                            @else
                                                <span>
                                                    {{ format_price($rule->from) }} - {{ format_price($rule->to) }}
                                                </span>
                                            @endif
                                            </div>
                                            <div>
                                                {{ format_price($rule->price) }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div>
        <x-plugins.ecommerce::shipping.select-country-modal/>
        <x-plugins.ecommerce::shipping.update-shipping-rule-modal/>
    </div>
    <x-plugins.ecommerce::shipping.add-shipping-rule-modal/>
    <script>
        Spruce.store('shipping_method', {
            addShippingRuleData: {
                name: '',
                from: '',
                to: '',
                price: '',
            },
            updateShippingRuleData: {
                name: '',
                from: '',
                to: '',
                price: '',
            },
            country: '',
            addShippingRegion() {
                console.log('country added', this.country);

                return axios.post('{{ route('ecommerce.shipping.add_shipping_region') }}', {
                    country: this.country
                }).then(() => {
                    $.pjax.reload('#body');

                    return Promise.resolve();
                })
            },
            deleteShippingRegion(id, options = {}) {
                confirmDelete.show(() => {
                    bodyLoading.show();
                    axios.delete('{{ route('ecommerce.shipping.delete_shipping_region') }}', {data: {id}})
                        .then(res => {
                            toast.success('Deleted successfully')
                            return $.pjax.reload('#body', {});
                        })
                        .catch(e => {
                            toast.error(e.message);
                        })
                        .finally(() => {
                            bodyLoading.hide();
                        })
                })
            },
            openAddShippingRule(e) {
                const shipping_id = $(e.target).data('shipping-id');
                this.addShippingRuleData = {
                    name: '',
                    from: '',
                    to: '',
                    price: '',
                    shipping_id
                };
            },
            openUpdateShippingRule(data) {
                this.updateShippingRuleData = {
                    ...data
                };
                console.log('open update')
            },
            addShippingRule() {
                const {name, from, to, price, shipping_id} = this.addShippingRuleData;

                console.log('this.addShippingRuleData', {
                    name, from, to, price, shipping_id
                })

                return axios.post('{{ route('ecommerce.shipping.add_shipping_rule') }}', this.addShippingRuleData)
                    .then(function (response) {
                        $.pjax.reload('#body');
                        return response;
                    })
            },
            updateShippingRule() {
                const {name, from, to, price, shipping_id} = this.updateShippingRuleData;

                console.log('this.updateShippingRuleData', {
                    name, from, to, price, shipping_id
                })

                return axios.post('{{ route('ecommerce.shipping.update_shipping_rule') }}', this.updateShippingRuleData)
                    .then(function (response) {
                        $.pjax.reload('#body');
                        return response;
                    })
            },
            deleteShippingRule(id, options = {}) {
                confirmDelete.show(() => {
                    bodyLoading.show();
                    axios.delete('{{ route('ecommerce.shipping.delete_shipping_rule') }}', {data: {id}})
                        .then(res => {
                            toast.success('Deleted successfully')
                            return $.pjax.reload('#body', {});
                        })
                        .catch(e => {
                            toast.error(e.message);
                        })
                        .finally(() => {
                            bodyLoading.hide();
                        })
                })
            }
        })
    </script>
</x-app-layout>