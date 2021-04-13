<x-modal content_classes="w-auto" target="order-create-customer-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">Create a new customer</h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="py-4 pb-6 space-y-4">
            <div class="flex flex-row space-x-4">
                <div class="flex flex-col">
                    <label for="">Name</label>
                    <x-input class="w-64" x-model="$store.customer.name"/>
                </div>
                <div class="flex flex-col">
                    <label for="">Phone</label>
                    <x-input class="w-64" x-model="$store.customer.phone"/>
                </div>

            </div>
            <div class="flex flex-row space-x-4">
                <div class="flex flex-col">
                    <label for="">Address</label>
                    <x-input class="w-64" x-model="$store.customer.address"/>
                </div>
                <div class="flex flex-col">
                    <label for="">Email</label>
                    <x-input class="w-64" x-model="$store.customer.email"/>
                </div>
            </div>
            <div class="flex flex-col">
                <label for="">Country</label>
                <x-select class="w-full"
                          x-model="$store.customer.country">
                    @foreach(['' => trans('plugins/ecommerce::store.select_country')] + \Ocart\Core\Library\Helper::countries() as $countryCode => $countryName)
                        <option value="{{ $countryCode }}" >{{ $countryName }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex flex-row space-x-4">
                <div class="flex flex-col">
                    <label for="">State</label>
                    <x-input class="w-64" x-model="$store.customer.state"/>
                </div>
                <div class="flex flex-col">
                    <label for="">City/District</label>
                    <x-input class="w-64" x-model="$store.customer.city"/>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end pt-2">
            <x-button
                    x-on:click="$dispatch('shown'); close()"
                    type="button"
                    color="bg-red-500 hover:bg-red-400 mr-2">
                {!! trans('admin.cancel') !!}
            </x-button>
            <template x-if="$store.order.loading">
                <x-button type="button" color="modal-close px-4 bg-blue-500 hover:bg-blue-400">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing
                </x-button>
            </template>
            <template x-if="!$store.order.loading">
                <x-button
                        x-on:click="$store.order.createNewCustomer().then(() => {$dispatch('ok', $store.customer); close()})"
                        type="button"
                        color="modal-close px-4 bg-blue-500 hover:bg-blue-400">
                    {!! trans('admin.save') !!}
                </x-button>
            </template>
        </div>
    </x-slot>
</x-modal>