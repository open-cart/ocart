<x-modal content_classes="w-auto" target="add-shipping-rule-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">
                {{ trans('plugins/ecommerce::shipping.add_shipping_fee_for_area') }}
            </h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div  class="py-4 space-y-3">
            <div class="flex flex-col w-6xl">
                <label for="">
                    {{ trans('plugins/ecommerce::shipping.name_of_shipping_rule') }}
                </label>
                <x-input x-model="$store.shipping_method.addShippingRuleData.name"/>
            </div>
            <div class="flex flex-between space-x-4">
                <div class="flex flex-col w-96">
                    <label for="shipping_method_type">
                        {{ trans('plugins/ecommerce::shipping.type') }}
                    </label>
                </div>
                <div class="flex flex-col w-96">
                    <label for="shipping_method_from">
                        {{ trans('plugins/ecommerce::shipping.based_on_product_of_the_price') }}
                    </label>
                </div>
            </div>
            <div class="flex flex-between space-x-4">
                <div class="flex flex-col w-96">
                    <x-select name="shipping_method_type"
                              id="shipping_method_type"
                              x-model="$store.shipping_method.addShippingRuleData.type"
                    >
                        <option value="base_on_price" >
                            {{ trans('plugins/ecommerce::shipping.based_on_product_of_the_price') }}
                        </option>
                    </x-select>
                </div>
                <div class="flex flex-between w-96 space-x-4">
                    <div class="flex flex-col w-48">
                        <x-input class="w-full"
                                 id="shipping_method_from"
                        x-model="$store.shipping_method.addShippingRuleData.from"/>
                    </div>
                    <div class="flex flex-col w-44">
                        <x-input class="w-full" x-model="$store.shipping_method.addShippingRuleData.to"/>
                    </div>
                </div>
            </div>
            <div class="flex flex-between">
                <div class="flex flex-col w-96">
                    <label for="shipping_method_price">
                        {{ trans('plugins/ecommerce::shipping.shipping_fee') }}
                    </label>
                    <x-input class="w-full"
                             id="shipping_method_price"
                             x-model="$store.shipping_method.addShippingRuleData.price"/>
                </div>
                <div>&nbsp;</div>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end pt-2">
            <x-button class=""
                      color="bg-yellow-500 hover:bg-yellow-400 mr-2"
                      x-on:click="close()"
            >
                {{ trans('admin.cancel') }}
            </x-button>
            <x-button x-on:click="$store.shipping_method.addShippingRule().then(() => close())">
                {{ trans('admin.save') }}
            </x-button>
        </div>
    </x-slot>
</x-modal>