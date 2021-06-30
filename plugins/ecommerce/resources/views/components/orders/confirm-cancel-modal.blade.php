<x-modal content_classes="w-auto" target="order-confirm-cancel-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">{{ trans('Cancel order confirmation?') }}</h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div  class="py-4 space-y-3">
            <p>
                {{ trans('Are you sure you want to cancel this order? This action cannot rollback') }}
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
                    x-on:click="$store.order.cancel_order($event).then(() => {$dispatch('ok'); close()})"
                    type="button">
                Confirm payment
            </x-button>
        </div>
    </x-slot>
</x-modal>