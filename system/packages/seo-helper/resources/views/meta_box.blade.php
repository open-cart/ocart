<div x-data="{open: false}">
    <div x-on:click="open = !open">
        Search Engine Optimize
        <div>
            {!! print_r($object->language) !!}
            {{ $meta['seo_title'] ?? (!empty($object->id) ? $object->name ?? $object->language->title : null) }}
        </div>
        <div>
            {{ strip_tags($meta['seo_description'] ?? (!empty($object->id) ? $object->language->description : (!empty($object->id) && $object->language->content ? Str::limit($object->language->content, 250) : old('seo_meta.seo_description')))) }}
        </div>
    </div>
    <div x-show:="open" style="display:none;">content</div>
</div>
