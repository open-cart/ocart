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
            <x-link class="flex-1 max-w-24 text-right" x-text="item.sell_price">

            </x-link>
            <div class="flex-1 max-w-8 flex justify-center">
                <span>x</span>
            </div>
            <div class="flex-1 max-w-48">
                <x-input type="number" min="1" x-model="item.qty" class="max-w-48"/>
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
        <hr class="dark:border-gray-600">
    </div>
</template>