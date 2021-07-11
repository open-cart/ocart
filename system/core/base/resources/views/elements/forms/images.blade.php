<div class="image-box border-dashed border p-3 dark:border-gray-700 dark:text-gray-300">
    @php
        $values = $value == '[null]' ? '[]' : $value;
        $attributes = isset($attributes) ? $attributes : [];
    @endphp
    @php $images = old($name, !is_array($values) ? json_decode($values) : $values); @endphp

{{--    <input type="hidden" name="{{ $name }}" value="{{ $value }}" class="image-data">--}}
    <div class="preview-image-wrapper @if (!Arr::get($attributes, 'allow_thumb', true)) preview-image-wrapper-not-allow-thumb @endif">
{{--        <img src="{{ get_object_image($value, Arr::get($attributes, 'allow_thumb', true) == true ? 'thumb' : null) }}" alt="{{ __('preview image') }}" class="preview_image" @if (Arr::get($attributes, 'allow_thumb', true)) width="150" @endif>--}}
        <div class="default-placeholder-gallery-image cursor-pointer text-center {!! !empty($images) ? 'hidden' : '' !!}">
            <div class="flex justify-center">
                <img src="{!! asset('images/placeholder.png') !!}" alt="placeholder" width="120">
            </div>
            <p class="pb-4 text-gray-400">
                Using button <strong>{{ trans('core/base::forms.add_image') }}</strong> to add add more images
            </p>
        </div>
        <ul class="list-gallery-media-images ui-sortable grid grid-cols-5 gap-4">
            @foreach($images as $item)
            <li>
                <div class="gallery-image-item-handler relative w-full h-full">
                    <div class="list-photo-hover-overlay absolute w-full h-full z-10">
                        <ul class="absolute w-full h-full top-0 left-0 flex items-end flex justify-center bg-gray-900 bg-opacity-30">
                            <li onclick="deleteImage(this)"
                                class="delete-image hover:opacity-80 cursor-pointer"
                                title="Delete image">
                                <i class="fa fa-trash text-white text-xl"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="aspect-w-4 aspect-h-4">
                        <input type="hidden" name="{{ $name }}" value="{{ $item }}" class="image-data">
                        <img src="{{ TnMedia::url($item) ?? '/images/no-image.jpg' }}" alt="{{ __('preview image') }}" class="preview_image" @if (Arr::get($attributes, 'allow_thumb', true)) @endif>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="image-box-actions">
        <a href="#" class="btn_gallery" data-result="{{ $name }}" data-action="{{ $attributes['action'] ?? 'select-image' }}">
            {{ trans('core/base::forms.add_image') }}
        </a>
    </div>
    <li class="hidden template-image">
        <div class="gallery-image-item-handler relative w-full h-full">
            <div class="list-photo-hover-overlay absolute w-full h-full z-10">
                <ul class="absolute w-full h-full top-0 left-0 flex items-end flex justify-center bg-gray-900 bg-opacity-30">
                    <li onclick="deleteImage(this)"
                        class="delete-image hover:opacity-80 cursor-pointer"
                        title="Delete image">
                        <i class="fa fa-trash text-white text-xl"></i>
                    </li>
                </ul>
            </div>
            <div class="aspect-w-4 aspect-h-4">
                <input type="hidden" name="{{ $name }}" value="" class="image-data">
                <img src="{{ '/images/no-image.jpg' }}" alt="{{ __('preview image') }}" class="preview_image" @if (Arr::get($attributes, 'allow_thumb', true)) @endif>
            </div>
        </div>
    </li>
</div>
<script>
    function deleteImage(e) {
        $(e).closest('ul').closest('li').remove();
        const list = $('.list-gallery-media-images');
        if (!list.find('li').length) {
            $('.default-placeholder-gallery-image').removeClass('hidden');
        }
    }
    $(function() {
        $( ".ui-sortable" ).sortable();

        $("[data-action], .default-placeholder-gallery-image").click(function(e) {
            e.preventDefault();
            TnMedia.default({
                id: 'tnmedia-root',
                popup: true,
                uploadAPI: '{!! route('media.files.upload') !!}',
                listAPI: '{!! route('media.list') !!}',
                createFolderAPI: '{!! route('media.folders.create') !!}',
                deleteAPI: '{{ route('media.delete') }}',
                renameAPI: '{{ route('media.rename') }}',
                insert: (items) => {
                    if (!items.length) return;

                    const list = $('.list-gallery-media-images');
                    const parent = $(this).closest('.image-box');

                    parent.find('.default-placeholder-gallery-image').addClass('hidden');
                    // if (parent.find('default-placeholder-gallery-image')) {
                    //     $(this).addClass('hidden');
                    // }

                    for (const image of items) {
                        const item = $('.template-image').clone().attr('class', '');
                        item.find('input').val(image.full_url);
                        item.find('.preview_image').attr('src', image.full_url);
                        list.append(item);
                    }
                }
            })
        })
    })
</script>
