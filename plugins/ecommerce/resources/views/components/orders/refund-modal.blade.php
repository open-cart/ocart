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
                <tr class="border-b">
                    <th class="w-96 text-left">Product</th>
                    <th class="text-center p-3">Price</th>
                    <th class="text-center p-3">Quantity</th>
                    <th class="text-center p-3">Restock quantity</th>
                    <th class="text-center p-3">Remain</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $key => $product)
                    <tr class="border-b">
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
                            <x-input type="number" x-model="$store.refund.data[{{ $key }}]?.quantity"/>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="flex justify-between">
                <div>&nbsp;</div>
                <div>
                    <label class="flex items-center space-x-3 mb-3">
                        <input checked type="checkbox" class="rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                        <span>Return <span x-text="$store.refund.sumQuantity()"></span> product</span>
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
            <x-button
                    x-on:click="$store.refund.save($event).then(() => {$dispatch('ok'); close()})"
                    type="button">
                <span>Refund</span>
                <span class="ml-2" x-text="$store.refund.refund_amount"></span>
            </x-button>
        </div>
    </x-slot>
</x-modal>