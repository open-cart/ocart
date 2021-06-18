<x-modal content_classes="w-auto" target="select-country-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">
                {{ trans('plugins/ecommerce::shipping.add_shipping_region') }}
            </h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div  class="py-4 space-y-3">
            <div class="flex flex-col">
                <label for="shipping_method_country">
                    {!! trans('plugins/ecommerce::shipping.country') !!} <span class="text-red-600">*</span>
                </label>
                <x-select name="shipping_method_country"
                          id="shipping_method_country"
                          x-model="$store.shipping_method.country"
                >
                    @php
                        $countries = ['' => 'All'] + \Ocart\Core\Library\Helper::countries();
                    @endphp
                    @foreach($countries as $countryCode => $countryName)
                        <option value="{{ $countryCode }}" >{{ $countryName }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-between pt-2">
           <x-button class=""
                     color="bg-yellow-500 hover:bg-yellow-400 mr-2"
                     x-on:click="close()"
           >
               {{ trans('admin.cancel') }}
           </x-button>
            <x-button title="Save"
                      x-on:click="$store.shipping_method.addShippingRegion().then(() => close() )"
                      class="">
                {{ trans('admin.save') }}
            </x-button>
        </div>
    </x-slot>
</x-modal>