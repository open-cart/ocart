<div class="rounded-md bg-white dark:text-gray-300 dark:bg-gray-800"
     x-data="dataAddNewAttribute()"
>
    <div class="border-b px-6 py-3 flex justify-between dark:border-gray-700">
        <h4>
            <span> {{ trans('plugins/attribute::attributes.variations') }}</span>
        </h4>
        <a x-on:click="toggle"
           data-toggle-text="{{ trans('plugins/attribute::attributes.cancel') }}"
           href="javascript:void(0)">{{ trans('plugins/attribute::attributes.add_new_attributes') }}</a>
    </div>
    <div class="px-6 py-6">
        <div x-show="!addAttribute">
            {{ trans('plugins/attribute::attributes.variation_description') }}
        </div>
        <div x-show="addAttribute" style="display: none" class="space-y-4">
            <template x-for="(item, index) in data" :key="index">
                <div class="grid grid-flow-col grid-cols-3 grid-cols-3 gap-4 items-end">
                    <div>
                        <label for="">
                            {{ trans('plugins/attribute::attributes.attribute_name') }}
                        </label>
                        <x-select class="w-full" x-model="item.group_id" x-on:change="changeGroup(item)">
                            <template x-for="(group, id) in groups" :key="id">
                                <option x-bind:value="group.id"
                                        x-bind:selected="item.group_id == group.id"
                                        x-bind:disabled="data.some(x => (x.group_id != item.group_id && x.group_id == group.id))"
                                        x-text="group.title"></option>
                            </template>
                        </x-select>
                    </div>
                    <div>
                        <label for="">
                            {{ trans('plugins/attribute::attributes.value') }}
                        </label>
                        <x-select class="w-full" x-model="item.attribute_id">
                            <template x-for="(attribute, id) in item.group.attributes" :key="id">
                                <option x-bind:value="attribute.id" x-text="attribute.title"></option>
                            </template>
                        </x-select>
                    </div>
                    <div x-show="data.length > 1" class="p-2">
                        <a href="javascript:void(0)"
                           x-on:click="deleteItem(item)"
                           class="text-red-600">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            </template>
            <br>
            <x-button type="button"
                      x-show="groups.length > data.length"
                      x-on:click="addMore">
                {{ trans('plugins/attribute::attributes.add_more_attribute') }}
            </x-button>
        </div>
    </div>
    <input type="hidden" name="variations" x-bind:value="variations()">
    <input type="hidden" name="is_added_attributes" x-bind:value="addAttribute ? 1 : 0">
</div>
<script>
    function dataAddNewAttribute() {
        return {
            addAttribute: false,
            groups: @json($group),
            data: [],
            variations() {
                const data = this.data.map(x => {
                    return {
                        id: x.id,
                        group_id: x.group_id,
                        attribute_id: x.attribute_id
                    }
                });

                return JSON.stringify(data);
            },
            toggle(e) {
                this.addAttribute = !this.addAttribute;
                const txt = e.target.getAttribute("data-toggle-text");
                e.target.setAttribute("data-toggle-text", e.target.text);
                e.target.text = txt;
                if (!this.data.length) {
                    this.addMore();
                }
            },
            addMore() {
                const group = this.groups.find(x => !this.data.some(y => y.group_id == x.id));
                const attr = group.attributes.find(x => true);
                this.data = [...this.data, {
                    group_id: group.id,
                    attribute_id: attr?.id,
                    group: group
                }];
            },
            deleteItem(item) {
                this.data = this.data.filter(x => x !== item)
            },
            changeGroup(item) {
                item.group = this.groups.find(x => x.id == item.group_id);
            }
        };
    }
</script>