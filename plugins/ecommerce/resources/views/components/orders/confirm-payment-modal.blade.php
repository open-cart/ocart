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
            <x-button
                    x-on:click="$dispatch('ok'); close()"
                    type="button">
                Confirm payment
            </x-button>
        </div>
    </x-slot>
</x-modal>