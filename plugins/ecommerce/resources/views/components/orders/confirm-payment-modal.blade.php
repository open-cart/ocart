<x-modal content_classes="w-auto" target="order-confirm-payment-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">Confirm payment</h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div  class="py-4 space-y-3">
            <p>
                Processed by <strong>Cash on delivery (COD)</strong>.
                Did you receive payment outside the system?
            </p>
            <p>
                This payment won't be saved into system and cannot be refunded
            </p>
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
                        x-on:click="$store.order.confirmPayment().then(() => {$dispatch('ok'); close()})"
                        type="button">
                    Confirm payment
                </x-button>
            </template>
        </div>
    </x-slot>
</x-modal>