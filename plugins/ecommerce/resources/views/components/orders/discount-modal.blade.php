<x-modal content_classes="w-96" target="order-discount-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">Add discount</h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div  class="py-4 space-y-4">
            <div class="flex flex-col space-y-1">
                <label>
                    Discount based on
                </label>
                <div class="flex" x-data="{discount_type: '1', discount: 0, discount_description: ''}">
                    <div class="flex-none flex">
                        <x-button x-on:click="discount_type = 1"
                                  x-bind:class="{'selected:bg-blue-100': discount_type == 1}"
                                  color="bg-white hover:bg-blue-100 border border-gray-200 text-gray-900 selected:rounded-tr-none selected:rounded-br-none">đ</x-button>
                        <x-button x-on:click="discount_type = 2"
                                  x-bind:class="{'selected:bg-blue-100': discount_type == 2}"
                                  color="bg-white hover:bg-blue-100 border border-gray-200 text-gray-900 selected:rounded-tl-none selected:rounded-bl-none">%</x-button>
                        <input class="hidden" id="discount_type" x-bind:value="discount_type">
                    </div>
                    <x-input x-model="discount" class="ml-2 flex-grow" id="discount"/>
                </div>
            </div>
            <div class="flex flex-col space-y-1">
                <label for="discount_description">Description</label>
                <x-input class="w-full" id="discount_description"/>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end pt-2">
            <x-button
                    x-on:click="$dispatch('close'); close()"
                    type="button"
                    color="bg-blue-500 hover:bg-blue-400 mr-2">
                Close
            </x-button>
            <x-button
                    x-on:click="$dispatch('accept'); close()"
                    type="button"
                    color="modal-close px-4 bg-red-500 hover:bg-red-400">
                Confirm
            </x-button>
        </div>
    </x-slot>
</x-modal>