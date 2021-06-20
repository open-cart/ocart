<x-modal content_classes="w-auto" target="order-refund-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">Refund</h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="py-4 space-y-3">
            <table>
                <thead>
                <tr>
                    <th class="w-96 text-left">Product</th>
                    <th class="text-center p-3">Price</th>
                    <th class="text-center p-3">Quantity</th>
                    <th class="text-center p-3">Restock quantity</th>
                    <th class="text-center p-3">Remain</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $key => $product)
                    <tr>
                        <td class="text-left">
                            {!! $product->product_name !!}
                        </td>
                        <td class="text-center">
                            {!! format_price($product->price) !!}
                        </td>
                        <td class="text-center">
                            <span>{!! $product->qty !!}</span>
                        </td>
                        <td class="text-center">
                            <span>{!! $product->restock_quantity !!}</span>
                        </td>
                        <td class="text-center">
                            @if($product->qty - $product->restock_quantity > 0)
                            <x-input type="number" x-model="$store.refund.data[{{ $key }}].quantity"/>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="flex justify-between">
                <div>&nbsp;</div>
                <div>
                    <label>
                        <x-input type="checkbox"/>
                        Return <span x-text="$store.refund.sumQuantity()"></span> product
                    </label>
                    <div class="flex justify-between">
                        <div class="flex justify-end">Shipping fee:</div>
                        <div class="flex justify-end">0</div>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex justify-end">Shipping fee:</div>
                        <div class="flex justify-end">0</div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="flex justify-between">
                <div>
                    Cash on delivery
                </div>
                <div>
                    <x-input x-model="$store.refund.refund_amount"/>
                </div>
            </div>
            <hr>
            <div class="flex flex-col">
                <label for="refund-reason">Refund reason (optional)</label>
                <x-input x-model="$store.refund.refund_note"/>
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
            <template x-if="$store.refund.loading">
                <x-button type="button">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing
                </x-button>
            </template>
            <template x-if="!$store.refund.loading">
                <x-button
                        x-on:click="$store.refund.save().then(() => {$dispatch('ok'); close()})"
                        type="button">
                    <span>Refund</span>
                    <span class="ml-2" x-text="$store.refund.refund_amount"></span>
                </x-button>
            </template>
        </div>
    </x-slot>
</x-modal>