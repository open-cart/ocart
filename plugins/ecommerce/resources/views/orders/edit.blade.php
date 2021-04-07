<x-app-layout>
    <x-slot name="header">
        123
    </x-slot>
    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-4" x-data="orderUpdateData()">
                <div class="col-span-9 space-y-4">
                    <div class="bg-white p-4 rounded-md space-y-4"
                    >
                        <a href="">Reload</a>
                        <div class="title">
                            <h3 class="text-2xl">Order Infomation #idorder</h3>
                        </div>
                        <div>
                            .... Completed
                        </div>
                        <hr class="-mx-4">
                        <div class="container-list-order-products">
                            <div class="">
                                <div class="flex items-center py-2">
                                    <div class="flex-1 flex items-center">
                                        <img class="px-2 h-10" src="/images/no-image.jpg" alt="">
                                        <div class="flex flex-col flex-1">
                                            <x-link href="javascript:void(0)">Name (SKU:...)</x-link>
                                            {{--                                            <span>attr</span>--}}
                                        </div>
                                    </div>
                                    <x-link class="flex-1 max-w-24 text-right">

                                    </x-link>
                                    <div class="flex-1 max-w-8 flex justify-center">
                                        <span>x</span>
                                    </div>
                                    <div class="flex-1 max-w-48">
                                        <span>1</span>
                                    </div>
                                    <div class="flex-1 max-w-24 text-right">
                                        {!! format_price(10000) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2">
                                <div class="flex flex-col">
                                    <label for="note">Note</label>
                                    <x-input placeholder="Note for order..." id="note" class="w-full"/>
                                    <div class="h-2"></div>
                                    <x-button class="w-20">Save</x-button>
                                </div>
                            </div>
                            <div class="w-1/2 space-y-2">
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Sub amount</div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Discount</div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Shipping fee</div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Tax</div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Total amount</div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <hr>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Paid amount</div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                            </div>
                        </div>
                        <hr class="-mx-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <i class="fa fa-credit-card fa-1-5 text-blue-500"></i>
                                <span>CONFIRM ORDER</span>
                            </div>
                            <div>
                                <x-button data-toggle="modal" data-target="#order-create-paid-modal">Confirm</x-button>
                            </div>
                        </div>
                        <hr class="-mx-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <i class="fa fa-credit-card fa-1-5 text-blue-500"></i>
                                <span>PENDING PAYMENT</span>
                            </div>
                            <div>
                                <x-button data-toggle="modal" data-target="#order-create-paid-modal">Confirm payment</x-button>
                            </div>
                        </div>
                        <hr class="-mx-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <i class="fa fa-credit-card fa-1-5 text-blue-500"></i>
                                <span class="uppercase">Delivery</span>
                            </div>
                            <div>
                                <x-button data-toggle="modal" data-target="#order-create-paid-modal">Delivery</x-button>
                            </div>
                        </div>

                    </div>

                    <div class="bg-white">
                        <h3 class=" p-4">History</h3>
                        <hr>
                        <div class="p-4">
                            <ul>
                                <li>
                                    <div class="flex justify-between">
                                        <div>name</div>
                                        <div>time</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 space-y-4">
                    <div class="rounded-md bg-white">
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
                                        <x-link href="javascript:void(0)" x-text="customer.name"></x-link>
                                    </div>
                                    <div>
                                        <x-link href="javascript:void(0)" x-text="customer.email"/>
                                    </div>
                                </div>
                                <hr class="-mx-6">
                                <div class="flex justify-between">
                                    <h3>Shipping Address</h3>
                                    <x-link href="javascript:void(0)"
                                            data-toggle="modal"
                                            data-target="#order-update-address-modal">
                                        <svg class="w-3 h-3 fill-current text-blue-700 hover:underline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55.25 55.25"><path d="M52.618,2.631c-3.51-3.508-9.219-3.508-12.729,0L3.827,38.693C3.81,38.71,3.8,38.731,3.785,38.749  c-0.021,0.024-0.039,0.05-0.058,0.076c-0.053,0.074-0.094,0.153-0.125,0.239c-0.009,0.026-0.022,0.049-0.029,0.075  c-0.003,0.01-0.009,0.02-0.012,0.03l-3.535,14.85c-0.016,0.067-0.02,0.135-0.022,0.202C0.004,54.234,0,54.246,0,54.259  c0.001,0.114,0.026,0.225,0.065,0.332c0.009,0.025,0.019,0.047,0.03,0.071c0.049,0.107,0.11,0.21,0.196,0.296  c0.095,0.095,0.207,0.168,0.328,0.218c0.121,0.05,0.25,0.075,0.379,0.075c0.077,0,0.155-0.009,0.231-0.027l14.85-3.535  c0.027-0.006,0.051-0.021,0.077-0.03c0.034-0.011,0.066-0.024,0.099-0.039c0.072-0.033,0.139-0.074,0.201-0.123  c0.024-0.019,0.049-0.033,0.072-0.054c0.008-0.008,0.018-0.012,0.026-0.02l36.063-36.063C56.127,11.85,56.127,6.14,52.618,2.631z   M51.204,4.045c2.488,2.489,2.7,6.397,0.65,9.137l-9.787-9.787C44.808,1.345,48.716,1.557,51.204,4.045z M46.254,18.895l-9.9-9.9  l1.414-1.414l9.9,9.9L46.254,18.895z M4.961,50.288c-0.391-0.391-1.023-0.391-1.414,0L2.79,51.045l2.554-10.728l4.422-0.491  l-0.569,5.122c-0.004,0.038,0.01,0.073,0.01,0.11c0,0.038-0.014,0.072-0.01,0.11c0.004,0.033,0.021,0.06,0.028,0.092  c0.012,0.058,0.029,0.111,0.05,0.165c0.026,0.065,0.057,0.124,0.095,0.181c0.031,0.046,0.062,0.087,0.1,0.127  c0.048,0.051,0.1,0.094,0.157,0.134c0.045,0.031,0.088,0.06,0.138,0.084C9.831,45.982,9.9,46,9.972,46.017  c0.038,0.009,0.069,0.03,0.108,0.035c0.036,0.004,0.072,0.006,0.109,0.006c0,0,0.001,0,0.001,0c0,0,0.001,0,0.001,0h0.001  c0,0,0.001,0,0.001,0c0.036,0,0.073-0.002,0.109-0.006l5.122-0.569l-0.491,4.422L4.204,52.459l0.757-0.757  C5.351,51.312,5.351,50.679,4.961,50.288z M17.511,44.809L39.889,22.43c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0  L16.097,43.395l-4.773,0.53l0.53-4.773l22.38-22.378c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0L10.44,37.738  l-3.183,0.354L34.94,10.409l9.9,9.9L17.157,47.992L17.511,44.809z M49.082,16.067l-9.9-9.9l1.415-1.415l9.9,9.9L49.082,16.067z"></path></svg>
                                    </x-link>
                                </div>
                                <div class="flex flex-col">
                                    <template x-if="customer_addresses.length > 1">
                                        <div>select address</div>
                                    </template>
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

                    <div class="rounded-md bg-white">
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
                </div>
            </div>
        </div>
    </div>
    <script>
        function orderUpdateData() {

            return {};
        }
    </script>
</x-app-layout>
