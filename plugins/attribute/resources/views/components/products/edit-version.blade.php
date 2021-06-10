@php
    $groups = $form->getFormOption('group');
    $parent = $form->getFormOption('form');
    $product = $parent->getModel();
@endphp
<x-modal content_classes="w-auto" target="add-new-variation-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">
                {{ trans('plugins/attribute::attributes.add_new_variation') }}
            </h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="py-4 pb-6 space-y-4">
            <div class="grid grid-cols-3 gap-4">
                <template x-for="(group, id) in $store.variation_related.groups" :key="id">
                    <div class="flex flex-col">
                        <label for="customer_address_name" x-text="group.attribute_group.title"></label>
                        <input type="hidden" x-model="group.attribute_group.attribute_group_id">
                        <x-select class="w-64" x-model="group.attribute_group.attribute_id">
                            <template x-for="(attribute, id) in group.attribute_group.attributes" :key="id">
                                <option x-bind:value="attribute.id"
                                        x-text="attribute.title"></option>
                            </template>
                        </x-select>
                    </div>
                </template>
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
            <x-button x-on:click="$store.variation_related.save()">
                Save changes
            </x-button>
        </div>
    </x-slot>
</x-modal>
<script>
    Spruce.store('variation_related', {
        productId: {!! $product->id !!},
        groups: @json($groups),
        loading: false,
        save() {
            const attributes = this.groups.map(x => {
                if (!x.attribute_group.attribute_group_id) {
                    x.attribute_group.attribute_group_id = x.attribute_group.id;
                }
                const attribute = x.attribute_group.attributes.find(x => true);

                if (!x.attribute_group.attribute_id && attribute) {
                    x.attribute_group.attribute_id = attribute.id;
                }

                return {
                    attribute_group_id: x.attribute_group.attribute_group_id,
                    attribute_id: x.attribute_group.attribute_id
                };
            });
            const sku = $("#sku").val();
            const price = $("#price").val();
            const sale_price = $("#sale_price").val();
            const images = [];
            $('.list-gallery-media-images [name="images[]"]').each(function () {
                images.push($(this).val());
            })

            const data = {
                attributes,
                sku,
                price,
                sale_price,
                images,
                product_id: this.productId
            };
            this.loading = true;
            if (this.loading) {
                return;
            }
            bodyLoading.show();
            axios.post('{{ route('ecommerce.attribute_groups.add_version') }}', data).then(res => {
                if (!res.error) {
                    toast.success(res.message)
                    $.pjax.reload('#body');
                } else {
                    toast.error(res.message)
                }
            }).catch(e => {
                toast.error(e.message);
            }).finally(() => {
                this.loading = false;
                bodyLoading.hide();
            });
        }
    })
</script>