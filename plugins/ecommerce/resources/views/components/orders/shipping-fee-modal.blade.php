<x-modal content_classes="w-auto" target="order-shipping-fee-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">
                {{ trans('plugins/ecommerce::shipping.shipping_fee') }}
            </h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div  class="py-4 space-y-3">
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 pl-12 rounded relative"
                 x-show="!$store.order.customerExists"
                 role="alert">
                <span class="absolute top-0 bottom-0 left-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"></path></svg>
                </span>
                <h3 class="text-xl font-bold">How to select configured shipping?</h3>
                <p>
                    Please add customer information with the complete shipping address to see the configured shipping rates.
                </p>
            </div>

            <div>
                <div>
                    <template x-for="(shipping_method, index) in $store.shipping_methods.data" :key="index+''+shipping_method.value">
                        <div>
                            <label x-on:click.prevent="$store.shipping_methods.changeShippingMethod(shipping_method)">
                                <input type="radio"
                                       x-model="$store.shipping_methods.selected.value"
                                       x-bind:id="shipping_method.name"
                                       x-bind:value="shipping_method.value">
                                <span x-text="shipping_method.name">&nbsp;</span>
                                <span> - </span>
                                <span x-text="shipping_method.price">&nbsp;</span>
                            </label>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end pt-2">
            <x-button
                    x-on:click="$dispatch('shown'); close()"
                    type="button"
                    color="bg-yellow-500 hover:bg-blue-400 mr-2">
                cancel
            </x-button>
            <template x-if="$store.order.loading">
                <x-button type="button">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing
                </x-button>
            </template>
            <template x-if="!$store.order.loading">
                <x-button
                        x-on:click="$store.order.changeShippingMethod($store.shipping_methods.selected).then(() => {$dispatch('ok'); close()})"
                        type="button">
                    Apply
                </x-button>
            </template>
        </div>
    </x-slot>
</x-modal>