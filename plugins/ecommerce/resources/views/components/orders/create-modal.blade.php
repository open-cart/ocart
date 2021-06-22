@props(['target' => 'order-create-modal'])

<x-modal content_classes="w-96" target="{!! $target !!}">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">Create new order</h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div  class="py-4 space-y-3">
            <p>
                Confirm that payment for this order will be paid later
            </p>
            <p>
                Payment status of the order is Pending. Once the order has been created, you cannot change the payment method or status.
            </p>
            <div>
                <x-select id="payment_method"
                          x-model="$store.order.payment_method"
                          class="w-full" name="payment_method">
                    <option value="cod">Cash on delivery (Cod)</option>
                    <option value="bank_transfer">Bank transfer</option>
                </x-select>
            </div>
            <p>
                Pending amount: <span x-text="$store.order.total"></span>
            </p>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end pt-2">
            <x-button
                    x-on:click="$dispatch('shown'); close()"
                    type="button"
                    color="bg-blue-500 hover:bg-blue-400 mr-2">
                Close
            </x-button>
            <template x-if="$store.order.loading">
                <x-button
                        type="button"
                        color="modal-close px-4 bg-red-500 hover:bg-red-400">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing
                </x-button>
            </template>
            <template x-if="!$store.order.loading">
                <x-button
                        x-on:click="$store.order.submit().then(() => {$dispatch('ok', $store.order); close()})"
                        type="button"
                        x-bind:disabled="$store.order.loading"
                        color="modal-close px-4 bg-red-500 hover:bg-red-400">
                    Create
                </x-button>
            </template>
        </div>
    </x-slot>
</x-modal>