@props(['target' => 'tag-create-modal'])

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
                          class="w-full" name="payment_method">
                    <option value="cod">Cash on delivery (Cod)</option>
                    <option value="bank">Bank transfer</option>
                </x-select>
            </div>
            <p>
                Pending amount:
            </p>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end pt-2">

        </div>
    </x-slot>
</x-modal>