<div class="rounded-md bg-white dark:text-gray-300 dark:bg-gray-800"
     x-data="{}"
>
    <div class="border-b px-6 py-3 flex justify-between dark:border-gray-700">
        <h4>
            <span> {{ trans('plugins/attribute::attributes.product_has_variations') }}</span>
        </h4>
        <div>
            <a x-on:click="toggle"
               href="javascript:void(0)">{{ trans('plugins/attribute::attributes.edit_attribute') }}</a>
            &nbsp;
            <a data-toggle="modal" data-target="#add-new-variation-modal"
               href="javascript:void(0)">{{ trans('plugins/attribute::attributes.add_new_variation') }}</a>
        </div>
    </div>
    <div>
        ...
    </div>
</div>
<x-plugins.attribute::products.add-new-variation
        :group="$group"
        target="add-new-variation-modal"/>