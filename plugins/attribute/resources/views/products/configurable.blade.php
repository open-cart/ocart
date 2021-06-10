<div class="rounded-md bg-white border border-white dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700"
     x-data="{}"
>
    <div class="border-b px-6 py-3 flex justify-between dark:border-gray-700">
        <h4>
            <span> {{ trans('plugins/attribute::attributes.product_has_variations') }}</span>
        </h4>
        <div>
            <a x-on:click="toggle"
               href="javascript:void(0)">{{ trans('plugins/attribute::attributes.edit_attribute') }}</a>
        </div>
    </div>
    <div class="p-4">
        <table class="w-full">
            <thead>
            <tr>
                <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    Images
                </th>
                @foreach($group as $item)
                <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    {{ $item->attributeGroup->title }}
                </th>
                @endforeach
                <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">Price</th>
                <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">Is Default</th>
                <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productRelated as $productItem)
            <tr>
                <td class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    <img src="{{ TnMedia::url($productItem->product->image ?? asset('/images/no-image.jpg')) }}"
                         class="w-14"
                         alt="{{ $productItem->product->name }}">
                </td>
                @php
                    $listAttr = $productItem->items->pluck('attribute', 'attribute.attribute_group_id')
                @endphp
                @foreach($group as $item)
                    <td class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                        @if(isset($listAttr[$item->attributeGroup->id]))
                        {{ $listAttr[$item->attributeGroup->id]->title }}
                        @else
                        --
                        @endif
                    </td>
                @endforeach
                <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    {{ format_price($productItem->product->sell_price) }}
                    @if($productItem->product->price && $productItem->product->price > $productItem->product->sell_price)
                        <span class="line-through text-red-500">{{ format_price($productItem->product->price) }}</span>
                    @endif
                </th>
                <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    <input type="radio"
                           {{ $productItem->is_default == 1 ? 'checked' : '' }}
                           value="{{ $productItem->product_id }}"
                           name="variation_default_id"/>
                </th>
                <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
{{--                    <template x-if="$store.variation_related.loadingShow">--}}
{{--                        <x-button type="button"--}}

{{--                        >--}}
{{--                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">--}}
{{--                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>--}}
{{--                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>--}}
{{--                            </svg>--}}
{{--                        </x-button>--}}

{{--                    </template>--}}

{{--                    <template x-if="!$store.variation_related.loadingShow">--}}
{{--                        <x-button type="button"--}}
{{--                                  x-on:click.prevent="$store.variation_related.showUpdate({{ $productItem->product_id }})">--}}
{{--                            Edit--}}
{{--                        </x-button>--}}
{{--                    </template>--}}
                    <a href="javascript:void(0)"
                       x-on:click.prevent="$store.variation_related.showUpdate({{ $productItem->product_id }})"
                       class="text-blue-500">Edit</a>
                    &nbsp;
                    <a href="#" class="text-red-500">Delete</a>
                </th>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <a x-on:click.prevent="$store.variation_related.showCreate()"
           href="javascript:void(0)">{{ trans('plugins/attribute::attributes.add_new_variation') }}</a>
    </div>
</div>
@section('form_end')
{!! $form->getFormBuilder()
->create(\Ocart\Attribute\Forms\VersionForm::class, [
    'form' => $form,
    'group' => $group
])
->renderForm() !!}
@stop