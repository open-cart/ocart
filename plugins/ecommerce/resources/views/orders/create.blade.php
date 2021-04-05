<x-app-layout>
    <x-slot name="header">
        123
    </x-slot>
    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-4" x-data="orderData()">
                <div class="col-span-9 space-y-4">
                    <div class="bg-white p-6 rounded-md space-y-4"
                         >
                        <div class="title">
                            <h3 class="text-2xl">Order Infomation</h3>
                        </div>
                        <hr class="-mx-6">

                        <div class="container-list-order-products">
                            <template x-for="(item, index) in data" :key="index">
                                <div class="">
                                    <input type="text" class="hidden" :name="`products[${index}][id]`" :value="item.id">
                                    <div class="flex items-center py-2">
                                        <div class="flex-1 flex items-center">
                                            <img class="px-2 h-10" src="/images/no-image.jpg" alt="">
                                            <div class="flex flex-col flex-1">
                                                <x-link href="javascript:void(0)" x-text="item.name"/>
                                                {{--                                            <span>attr</span>--}}
                                            </div>
                                        </div>
                                        <x-link class="flex-1 max-w-24 text-right" x-text="item.price">

                                        </x-link>
                                        <div class="flex-1 max-w-8 flex justify-center">
                                            <span>x</span>
                                        </div>
                                        <div class="flex-1 max-w-48">
                                            <x-input type="number" x-model="item.qty" class="max-w-48"/>
                                        </div>
                                        <div class="flex-1 max-w-24 text-right" x-text="item.total()">
                                            {!! format_price(10000) !!}
                                        </div>
                                        <div class="flex-1 max-w-10 text-right">
                                            <a href="javascript:void(0)" class="text-red-600" x-on:click="removeProduct(item)">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </template>
                        </div>

                        <div class="flex" x-on:change-item="changeProduct">
                            <x-plugins.ecommerce::input-search
                                    name="Product"
                                    placeholder="Search or create product..."
                                    source="{!! route('ecommerce.products.search') !!}">
                            </x-plugins.ecommerce::input-search>
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2">
                                <div class="flex flex-col">
                                    <label for="note">Note</label>
                                    <x-input id="note" class="w-full"/>
                                </div>
                            </div>
                            <div class="w-1/2 space-y-2">
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Amount</div>
                                    <div class="text-right w-36" x-text="amount()">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">
                                        <x-link href="javascript:void(0)" class="font-medium">
                                            Add discount
                                        </x-link>
                                    </div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">
                                        <x-link href="javascript:void(0)" class="font-medium">
                                            Add shipping fee
                                        </x-link>
                                    </div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Total</div>
                                    <div class="text-right w-36" x-text="totalAmount()">{!! format_price(10000) !!}</div>
                                </div>
                            </div>
                        </div>
                        <hr class="-mx-6">
                        <div class="flex justify-between">
                            <div>Text</div>
                            <div>
                                <x-button x-on:click="submit">Confirm</x-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 space-y-4">
                    <div class="rounded-md bg-white">
                        <div class="px-3 py-6 space-y-2" x-on:change-item="changeCustomer">
                            <template x-if="!customer">
                                <div>
                                    <h3>Customer infomation</h3>
                                    <x-plugins.ecommerce::input-search
                                            name="Customers"
                                            placeholder="Search or create customer..."
                                            source="{!! route('ecommerce.customers.search') !!}">
                                        <x-slot name="first">
                                            <div class="flex items-center hover:bg-blue-50 cursor-pointer px-5">
                                                <img src="//hstatic.net/0/0/global/design/imgs/next-create-customer.svg" alt="user" width="30">
                                                <span class="px-2 py-3">Create customer</span>
                                            </div>
                                            <hr>
                                        </x-slot>
                                    </x-plugins.ecommerce::input-search>
                                </div>
                            </template>
                            <template x-if="customer">
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <h3>Customer</h3>
                                        <x-link href="javascript:void(0)" x-on:click="removeCustomer">
                                            <svg id="next-remove" class="w-4 h-4 fill-current text-blue-700 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24"><path d="M19.5 22c-.2 0-.5-.1-.7-.3L12 14.9l-6.8 6.8c-.2.2-.4.3-.7.3-.2 0-.5-.1-.7-.3l-1.6-1.6c-.1-.2-.2-.4-.2-.6 0-.2.1-.5.3-.7L9.1 12 2.3 5.2C2.1 5 2 4.8 2 4.5c0-.2.1-.5.3-.7l1.6-1.6c.2-.1.4-.2.6-.2.3 0 .5.1.7.3L12 9.1l6.8-6.8c.2-.2.4-.3.7-.3.2 0 .5.1.7.3l1.6 1.6c.1.2.2.4.2.6 0 .2-.1.5-.3.7L14.9 12l6.8 6.8c.2.2.3.4.3.7 0 .2-.1.5-.3.7l-1.6 1.6c-.2.1-.4.2-.6.2z"></path></svg></svg>
                                        </x-link>
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
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function orderData() {
            function productItem(product) {
                product.total = () => {
                    return product.qty * product.price;
                };
                return product;
            }
            return {
                customer: null,
                data: [],
                changeProduct(e) {
                    e.detail.qty = 1;
                    this.data.push(new productItem(e.detail));
                },
                changeCustomer(e) {
                    this.customer = e.detail;
                },
                removeCustomer() {
                    this.customer = null;
                },
                removeProduct(item) {
                    this.data = this.data.filter(product => product != item);
                },
                amount() {
                    return this.data.reduce((total, item) => {
                        return total + item.total();
                    }, 0);
                },
                totalAmount() {
                    return this.data.reduce((total, item) => {
                        return total + item.total();
                    }, 0);
                },
                submit() {
                    axios.post('{!! route('ecommerce.orders.store') !!}', {
                        customer_id: this.customer?.id,
                        amount: this.amount(),
                        products: this.data.map(product => ({id: product.id, qty: product.qty})),
                    })
                }
            }
        }
    </script>
</x-app-layout>
