@php
    $group = $form->getFormOption('group');
@endphp
<x-modal content_classes="w-auto" target="add-new-variation-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">
{{--                {{ trans('') }}--}}
                Add new variation
            </h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="py-4 pb-6 space-y-4">
            <div class="grid grid-cols-3 gap-4">
                @foreach($group as $item)
                    <div class="flex flex-col">
                        <label for="customer_address_name">
                            {{ $item->attributeGroup->title }}
                        </label>
                        <input type="hidden" value="{{ $item->attributeGroup->id }}">
                        <x-select class="w-64">
                            @foreach($item->attributeGroup->attributes as $attribute)
                                <option value="{{ $attribute->id }}">
                                    {{ $attribute->title }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                @endforeach
            </div>
            @foreach ($form->getMetaBoxes() as $key => $metaBox)
                {!! $form->getMetaBox($key) !!}
            @endforeach
            @if($showFields)
                {!! $form->getField('images[]')->render() !!}
            @endif
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end pt-2">
           <x-button>
               Save changes
           </x-button>
        </div>
    </x-slot>
</x-modal>