<x-app-layout>
    <x-slot name="header">
        123
    </x-slot>
    <div class="py-12 pb-28 max-w-screen-xl mx-auto">
        <div class="sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-4" x-data="orderUpdateData()">
                <div class="col-span-9 space-y-4">
                    <div class="bg-white border
                     dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300
                     p-4 rounded-md space-y-4"
                    >
                        <div class="title">
                            <h3 class="text-xl">Order Infomation {!! $order->code !!}</h3>
                        </div>
                        <div class="flex items-center">
                            <x-icons.box class="fill-current text-gray-500"/>
                            <span class="ml-2">Completed</span>
                        </div>
                        <hr class="-mx-4">
                        <div class="container-list-order-products">
                            {{ apply_filters(ORDER_RENDER_TABLE_ORDER_UPDATE, view('plugins.ecommerce::components.orders.render-table-order-update', compact('order')), $order) }}
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2">
                                <div class="flex flex-col">
                                    <label for="note">Note</label>
                                    <x-input placeholder="Note for order..."
                                             id="note"
                                             x-model="order.description"
                                             class="w-full"/>
                                    <div class="h-2"></div>
                                    <x-button x-on:click="updateNote" class="w-20">Save</x-button>
                                </div>
                            </div>
                            <div class="w-1/2 space-y-2">
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Sub amount</div>
                                    <div class="text-right w-36">{!! format_price($order->sub_total) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Discount</div>
                                    <div class="text-right w-36">{!! format_price($order->discount_amount) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Shipping fee</div>
                                    <div class="text-right w-36">{!! format_price($order->shipping_amount) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Tax</div>
                                    <div class="text-right w-36">{!! format_price($order->tax_amount) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Total amount</div>
                                    <div class="text-right w-36">{!! format_price($order->amount) !!}</div>
                                </div>
                                <hr>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Paid amount</div>
                                    <div class="text-right w-36">{!! format_price($order->payment->amount) !!}</div>
                                </div>
                            </div>
                        </div>
                        <div id="body-confirmed" class="space-y-4">
                            <hr class="-mx-4">
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-2">
                                    <svg class="w-6 h-6 @if($order->status != \Ocart\Ecommerce\Enums\OrderStatusEnum::PENDING) text-green-500 @endif fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 18c-.265 0-.52-.105-.707-.293l-6-6c-.39-.39-.39-1.023 0-1.414s1.023-.39 1.414 0l5.236 5.236L18.24 2.35c.36-.42.992-.468 1.41-.11.42.36.47.99.11 1.41l-12 14c-.182.212-.444.338-.722.35H7z"></path></svg>
                                    @if($order->status != \Ocart\Ecommerce\Enums\OrderStatusEnum::PENDING)
                                        <span class="uppercase">Order was confirm</span>
                                    @else
                                        <span class="uppercase">Confirm order</span>
                                    @endif
                                </div>
                                @if($order->status == \Ocart\Ecommerce\Enums\OrderStatusEnum::PENDING)
                                    <div>
                                        <x-button x-on:click="confirmOrder">Confirm</x-button>
                                    </div>
                                @endif
                            </div>
                            <hr class="-mx-4">
                            @if($order->status != \Ocart\Ecommerce\Enums\OrderStatusEnum::CANCELED)
                                @if($order->payment->status == \Ocart\Payment\Enums\PaymentStatusEnum::PENDING)
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2">
                                            <svg class="w-6 h-6 text-gray-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24"><g><path d="M23.6 10H.4c-.2 0-.4.5-.4.7v7.7c0 .7.6 1.6 1.3 1.6h21.4c.7 0 1.3-.9 1.3-1.6v-7.7c0-.2-.2-.7-.4-.7zM20 16.6c0 .2-.2.4-.4.4h-4.1c-.2 0-.4-.2-.4-.4v-2.1c0-.2.2-.4.4-.4h4.1c.2 0 .4.2.4.4v2.1zM22.7 4H1.3C.6 4 0 4.9 0 5.6v1.7c0 .2.2.7.4.7h23.1c.3 0 .5-.5.5-.7V5.6c0-.7-.6-1.6-1.3-1.6z"></path></g></svg>
                                            <span class="uppercase">Pendding payment</span>
                                        </div>
                                        <div>
                                            <x-button data-toggle="modal" data-target="#order-confirm-payment-modal">Confirm payment</x-button>
                                        </div>
                                    </div>
                                @endif
                                @if($order->payment->status == \Ocart\Payment\Enums\PaymentStatusEnum::COMPLETED)
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2">
                                            <svg class="w-6 h-6 text-green-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 18c-.265 0-.52-.105-.707-.293l-6-6c-.39-.39-.39-1.023 0-1.414s1.023-.39 1.414 0l5.236 5.236L18.24 2.35c.36-.42.992-.468 1.41-.11.42.36.47.99.11 1.41l-12 14c-.182.212-.444.338-.722.35H7z"></path></svg>
                                            <span class="uppercase">Payment <span>{!! format_price($order->payment->amount) !!}</span> was accepted</span>
                                        </div>
                                        <div>
                                            <x-button data-toggle="modal" data-target="#order-refund-modal">Refund</x-button>
                                        </div>
                                    </div>
                                @endif
                                @if($order->payment->status == \Ocart\Payment\Enums\PaymentStatusEnum::REFUNDING)
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2">
                                            <span class="uppercase">Payment was refunded</span>
                                        </div>
                                        <div>
                                            <x-button data-toggle="modal" data-target="#order-refund-modal">Refund</x-button>
                                        </div>
                                    </div>
                                @endif
                                @if($order->payment->status == \Ocart\Payment\Enums\PaymentStatusEnum::REFUNDED)
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2">
                                            <span class="uppercase">Payment was refunded</span>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="flex justify-between items-center">
                                    <div class="flex space-x-2">
                                        <svg class="w-6 h-6 text-gray-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.6 0 12 0zm0 4c1.4 0 2.7.4 3.9 1L12 8.8 8.8 12 5 15.9c-.6-1.1-1-2.5-1-3.9 0-4.4 3.6-8 8-8zm0 16c-1.4 0-2.7-.4-3.9-1l3.9-3.9 3.2-3.2L19 8.1c.6 1.1 1 2.5 1 3.9 0 4.4-3.6 8-8 8z"></path></svg>
                                        <span class="uppercase">{{ trans('Order was cancelled') }}</span>
                                    </div>
                                </div>
                            @endif
                            <hr class="-mx-4">
                            <div class="flex justify-between items-center">
                                @if($order->status != \Ocart\Ecommerce\Enums\OrderStatusEnum::COMPLETED)
                                    @if($order->status == \Ocart\Ecommerce\Enums\OrderStatusEnum::CANCELED)
                                        <div class="flex space-x-2">
                                            <svg class="w-6 h-6 text-green-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 18c-.265 0-.52-.105-.707-.293l-6-6c-.39-.39-.39-1.023 0-1.414s1.023-.39 1.414 0l5.236 5.236L18.24 2.35c.36-.42.992-.468 1.41-.11.42.36.47.99.11 1.41l-12 14c-.182.212-.444.338-.722.35H7z"></path></svg>
                                            <span class="uppercase">{{ trans('All products are not delivered') }}</span>
                                        </div>
                                    @else
                                        <div class="flex space-x-2">
                                            <svg class="w-6 h-6 text-gray-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24"><path d="M18.5 8h1.6c.3 0 .7 0 .9.3l2.7 2.6c.2.2.4.5.4.9v5c0 .2-.1.2-.3.2h-.3c-.2 0-.5-.1-.6-.3-.6-1.3-1.9-2.1-3.4-2.1-.6 0-1.3.2-1.9.5-.2.1-.5 0-.5-.2v-5.8c-.1-.7.7-1.1 1.4-1.1zm-17.2-4h12.9c.7 0 .8 1 .8 1.7v10.2c0 .7-.1 1.1-.8 1.1h-3.8c-.2 0-.3 0-.4-.2-.6-1.4-1.9-2.2-3.5-2.2s-2.9.9-3.5 2.2c0 .2-.2.2-.4.2h-1.3c-.7 0-1.3-.4-1.3-1.1v-10.2c0-.7.6-1.7 1.3-1.7z"></path><circle cx="19.3" cy="18.5" r="2.1"></circle><circle cx="6.5" cy="18.5" r="2.1"></circle></svg>
                                            <span class="uppercase">Delivery</span>
                                        </div>
                                        <div>
                                            <x-button x-on:click="markAsFulfilled($event)">Mark as fulfilled</x-button>
                                        </div>
                                    @endif
                                @else
                                    <div class="flex space-x-2">
                                        <svg class="w-6 h-6 text-green-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 18c-.265 0-.52-.105-.707-.293l-6-6c-.39-.39-.39-1.023 0-1.414s1.023-.39 1.414 0l5.236 5.236L18.24 2.35c.36-.42.992-.468 1.41-.11.42.36.47.99.11 1.41l-12 14c-.182.212-.444.338-.722.35H7z"></path></svg>
                                        <span class="uppercase">Delivery</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                        <h3 class=" p-4">
                            {{ trans('plugins/ecommerce::orders.history') }}
                        </h3>
                        <hr>
                        <div class="p-6">
                            <div class="relative w-full">
                                <div style="left: 30px" class="border-r-4 border-gray-300 absolute h-full top-0 z-0"></div>
                                <ul class="list-none m-0 p-0 space-y-8">
                                    <li class="mb-2">
                                        <div class="flex items-top mb-1">
                                            <div class="bg-indigo-600 text-white rounded-full h-12 w-12 border-gray-200 border-2 z-10 ml-2 mt-1">
                                                <svg class="Polaris-Avatar__Svg_375hu" viewBox="0 0 44 44">
                                                    <text x="50%" y="50%" dy="0.35em" fill="currentColor" font-size="20" text-anchor="middle">
                                                        {{ Str::ucfirst(Auth::user()->name[0]) }}
                                                    </text>
                                                </svg>
                                            </div>
                                            <div class="flex-grow ml-3">
                                                <div>
                                                    <textarea wrap="off"
                                                              style="position: fixed; left: 9999px;"
                                                              id="nguyen1232"
                                                              x-text="$store.order.comment"></textarea>
                                                </div>
                                                <div class="relative w-full">
                                                    <textarea x-init="resize"
                                                              x-data="{
                                                              resize() {
                                                                $el.style.height = '55px';
                                                                $el.style.height = $el.scrollHeight + 'px';
                                                                this.$store.order.comment = $el.value;
                                                                const w = $el.scrollWidth - 100;
                                                                const m = document.getElementById('nguyen1232').scrollWidth;
                                                                if (m > w) {
                                                                    $el.style.height = ($el.scrollHeight + 40) + 'px';
                                                                }
                                                                console.log(w, m)
                                                              }
                                                          }"
                                                              placeholder="{{ trans('plugins/ecommerce::orders.leave_a_comment') }}"
                                                              x-on:input="resize"
                                                              id="order-comment"
                                                              class="bg-gray-100 rounded border border-gray-400
                                                 leading-normal resize-none w-full h-14 py-3 px-3 font-medium
                                                  placeholder-gray-700 focus:outline-none focus:bg-white"></textarea>
                                                    <div class="absolute bottom-0 right-0 py-3 pr-2">
                                                        <x-button type="button"
                                                                  color=""
                                                                  x-bind:class="{
                                                                'bg-gray-200 text-gray-500 pointer-events-none': !$store.order.comment?.trim(),
                                                                'bg-indigo-500 hover:bg-indigo-600': !!$store.order.comment?.trim()
                                                              }"
                                                                  x-on:click="postComment()">
                                                            <template x-if="true">
                                                                <span x-show="!loadingComment">
                                                                    {{ trans('plugins/ecommerce::orders.post') }}
                                                                </span>
                                                            </template>
                                                            <template x-if="true">
                                                                <span x-show="loadingComment">
                                                                    <x-icons.loading/>
                                                                </span>
                                                            </template>

                                                        </x-button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @foreach($order->histories as $history)
                                        @if($history->action === 'comment')
                                            <li class="mb-2">
                                                <div class="flex items-center mb-1">
                                                    <div class="flex bg-white shadow-sm pt-3 pb-6 rounded pr-4 z-10 w-full">
                                                        <div class="flex-none bg-indigo-600 text-white rounded-full h-12 w-12 border-gray-200 border-2 z-10 ml-2">
                                                            <svg class="Polaris-Avatar__Svg_375hu" viewBox="0 0 44 44">
                                                                <text x="50%" y="50%" dy="0.35em" fill="currentColor" font-size="20" text-anchor="middle">
                                                                    {{ Str::ucfirst($history->user->name[0]) }}
                                                                </text>
                                                            </svg>
                                                        </div>
                                                        <div class="flex-grow pl-4">
                                                            <div class="w-full">
                                                                <div class="flex justify-between">
                                                                    <div>
                                                                        <strong>
                                                                            {{ Str::ucfirst($history->user->name) }}
                                                                        </strong>
                                                                        <span>
                                                                    {{ $history->created_at->diffForHumans() }}
                                                                </span>
                                                                    </div>
                                                                    <div x-on:click="deleteComment({{ $history->id }})"
                                                                         class="cursor-pointer flex flex-col items-center text-md">
                                                                        <svg class="fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                                <p class="font-medium break-words flex-shrink">
                                                                    {!! \Ocart\Ecommerce\Facades\OrderHelper::processHistoryVariables($history) !!}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>
                                        @elseif($history->action === 'refund')
                                            <li class="mb-2">
                                                <div class="flex flex-col mb-1">
                                                    <div x-bind:class="{'shadow-sm rounded bg-white': open}"
                                                         x-data="{open: false}">
                                                        <div class="flex items-center mb-1 w-full py-3 pr-4">
                                                            <div class="flex-none bg-indigo-600 rounded-full h-4 w-4 border-gray-200 border-2 z-10 ml-6">
                                                            </div>
                                                            <div class="flex-grow">
                                                                <div class="flex justify-between">
                                                                    <div
                                                                            x-on:click="open = !open"
                                                                            class="flex items-center hover:underline cursor-pointer ml-4 font-medium">
                                                                        {!! \Ocart\Ecommerce\Facades\OrderHelper::processHistoryVariables($history) !!}
                                                                        <span x-bind:class="{'transform -rotate-90': !open}">
                                                                            <svg class=" w-4 h-4" viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true">
                                                                                <path d="M5 8l5 5 5-5H5z"></path>
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    <span>
                                                                        {{ $history->created_at->diffForHumans() }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <template x-if="true">
                                                            <div x-show="open" class="z-10 bg-gray-200 bg-opacity-70 pl-10">
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.order_number') }}
                                                                    </div>
                                                                    <div>
                                                                        <x-link href="{{ route('ecommerce.orders.update', $order->id) }}" title="{{ $order->code }}">{{ $order->code }}</x-link>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.description') }}
                                                                    </div>
                                                                    <div>
                                                                        {!! $history->description . ' ' . trans('plugins/ecommerce::orders.from') . ' ' . $order->payment->payment_channel->toHtml() !!}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.amount') }}
                                                                    </div>
                                                                    <div>

                                                                        {{ format_price(Arr::get($history->extras, 'amount', 0)) }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.status') }}
                                                                    </div>
                                                                    <div>
                                                                        {{ trans('plugins/ecommerce::orders.successfully') }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.transaction_type') }}
                                                                    </div>
                                                                    <div>
                                                                        {{ trans('plugins/ecommerce::orders.refund') }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.staff') }}
                                                                    </div>
                                                                    <div>
                                                                        {{ $order->payment->user->name ? $order->payment->user->name : trans('plugins/ecommerce::orders.n_a') }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.refund_date') }}
                                                                    </div>
                                                                    <div>
                                                                        {{ $history->created_at }}
                                                                    </div>
                                                                </div>
                                                                <hr>

                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </li>
                                        @elseif($history->action === 'confirm_payment')
                                            <li class="mb-2">
                                                <div class="flex flex-col mb-1">
                                                    <div x-bind:class="{'shadow-sm rounded bg-white': open}"
                                                         x-data="{open: false}">
                                                        <div class="flex items-center mb-1 w-full py-3 pr-4">
                                                            <div class="flex-none @if($history->user_id) bg-indigo-600 @endif rounded-full h-4 w-4 border-gray-200 border-2 z-10 ml-6">
                                                            </div>
                                                            <div class="flex-grow">
                                                                <div class="flex justify-between">
                                                                    <div
                                                                            x-on:click="open = !open"
                                                                            class="flex items-center hover:underline cursor-pointer ml-4 font-medium">
                                                                        {!! \Ocart\Ecommerce\Facades\OrderHelper::processHistoryVariables($history) !!}
                                                                        <span x-bind:class="{'transform -rotate-90': !open}">
                                                                            <svg class=" w-4 h-4" viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true">
                                                                                <path d="M5 8l5 5 5-5H5z"></path>
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    <span>
                                                                        {{ $history->created_at->diffForHumans() }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <template x-if="true">
                                                            <div x-show="open" class="z-10 bg-gray-200 bg-opacity-70 pl-10">
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.order_number') }}
                                                                    </div>
                                                                    <div>
                                                                        <x-link href="{{ route('ecommerce.orders.update', $order->id) }}" title="{{ $order->code }}">{{ $order->code }}</x-link>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.description') }}
                                                                    </div>
                                                                    <div>
                                                                        {!! trans('plugins/ecommerce::orders.mark_payment_as_confirmed', ['method' => $order->payment->payment_channel->toHtml()]) !!}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.transaction_amount') }}
                                                                    </div>
                                                                    <div>
                                                                        {{ format_price($order->payment->amount) }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.payment_gateway') }}
                                                                    </div>
                                                                    <div>
                                                                        {!! $order->payment->payment_channel->label() !!}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.status') }}
                                                                    </div>
                                                                    <div>
                                                                        {{ trans('plugins/ecommerce::orders.successfully') }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.transaction_type') }}
                                                                    </div>
                                                                    <div>
                                                                        {{ trans('plugins/ecommerce::orders.confirm') }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.staff') }}
                                                                    </div>
                                                                    <div>
                                                                        {{ $order->payment->user->name ? $order->payment->user->name : trans('plugins/ecommerce::orders.n_a') }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3 flex">
                                                                    <div class="w-1/2">
                                                                        {{ trans('plugins/ecommerce::orders.payment_date') }}
                                                                    </div>
                                                                    <div>
                                                                        {{ $history->created_at }}
                                                                    </div>
                                                                </div>
                                                                <hr>

                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </li>
                                        @elseif($history->action === 'added_note')
                                            <li class="mb-2">
                                                <div class="flex flex-col mb-1">
                                                    <div x-bind:class="{'shadow-sm rounded bg-white': open}"
                                                         x-data="{open: false}">
                                                        <div class="flex items-center mb-1 w-full py-3 pr-4">
                                                            <div class="flex-none bg-indigo-600 rounded-full h-4 w-4 border-gray-200 border-2 z-10 ml-6">
                                                            </div>
                                                            <div class="flex-grow">
                                                                <div class="flex justify-between">
                                                                    <div
                                                                            x-on:click="open = !open"
                                                                            class="flex items-center hover:underline cursor-pointer ml-4 font-medium">
                                                                        {!! \Ocart\Ecommerce\Facades\OrderHelper::processHistoryVariables($history) !!}
                                                                        <span x-bind:class="{'transform -rotate-90': !open}">
                                                                            <svg class=" w-4 h-4" viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true">
                                                                                <path d="M5 8l5 5 5-5H5z"></path>
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    <span>
                                                                        {{ $history->created_at->diffForHumans() }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <template x-if="true">
                                                            <div x-show="open" class="z-10 bg-gray-200 bg-opacity-70 pl-10">
                                                                <div class="py-3 px-3">
                                                                    {{ trans('plugins/ecommerce::orders.note') }}
                                                                </div>
                                                                <hr>
                                                                <div class="py-3 px-3">
                                                                    {{ Arr::get($history->extras, 'note', '') }}
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </li>
                                        @else
                                        <li class="mb-2 pr-4">
                                            <div class="flex items-center mb-1">
                                                <div class="flex-none @if($history->user_id) bg-indigo-600 @else bg-gray-400 @endif rounded-full h-4 w-4 border-gray-200 border-2 z-10 ml-6">
                                                </div>
                                                <div class="flex-grow">
                                                    <div class="flex justify-between">
                                                        <div class="flex-1 ml-4 font-medium">
                                                            {!! \Ocart\Ecommerce\Facades\OrderHelper::processHistoryVariables($history) !!}
                                                        </div>
                                                        <time>
                                                        <span>
                                                            {{ $history->created_at->diffForHumans() }}
                                                        </span>
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 space-y-4">
                    <div class="rounded-md bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                        <div class="px-6 py-4 space-y-2">
                            <div class="space-y-4 pb-6">
                                <div class="flex justify-between">
                                    <h3>Customer</h3>
                                </div>
                                <div>
                                    <div class="relative rounded-full w-16 h-16">
                                        <img
                                                src="https://gustui.s3.amazonaws.com/avatar.png"
                                                class="absolute left-0 top-0 w-full h-full rounded-full object-cover"
                                        />
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <x-link href="javascript:void(0)" x-text="customer.name || customer_address.name"></x-link>
                                    </div>
                                    <div>
                                        <x-link href="javascript:void(0)" x-text="customer.email || customer_address.email"/>
                                    </div>
                                </div>
                                <hr class="-mx-6">
                                <div class="flex justify-between">
                                    <h3>Shipping Address</h3>
                                    <x-link href="javascript:void(0)"
                                            data-toggle="modal"
                                            data-target="#order-update-address-modal">
                                        <svg class="w-3 h-3 fill-current text-blue-700 hover:underline"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55.25 55.25">
                                            <path d="M52.618,2.631c-3.51-3.508-9.219-3.508-12.729,0L3.827,38.693C3.81,38.71,3.8,38.731,3.785,38.749  c-0.021,0.024-0.039,0.05-0.058,0.076c-0.053,0.074-0.094,0.153-0.125,0.239c-0.009,0.026-0.022,0.049-0.029,0.075  c-0.003,0.01-0.009,0.02-0.012,0.03l-3.535,14.85c-0.016,0.067-0.02,0.135-0.022,0.202C0.004,54.234,0,54.246,0,54.259  c0.001,0.114,0.026,0.225,0.065,0.332c0.009,0.025,0.019,0.047,0.03,0.071c0.049,0.107,0.11,0.21,0.196,0.296  c0.095,0.095,0.207,0.168,0.328,0.218c0.121,0.05,0.25,0.075,0.379,0.075c0.077,0,0.155-0.009,0.231-0.027l14.85-3.535  c0.027-0.006,0.051-0.021,0.077-0.03c0.034-0.011,0.066-0.024,0.099-0.039c0.072-0.033,0.139-0.074,0.201-0.123  c0.024-0.019,0.049-0.033,0.072-0.054c0.008-0.008,0.018-0.012,0.026-0.02l36.063-36.063C56.127,11.85,56.127,6.14,52.618,2.631z   M51.204,4.045c2.488,2.489,2.7,6.397,0.65,9.137l-9.787-9.787C44.808,1.345,48.716,1.557,51.204,4.045z M46.254,18.895l-9.9-9.9  l1.414-1.414l9.9,9.9L46.254,18.895z M4.961,50.288c-0.391-0.391-1.023-0.391-1.414,0L2.79,51.045l2.554-10.728l4.422-0.491  l-0.569,5.122c-0.004,0.038,0.01,0.073,0.01,0.11c0,0.038-0.014,0.072-0.01,0.11c0.004,0.033,0.021,0.06,0.028,0.092  c0.012,0.058,0.029,0.111,0.05,0.165c0.026,0.065,0.057,0.124,0.095,0.181c0.031,0.046,0.062,0.087,0.1,0.127  c0.048,0.051,0.1,0.094,0.157,0.134c0.045,0.031,0.088,0.06,0.138,0.084C9.831,45.982,9.9,46,9.972,46.017  c0.038,0.009,0.069,0.03,0.108,0.035c0.036,0.004,0.072,0.006,0.109,0.006c0,0,0.001,0,0.001,0c0,0,0.001,0,0.001,0h0.001  c0,0,0.001,0,0.001,0c0.036,0,0.073-0.002,0.109-0.006l5.122-0.569l-0.491,4.422L4.204,52.459l0.757-0.757  C5.351,51.312,5.351,50.679,4.961,50.288z M17.511,44.809L39.889,22.43c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0  L16.097,43.395l-4.773,0.53l0.53-4.773l22.38-22.378c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0L10.44,37.738  l-3.183,0.354L34.94,10.409l9.9,9.9L17.157,47.992L17.511,44.809z M49.082,16.067l-9.9-9.9l1.415-1.415l9.9,9.9L49.082,16.067z"></path>
                                        </svg>
                                    </x-link>
                                </div>
                                <div class="flex flex-col">
                                    <template x-if="customer_address">
                                        <div class="flex flex-col">
                                            <div x-text="customer_address.name">Name</div>
                                            <div x-text="customer_address.phone">Phone</div>
                                            <div x-text="customer_address.email">Email</div>
                                            <div x-text="customer_address.address">Address</div>
                                            <div x-text="customer_address.city">city</div>
                                            <div x-text="customer_address.state">state</div>
                                            <div x-text="customer_address.country">country</div>
                                            <div x-text="customer_address.zipcode">zipcode</div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-md bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                        <div class="px-6 py-4 space-y-2">
                            <div class="space-y-4 pb-6">
                                <div class="flex justify-between">
                                    <h3>Warehouse</h3>
                                </div>
                                <div>
                                    <span>....</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($order->status != \Ocart\Ecommerce\Enums\OrderStatusEnum::CANCELED)
                    <div class="rounded-md bg-white border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                        <div class="px-6 py-4 space-y-2">
                            <div class="space-y-4">
                                <div>
                                    <x-button data-toggle="modal" data-target="#order-confirm-cancel-modal">Cancel</x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div x-on:before-show="openConfirmPayment()">
                    <x-plugins.ecommerce::orders.confirm-payment-modal/>
                </div>
                <div x-on:before-show="openModelEditAdress()">
                    <x-plugins.ecommerce::orders.update-address-modal/>
                </div>

                <div>
                    <x-plugins.ecommerce::orders.refund-modal :order="$order"/>
                </div>
                <div>
                    <x-plugins.ecommerce::orders.confirm-cancel-modal/>
                </div>
            </div>
        </div>
    </div>
    <script>
        Spruce.store('customer', {
            name: '',
            email: ''
        })

        var orderStore = {
            comment: '',
            cancel_order(el) {
                const btn = buttonLoading($(el.target));
                btn.show();
                return axios.post('{{ route('ecommerce.orders.cancel_order', ['id' => $order->id]) }}')
                    .then(res => {
                        toast.success(res.message);
                        $.pjax.reload('#body')
                        return res;
                    }).catch(showError).finally(() => {
                        btn.hide();
                    })
            }
        };

        Spruce.store('order', orderStore)
        Spruce.reset('order', orderStore)
        var refundStoreOption = {
            data: @json($order->products).map(x => {
                return {
                    ...x,
                    quantity: x.qty - x.restock_quantity,
                }
            }),
            sumQuantity() {
                return this.data.reduce((total, p) => {
                    return total + Number(p.quantity);
                }, 0);
            },
            refund_amount: {{ ($order->payment->amount - $order->payment->refunded_amount) }},
            refund_note: '',
            loading: false,
            save(el) {
                if (this.loading) {
                    return Promise.reject();
                }

                this.loading = true;
                const btn = buttonLoading($(el.target));
                btn.show();

                return axios.post('{{ route('ecommerce.orders.refund', ['id' => $order->id]) }}', {
                    products: this.data.map(x => {
                        return {
                            quantity: x.quantity,
                            id: x.product_id,
                        }
                    }),
                    refund_amount: this.refund_amount,
                    refund_note: this.refund_note
                }).then(res => {
                    toast.success(res.message);
                    $.pjax.reload('#body-confirmed');
                    return res;
                }).catch(showError).finally(() => {
                    this.loading = false;
                    btn.hide();
                })
            }
        }

        Spruce.store('refund', refundStoreOption)
        Spruce.reset('refund', refundStoreOption)

        function showError(e) {
            if (e?.errors) {
                toast.error(Object.values(e.errors).find(Boolean));
            } else {
                toast.error(e.message);
            }
            throw e;
        }
        function orderUpdateData() {
            return {
                order: @json($order),
                customer: @json($order->user),
                customer_address: @json($order->address),
                loadingComment: false,
                // note: '',
                updateNote() {
                    bodyLoading.show();
                    axios.put('{!! route('ecommerce.orders.update', ['id' => $order->id]) !!}', {
                        description: this.order.description
                    }).then(() => {
                        toast.success('Note saved');
                    }).catch(showError).finally(() => {
                        bodyLoading.hide();
                    });
                },
                openModelEditAdress() {
                    this.$store.customer = {...this.customer_address};
                    this.$store.order.updateOrderAddress = this.updateOrderAddress.bind(this);
                },
                updateOrderAddress() {
                    this.$store.order.loading = true;
                    return axios.post('{!! route('ecommerce.orders.update-shipping-address', ['id' => $order->address->id]) !!}', {
                        ...this.$store.customer
                    }).then(res => {
                        this.customer_address = this.$store.customer;
                        toast.success('Address saved');
                    }).catch(showError).finally(() => {
                        this.$store.order.loading = false;
                    })
                },
                confirmOrder(e) {
                    $(e.target).addClass('button-loading')
                    axios.post('{!! route('ecommerce.orders.confirm') !!}', {
                        id: {!! $order->id !!}
                    }).then(res => {
                        $.pjax.reload('#body-confirmed')
                        toast.success('Confirm success');
                    }).catch(showError).finally(() => {
                        $(e.target).removeClass('button-loading')
                    })
                },
                openConfirmPayment() {
                    this.$store.order.confirmPayment = this.confirmPayment.bind(this);
                },
                confirmPayment(el) {
                    const btn = buttonLoading($(el.target));
                    btn.show();
                    return axios.post('{!! route('ecommerce.orders.confirm-payment') !!}', {
                        id: {!! $order->id !!}
                    }).then(res => {
                        $.pjax.reload('#body-confirmed');
                        toast.success(res.message);
                        return res;
                    }).catch(showError).finally(() => {
                        btn.hide();
                    })
                },
                markAsFulfilled(el) {
                    const btn = buttonLoading($(el.target));
                    btn.show();
                    return axios.post('{!! route('ecommerce.orders.mark-as-fulfilled', ['id' => $order->id]) !!}')
                        .then(res => {
                            $.pjax.reload('#body-confirmed');
                            toast.success(res.message);
                            return res;
                        })
                        .catch(showError)
                        .finally(() => {
                            btn.hide();
                        })
                },
                postComment() {
                    if (this.loadingComment) {
                        return Promise.reject();
                    }

                    this.loadingComment = true;

                    axios.post('{!! route('ecommerce.orders.comment') !!}', {
                        order_id: {{ $order->id }},
                        comment: $("#order-comment").val()
                    })
                        .then(res => {
                            $.pjax.reload('#body');
                            toast.success('Mark as fulfilled success');
                            return res;
                        })
                        .catch(showError).finally(() => {
                            this.loadingComment = false;
                        })
                },
                deleteComment(id) {
                    confirmDelete.show(() => {
                        return axios.delete('{{ route('ecommerce.orders.delete_comment') }}', {data: {id}})
                            .then(res => {
                                toast.success('Deleted successfully')
                                $.pjax.reload('#body', {});
                                return res;
                            })
                            .catch(e => {
                                toast.error(e.message);
                            })
                    })
                }
            };
        }
    </script>
</x-app-layout>
