<x-app-layout>
    <div class="pb-12 pt-3">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div x-data="{tab: 1}" class="p-6 bg-white border-b border-gray-200">
{{--                    <div>--}}
{{--                        <nav>--}}
{{--                            <ul class="flex">--}}
{{--                                <li x-on:click="tab = 1"--}}
{{--                                    :class="{'border-b-2 border-indigo-600': tab===1}"--}}
{{--                                    class="py-2 px-4 cursor-pointer">--}}
{{--                                    <span>Cấu hình chung</span>--}}
{{--                                </li>--}}
{{--                                <li x-on:click="tab = 2"--}}
{{--                                    :class="{'border-b-2 border-indigo-600': tab===2}"--}}
{{--                                    class="py-2 px-4 cursor-pointer">--}}
{{--                                    <span>Sản phẩm</span>--}}
{{--                                </li>--}}
{{--                                <li x-on:click="tab = 3"--}}
{{--                                    :class="{'border-b-2 border-indigo-600': tab===3}"--}}
{{--                                    class="py-2 px-4 cursor-pointer">--}}
{{--                                    <span>Email</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </nav>--}}
{{--                    </div>--}}
                    <div class="h-3"></div>
                    <div x-show="tab === 1">
                        {!! Form::open(['url' => route('ecommerce.settings')]) !!}
                        <div class="flex">
                            <div class="w-1/3 py-6">
                                <h3 class="text-2xl">
                                    {!! trans('plugins/ecommerce::store.settings.title') !!}
                                </h3>
                                <p>{!! trans('plugins/ecommerce::store.settings.description') !!}</p>
                            </div>
                            <div class="w-2/4">
                                <div class="space-y-4">
                                    <div class="flex flex-col">
                                        <label for="store_name">
                                            {!! trans('plugins/ecommerce::store.shop_name') !!}
                                        </label>
                                        <x-input name="store_name" id="store_name" value="{{ get_ecommerce_setting('store_name') }}"/>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="store_phone">
                                            {!! trans('plugins/ecommerce::store.phone') !!}
                                        </label>
                                        <x-input name="store_phone" id="store_phone" value="{{ get_ecommerce_setting('store_phone') }}"/>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="store_address">
                                            {!! trans('plugins/ecommerce::store.address') !!}
                                        </label>
                                        <x-input name="store_address" id="store_address" value="{{ get_ecommerce_setting('store_address') }}"/>
                                    </div>
                                    <div class="flex -m-2">
                                        <div class="flex flex-col w-1/2 p-2">
                                            <label for="store_state">
                                                {!! trans('plugins/ecommerce::store.state') !!}
                                            </label>
                                            <x-input name="store_state" id="store_state" value="{{ get_ecommerce_setting('store_state') }}"/>
                                        </div>
                                        <div class="flex flex-col w-1/2 p-2">
                                            <label for="store_city">
                                                {!! trans('plugins/ecommerce::store.city') !!}
                                            </label>
                                            <x-input name="store_city" id="store_city" value="{{ get_ecommerce_setting('store_city') }}"/>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="store_country">
                                            {!! trans('plugins/ecommerce::store.country') !!}
                                        </label>
                                        <select name="store_country"
                                                id="store_country"
                                                class="px-4 py-2 border focus:ring-blue-400 focus:border-blue-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        >
                                            @foreach(['' => trans('plugins/ecommerce::store.select_country')] + \Ocart\Core\Library\Helper::countries() as $countryCode => $countryName)
                                                <option value="{{ $countryCode }}" @if (get_ecommerce_setting('store_country') == $countryCode) selected @endif>{{ $countryName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-6">
                        <div class="flex">
                            <div class="w-1/3 py-6">
                                <h3 class="text-2xl">
                                    {!! trans('plugins/ecommerce::ecommerce.setting.other_settings') !!}
                                </h3>
                                <p>
                                    {!! trans('plugins/ecommerce::ecommerce.setting.other_setting_descriptions') !!}
                                </p>
                            </div>
                            <div class="w-2/4">
                                <div class="space-y-4">
                                    <div class="flex flex-col">
                                        <label for="shopping_cart_enabled">
                                            {!! trans('plugins/ecommerce::ecommerce.setting.enable_cart') !!}
                                        </label>
                                        <x-switch
                                            checked="{{ EcommerceHelper::isCartEnabled() ? 'true' : 'false' }}"
                                            name="shopping_cart_enabled"
                                            color="bg-green-600"
                                        />
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="ecommerce_tax_enabled">
                                            {!! trans('plugins/ecommerce::ecommerce.setting.enable_tax') !!}
                                        </label>
                                        <x-switch
                                            checked="{!! EcommerceHelper::isTaxEnabled() ? 'true' : 'false' !!}"
                                            name="ecommerce_tax_enabled"
                                            color="bg-green-600"
                                        />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="h-10"></div>
                        <div class="flex">
                            <div class="w-1/3"></div>
                            <div class="w-1/3">
                                <div>
                                    <x-button type="submit">Save setting</x-button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    </script>
</x-app-layout>
