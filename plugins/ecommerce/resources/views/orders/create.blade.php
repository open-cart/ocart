<x-app-layout>
    <x-slot name="header">
        123
    </x-slot>
    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-4" x-data="orderData()">
                <div class="col-span-9 space-y-4">
                    <div class="bg-white p-4 rounded-md space-y-4 border border-white
                     dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600">
                        <div class="title">
                            <h3 class="text-2xl">Order Infomation</h3>
                        </div>
                        <hr class="-mx-4 dark:border-gray-600">

                        <div class="container-list-order-products">
                            {{ apply_filters(ORDER_RENDER_TABLE_ORDER_CREATE, view('plugins.ecommerce::components.orders.render-table-order'), []) }}
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
                                    <x-input placeholder="Note for order..." id="note" x-model="note" class="w-full"/>
                                </div>
                            </div>
                            <div class="w-1/2 space-y-2">
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Amount</div>
                                    <div class="text-right w-36" x-text="amount()">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">
                                        <x-link href="javascript:void(0)"
                                                data-toggle="modal"
                                                data-target="#order-discount-modal"
                                                x-bind:class="{
                                                    'selected:text-gray-400 pointer-events-none': !data.length,
                                                }"
                                                class="hover:underline font-medium">
                                            {{ trans('plugins/ecommerce::orders.add_discount') }}
                                        </x-link>
                                        <div class="text-sm" x-text="discount_description"></div>
                                    </div>
                                    <div class="text-right w-36" x-text="discount_amount"></div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">
                                        <x-link data-toggle="modal"
                                                data-target="#order-shipping-fee-modal"
                                                href="javascript:void(0)"
                                                x-bind:class="{
                                                    'selected:text-gray-400 pointer-events-none': !data.length,
                                                }"
                                                class="font-medium">
                                            {{ trans('plugins/ecommerce::orders.add_shipping_fee') }}
                                        </x-link>
                                        <div class="-mt-2">
                                            <span class="text-xs" x-text="$store.order.shipping_method_name">&nbsp;</span>
                                        </div>
                                    </div>
                                    <div class="text-right w-36 flex items-end justify-end" x-text="$store.order.shipping_amount">{!! format_price(0) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Total</div>
                                    <div class="text-right w-36" x-text="totalAmount()">{!! format_price(0) !!}</div>
                                </div>
                            </div>
                        </div>
                        <hr class="-mx-4 dark:border-gray-600">
                        <div class="flex justify-between items-center">
                            <div>
                                <i class="fa fa-credit-card fa-1-5 text-blue-500"></i>
                                <span>CONFIRM PAYMENT AND CREATE ORDER</span>
                            </div>
                            <div>
                                <x-button data-toggle="modal" data-target="#order-create-paid-modal">Paid</x-button>
                                <x-button data-toggle="modal" data-target="#order-create-modal">Pay leter</x-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 space-y-4">
                    <div class="rounded-md bg-white border dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                        <div class="px-6 py-4 space-y-2" x-on:change-item="changeCustomer">
                            <template x-if="!customer">
                                <div>
                                    <h3>Customer infomation</h3>
                                    <x-plugins.ecommerce::input-search
                                            name="Customers"
                                            placeholder="Search or create customer..."
                                            source="{!! route('ecommerce.customers.search') !!}">
                                        <x-slot name="first">
                                            <div class="flex items-center hover:bg-blue-50 dark:hover:bg-gray-600 cursor-pointer px-2 pl-5"
                                                 data-toggle="modal"
                                                 data-target="#order-create-customer-modal">
                                                <img src="//hstatic.net/0/0/global/design/imgs/next-create-customer.svg" alt="user" class="w-8">
                                                <span class="px-2 py-3">Create customer</span>
                                            </div>
                                            <hr class="dark:border-gray-600">
                                        </x-slot>
                                    </x-plugins.ecommerce::input-search>
                                </div>
                            </template>
                            <template x-if="customer">
                                <div class="space-y-4 pb-6">
                                    <div class="flex justify-between">
                                        <h3>Customer</h3>
                                        <x-link href="javascript:void(0)" x-on:click="removeCustomer">
                                            <svg id="next-remove" class="w-3 h-3 fill-current text-blue-700 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24"><path d="M19.5 22c-.2 0-.5-.1-.7-.3L12 14.9l-6.8 6.8c-.2.2-.4.3-.7.3-.2 0-.5-.1-.7-.3l-1.6-1.6c-.1-.2-.2-.4-.2-.6 0-.2.1-.5.3-.7L9.1 12 2.3 5.2C2.1 5 2 4.8 2 4.5c0-.2.1-.5.3-.7l1.6-1.6c.2-.1.4-.2.6-.2.3 0 .5.1.7.3L12 9.1l6.8-6.8c.2-.2.4-.3.7-.3.2 0 .5.1.7.3l1.6 1.6c.1.2.2.4.2.6 0 .2-.1.5-.3.7L14.9 12l6.8 6.8c.2.2.3.4.3.7 0 .2-.1.5-.3.7l-1.6 1.6c-.2.1-.4.2-.6.2z"></path></svg></svg>
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
                                    <hr class="-mx-6">
                                    <div class="flex justify-between">
                                        <h3>Shipping Address</h3>
                                        <x-link href="javascript:void(0)"
                                                data-toggle="modal"
                                                data-target="#order-update-address-modal">
                                            <svg class="w-3 h-3 fill-current text-blue-700 hover:underline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55.25 55.25"><path d="M52.618,2.631c-3.51-3.508-9.219-3.508-12.729,0L3.827,38.693C3.81,38.71,3.8,38.731,3.785,38.749  c-0.021,0.024-0.039,0.05-0.058,0.076c-0.053,0.074-0.094,0.153-0.125,0.239c-0.009,0.026-0.022,0.049-0.029,0.075  c-0.003,0.01-0.009,0.02-0.012,0.03l-3.535,14.85c-0.016,0.067-0.02,0.135-0.022,0.202C0.004,54.234,0,54.246,0,54.259  c0.001,0.114,0.026,0.225,0.065,0.332c0.009,0.025,0.019,0.047,0.03,0.071c0.049,0.107,0.11,0.21,0.196,0.296  c0.095,0.095,0.207,0.168,0.328,0.218c0.121,0.05,0.25,0.075,0.379,0.075c0.077,0,0.155-0.009,0.231-0.027l14.85-3.535  c0.027-0.006,0.051-0.021,0.077-0.03c0.034-0.011,0.066-0.024,0.099-0.039c0.072-0.033,0.139-0.074,0.201-0.123  c0.024-0.019,0.049-0.033,0.072-0.054c0.008-0.008,0.018-0.012,0.026-0.02l36.063-36.063C56.127,11.85,56.127,6.14,52.618,2.631z   M51.204,4.045c2.488,2.489,2.7,6.397,0.65,9.137l-9.787-9.787C44.808,1.345,48.716,1.557,51.204,4.045z M46.254,18.895l-9.9-9.9  l1.414-1.414l9.9,9.9L46.254,18.895z M4.961,50.288c-0.391-0.391-1.023-0.391-1.414,0L2.79,51.045l2.554-10.728l4.422-0.491  l-0.569,5.122c-0.004,0.038,0.01,0.073,0.01,0.11c0,0.038-0.014,0.072-0.01,0.11c0.004,0.033,0.021,0.06,0.028,0.092  c0.012,0.058,0.029,0.111,0.05,0.165c0.026,0.065,0.057,0.124,0.095,0.181c0.031,0.046,0.062,0.087,0.1,0.127  c0.048,0.051,0.1,0.094,0.157,0.134c0.045,0.031,0.088,0.06,0.138,0.084C9.831,45.982,9.9,46,9.972,46.017  c0.038,0.009,0.069,0.03,0.108,0.035c0.036,0.004,0.072,0.006,0.109,0.006c0,0,0.001,0,0.001,0c0,0,0.001,0,0.001,0h0.001  c0,0,0.001,0,0.001,0c0.036,0,0.073-0.002,0.109-0.006l5.122-0.569l-0.491,4.422L4.204,52.459l0.757-0.757  C5.351,51.312,5.351,50.679,4.961,50.288z M17.511,44.809L39.889,22.43c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0  L16.097,43.395l-4.773,0.53l0.53-4.773l22.38-22.378c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0L10.44,37.738  l-3.183,0.354L34.94,10.409l9.9,9.9L17.157,47.992L17.511,44.809z M49.082,16.067l-9.9-9.9l1.415-1.415l9.9,9.9L49.082,16.067z"></path></svg>
                                        </x-link>
                                    </div>
                                    <template x-if="!customer_addresses.length">
                                        <div>No address</div>
                                    </template>
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
                            </template>
                        </div>
                    </div>
                </div>
                <div x-on:before-show="showCreateModal()">
                    <x-plugins.ecommerce::orders.create-modal/>
                </div>

                <div x-on:before-show="showCreatePaidModal()">
                    <x-plugins.ecommerce::orders.create-modal target="order-create-paid-modal"/>
                </div>

                <div x-on:before-show="openModelEditAdress()" x-on:ok="updateOrderAddress">
                    <x-plugins.ecommerce::orders.update-address-modal/>
                </div>

                <div x-on:before-show="showCreateNewCustomerForm()" x-on:ok="createNewCustomer($event)">
                    <x-plugins.ecommerce::orders.create-customer-modal/>
                </div>

                <div x-on:accept="changeDiscount" x-on:close="closeDiscount">
                   <x-plugins.ecommerce::orders.discount-modal/>
                </div>

                <div x-on:before-show="openShippingFee()">
                    <x-plugins.ecommerce::orders.shipping-fee-modal/>
                </div>
            </div>
        </div>
    </div>
    <script>
        function clone(data) {
            return JSON.parse(JSON.stringify(data));
        }
        Spruce.store('customer', {
            name: ''
        })
        var storeOrder = {
            total: '',
            payment_method: 'cod',
            payment_status: null,
            shipping_option: null,
            shipping_method_name: 'Default',
            shipping_amount: 0,
            changeShippingMethod(shipping_method) {
                this.shipping_option = shipping_method.value;
                this.shipping_method_name = shipping_method.name;
                this.shipping_amount = shipping_method.price;
                return Promise.resolve();
            }
        };
        Spruce.store('order', storeOrder)
        Spruce.reset('order', storeOrder)
        Spruce.store('shipping_methods', {
            data: [
                {
                    value: '',
                    name: 'Free shipping',
                    price: 0
                }
            ],
            selected: {
                value: '',
                name: 'Default',
            },
            changeShippingMethod(shipping_method) {
                this.selected = {
                    value: shipping_method.value + '',
                    name: shipping_method.name,
                    price: shipping_method.price
                }
            }
        })
        function showError(e) {
            if (e?.errors) {
                toast.error(Object.values(e.errors).find(Boolean));
            } else {
                toast.error(e.message);
            }
            throw e;
        }
        function orderData() {
            function productItem(product) {
                product.total = () => {
                    return product.qty * product.price;
                };
                return product;
            }

            return {
                customer: null,
                customer_addresses: [],
                customer_address: null,
                note: null,
                data: [],
                discount_amount: 0,
                discount_type: 0,
                discount_description: null,
                openShippingFee() {
                    this.$store.shipping_methods.selected = {
                        value: this.$store.order.shipping_option,
                        name: this.$store.order.shipping_method_name,
                        price: this.$store.order.shipping_amount,
                    }
                    axios.post('{{ route('ecommerce.orders.get_available_shipping_methods') }}', {
                        // country: 'VN',
                        ...this.customer_address,
                        products: this.data.map(product => ({id: product.id, qty: product.qty})),
                    }).then((res) => {
                        this.$store.shipping_methods.data = res.data;
                    })
                },
                changeDiscount() {
                    const discount = Number($("#discount").val());
                    const discount_type = $("#discount_type").val();
                    const amount = this.amount();
                    let discount_amount = discount;
                    if (discount_type === '2') {
                        discount_amount = amount / (100 / discount);
                    }
                    if (discount_amount !== this.discount_amount) {
                        this.discount_amount = discount_amount;
                    }
                    this.discount_description = $("#discount_description").val();
                },
                closeDiscount() {
                    if (this.discount_description !== null) {
                        this.discount_description = $("#discount_description").val();
                    }
                },
                changeProduct(e) {
                    e.detail.qty = 1;
                    const product = new productItem(e.detail);
                    if (!this.data.some(x => x.id == product.id)) {
                        this.data.push(product);
                    }
                },
                showCreateNewCustomerForm() {
                    this.$store.customer = {};
                    this.$store.order.createNewCustomer = this.createNewCustomer.bind(this);
                },
                createNewCustomer() {
                    this.$store.order.loading = true;
                    return axios.post('{!! route('ecommerce.customers.create-customer-when-creating-order') !!}', this.$store.customer)
                        .then(res => {
                            this.customer = res.data?.customer;
                            this.$store.order.customerExists = true;
                            toast.success('Customer saved');
                            return this.loadCustomerAddress();
                        })
                        .catch(showError)
                        .finally(() => {
                            this.$store.order.loading = false;
                        })
                },
                changeCustomer(e) {
                    this.customer = e.detail;
                    this.$store.order.customerExists = true;
                    this.loadCustomerAddress();
                },
                loadCustomerAddress() {
                    this.customer_address = {};
                    return axios.get('{!! route('ecommerce.customers.get-customer-addresses') !!}', {
                        params: {
                            id: this.customer.id,
                        }
                    }).then(res => {
                        this.customer_addresses = res?.data || [];
                        if (this.customer_addresses.length) {
                            this.customer_address = this.customer_addresses.find(Boolean);
                            // this.$store.customer = this.customer_address;
                        }
                    })
                },
                openModelEditAdress() {
                    this.$store.customer = {...this.customer_address};
                    this.$store.order.updateOrderAddress = this.updateOrderAddress.bind(this);
                },
                updateOrderAddress() {
                    this.customer_address = {...this.$store.customer};
                    return Promise.resolve();
                },
                removeCustomer() {
                    this.$store.order.customerExists = false;
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
                    this.changeDiscount()
                    return this.amount() - this.discount_amount;
                },
                showCreateModal() {
                    this.$store.order.submit = this.submit.bind(this);
                    this.$store.order.total = this.totalAmount();
                    this.$store.order.payment_status = '{!! \Ocart\Payment\Enums\PaymentStatusEnum::PENDING !!}'
                },
                showCreatePaidModal() {
                    this.$store.order.submit = this.submit.bind(this);
                    this.$store.order.total = this.totalAmount();
                    this.$store.order.payment_status = '{!! \Ocart\Payment\Enums\PaymentStatusEnum::COMPLETED !!}'
                },
                submit() {
                    this.$store.order.loading = true;
                    return axios.post('{!! route('ecommerce.orders.store') !!}', {
                        customer_id: this.customer?.id,
                        customer_address: this.customer_address,
                        note: this.note,
                        amount: this.amount(),
                        discount_amount: this.discount_amount,
                        payment_method: this.$store.order.payment_method,
                        payment_status: this.$store.order.payment_status,
                        shipping_option: this.$store.order.shipping_option,
                        shipping_amount: this.$store.order.shipping_amount,
                        products: this.data.map(product => ({id: product.id, qty: product.qty})),
                    }).then((res) => {
                        $.pjax.reload('#body', {
                            url: '{!! route('ecommerce.orders.index') !!}/' + res.data.id //route('ecommerce.orders.update', ['id' => res.data.id])
                        });
                        toast.success('Order saved');
                    }).catch(showError).finally(() => {
                        this.$store.order.loading = false;
                    })
                }
            };
        }
    </script>
</x-app-layout>
