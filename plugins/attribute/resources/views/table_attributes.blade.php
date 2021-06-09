<div x-data="dataAttributes()" x-init="() => { selected = data.findIndex(x =>x.is_default) }">
    <table class="w-full">
        <thead>
        <tr>
            <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">#</th>
            <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">Is default</th>
            <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">Title</th>
            <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">Slug</th>
            <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">Image</th>
            <th class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">Remove</th>
        </tr>
        </thead>
        <tbody>
        <template x-for="(item, index) in data" :key="index">
            <tr>
                <td class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700" x-text="index + 1"></td>
                <td class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    <input type="radio"
                           class="cursor-pointer"
                           x-bind:value="index"
                           x-model="selected"
                           x-on:click.prevent="changeDefault(index)"
                    >
                </td>
                <td class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    <x-input x-model="item.title"/>
                </td>
                <td class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    <x-input x-model="item.slug"/>
                </td>
                <td class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    ...
{{--                    @include('plugins/ecommerce::components.form.image', [--}}
{{--                        'name' => '',--}}
{{--                        'value' => $attribute['image'],--}}
{{--                        'thumb' => $attribute['image'] ? RvMedia::getImageUrl($attribute['image'], 'thumb') : RvMedia::getDefaultImage(false),--}}
{{--                    ])--}}
                </td>
                <td class="border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700">
                    <a href="javascript:void(0)" class="text-red-600" x-on:click="remove(item)">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        </template>
        </tbody>
    </table>

    <br>
    <input type="hidden" name="attributes" :value="JSON.stringify(data)">
    <input type="hidden" name="deleted_attributes" :value="JSON.stringify(deleted)">
    <x-button type="button" x-on:click="add">
        Add new attribute
    </x-button>
</div>
<script>

    function dataAttributes() {
        return {
            data: @json($group->attributes),
            deleted: [],
            selected: null,
            add() {
                this.data.push({id: null,});
            },
            remove(item) {
                if (item.id) {
                    this.deleted.push(item);
                }
                this.data = this.data.filter(x => x !== item);
            },
            changeDefault(index) {
                const item = this.data[index];
                this.selected = index;
                for (const x of this.data) {
                    x.is_default = 0;
                }

                item.is_default = 1;

                console.log('this.data', JSON.stringify(this.data))
            }
        };
    }
</script>