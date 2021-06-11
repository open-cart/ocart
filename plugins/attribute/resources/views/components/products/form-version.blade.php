@php
    $groups = $form->getFormOption('group');
    $parent = $form->getFormOption('form');
    $product = $parent->getModel();
@endphp
<div>
    <x-modal content_classes="w-auto" target="form-version-modal">
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
                <x-button color="bg-red-500 hover:bg-red-400"
                          x-on:click="close()"
                          class="flex justify-center mr-2">
                    {{ trans('admin.cancel') }}
                </x-button>

                <template x-if="$store.variation_related.loading">
                    <x-button type="button" class="w-40 flex justify-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </x-button>
                </template>
                <template x-if="!$store.variation_related.loading">
                    <x-button class="w-40 flex justify-center"
                              x-on:click="$store.variation_related.save().then(() => close())">
                        {{ trans('admin.save_changes') }}
                    </x-button>
                </template>
            </div>
        </x-slot>
    </x-modal>
</div>
<script>
    function showError(e) {
        if (e?.errors) {
            toast.error(Object.values(e.errors).find(Boolean));
        } else {
            toast.error(e.message);
        }
        throw e;
    }
    Spruce.store('variation_related', {
        productId: {!! $product->id !!},
        oldProduct: @json($product),
        oldGroups: @json($groups),
        groups: [],
        loading: false,
        loadingShow: false,
        updateId: null,
        isUpdate: false,
        showCreate() {
            this.isUpdate = false;
            this.groups = JSON.parse(JSON.stringify(this.oldGroups));
            const {oldProduct} =this;

            $("#sku").val('');
            $("#price").val(oldProduct.price);
            $("#sale_price").val(oldProduct.sale_price);

            $('.default-placeholder-gallery-image').removeClass('hidden');

            const list = $('.list-gallery-media-images').html('');

            $('#form-version-modal').click();
        },
        showUpdate(id) {
            this.updateId = id;
            this.isUpdate = true;
            this.loadingShow = true;
            bodyLoading.show();
            $('.default-placeholder-gallery-image').removeClass('hidden');

            const list = $('.list-gallery-media-images').html('');
            this.groups = JSON.parse(JSON.stringify(this.oldGroups));
            axios.get('{{ route('ecommerce.attribute_groups.get_version') }}/' + id).then(res => {
                const {attributes, product, images} = res.data;
                for (const group of this.groups) {
                    const item = attributes.find(x => x.attribute.attribute_group_id == group.attribute_group.id);
                    if (item) {
                        group.attribute_group.attribute_group_id = group.attribute_group.id;
                        group.attribute_group.attribute_id = item.attribute_id;
                        group.attribute_group.item_id = item.id;
                    }
                }

                if (images.length > 0) {
                    const list = $('.list-gallery-media-images');

                    if (!$('.image-box').find('default-placeholder-gallery-image.hidden').length) {
                        $('.default-placeholder-gallery-image').addClass('hidden');
                    }

                    for (const image of images) {
                        const item = $('.template-image').clone().attr('class', '');
                        item.find('input').val(image);
                        item.find('.preview_image').attr('src', image);
                        list.append(item);
                    }
                }

                $("#sku").val(product.sku);
                $("#price").val(product.price);
                $("#sale_price").val(product.sale_price);

                $('#form-version-modal').click();
            }).finally(() => {
                this.loadingShow = false;
                bodyLoading.hide();
            })
        },
        save() {
            if (this.isUpdate) {
                return this.saveUpdate()
            } else {
                return this.saveCreate();
            }
        },
        saveCreate() {
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
            if (this.loading) {
                return;
            }

            this.loading = true;

            bodyLoading.show();
            return axios.post('{{ route('ecommerce.attribute_groups.add_version') }}', data).then(res => {
                toast.success(res.message)
                return $.pjax.reload('#table-configuration');
            }).catch(e => {
                showError(e);
                throw e;
            }).finally(() => {
                this.loading = false;
                bodyLoading.hide();
            });
        },
        saveUpdate() {
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
                    attribute_id: x.attribute_group.attribute_id,
                    item_id: x.attribute_group.item_id
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
            if (this.loading) {
                return;
            }

            this.loading = true;

            bodyLoading.show();
            return axios.post('{{ route('ecommerce.attribute_groups.update_version') }}/' + this.updateId, data).then(res => {
                toast.success(res.message)
                return $.pjax.reload('#table-configuration');
            }).catch(e => {
                showError(e);
                throw e;
            }).finally(() => {
                bodyLoading.hide();
                this.loading = false;
            });
        }
    })
    function dataAddVariationModel() {
        return {};
    }
</script>