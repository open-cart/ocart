<x-app-layout>
    <x-slot name="header">
        123
    </x-slot>
    <div class="pb-12">
        <div class="sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-9 space-y-4">
                    <div class="bg-white p-6 rounded-md space-y-4">
                        <div class="title">
                            <h3 class="text-2xl">Order Infomation</h3>
                        </div>
                        <hr class="-mx-6">

                        <div class="flex" style>
                            <x-plugins.ecommerce::search-product/>
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
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Add discount</div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Ship</div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-right w-full">Total</div>
                                    <div class="text-right w-36">{!! format_price(10000) !!}</div>
                                </div>
                            </div>
                        </div>
                        <hr class="-mx-6">
                        <div class="flex justify-between">
                            <div>Text</div>
                            <div>
                                <x-button>Confirm</x-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 space-y-4">
                    right
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
