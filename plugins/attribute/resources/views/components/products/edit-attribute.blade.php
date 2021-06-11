@props(['groups' => [], 'allGroups' => [], 'product' => null])
<x-modal content_classes="w-auto" target="form-edit-attribute-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">
                {{ trans('plugins/attribute::attributes.select_attribute') }}
            </h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="py-4 pb-6 space-y-4">
            <ul class="flex flex-wrap max-w-lg -m-2">
                @foreach($allGroups as $group)
                <li class="m-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox"
                               {{ in_array($group->id, $groups) ? 'checked' : ''}}
                               value="{{ $group->id }}"
                               name="attribute_group_id[]"
                               class="rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2">{{ $group->title }}</span>
                    </label>
                </li>
                @endforeach
            </ul>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end pt-2">
            <x-button color="bg-red-500 hover:bg-red-400"
                      x-on:click="close()"
                      class="flex justify-center mr-2">
                {{ trans('admin.cancel') }}
            </x-button>

            <x-button x-on:click="$store.select_group_attribute.updateAttributes().then(() => close())"
                      class="flex justify-center mr-2">
                {{ trans('admin.save_changes') }}
            </x-button>
        </div>
    </x-slot>
</x-modal>
<script>
    Spruce.store('select_group_attribute', {
        product_id: {{ $product->id }},
        updateAttributes: function () {
            const attribute_group_id = [];
            $('input[name="attribute_group_id[]"]:checked').each(function () {
                attribute_group_id.push($(this).val());
            })
            return axios.post('{{ route('ecommerce.attribute_groups.update_atribute') }}', {
                product_id: this.product_id,
                attribute_group_id
            }).then(res => {
                toast.success(res.message)
                return $.pjax.reload('#body');
            }).catch(e => {
                showError(e);
                throw e;
            }).finally(() => {
                bodyLoading.hide();
                this.loading = false;
            });
        }
    });
</script>