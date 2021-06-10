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
                    <a href="#" class="text-blue-500">Edit</a>
                    &nbsp;
                    <a href="#" class="text-red-500">Delete</a>
                </th>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <a data-toggle="modal" data-target="#add-new-variation-modal"
           href="javascript:void(0)">{{ trans('plugins/attribute::attributes.add_new_variation') }}</a>
    </div>
</div>
@section('form_end')
{!! $form->getFormBuilder()
->create(\Ocart\Attribute\Forms\AddVersionForm::class, [
    'form' => $form,
    'group' => $group
])
->renderForm() !!}
@stop