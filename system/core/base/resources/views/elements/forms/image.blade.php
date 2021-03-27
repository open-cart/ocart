<div class="image-box">
    <input type="hidden" name="{{ $name }}" value="{{ $value }}" class="image-data">
    <div data-image=""
         class="preview-image-wrapper
         relative h-32 w-32
@if (!Arr::get($attributes, 'allow_thumb', true)) preview-image-wrapper-not-allow-thumb @endif">
{{--        <img src="{{ get_object_image($value, Arr::get($attributes, 'allow_thumb', true) == true ? 'thumb' : null) }}" alt="{{ __('preview image') }}" class="preview_image" @if (Arr::get($attributes, 'allow_thumb', true)) width="150" @endif>--}}
        <img src="{{ TnMedia::url($value) ?? '/images/placeholder.png' }}" alt="{{ __('preview image') }}" class="preview_image" @if (Arr::get($attributes, 'allow_thumb', true)) width="150" @endif>
        <a onclick="removeImageHandler(this)" class="btn_remove_image absolute flex items-center justify-center right-0 top-0 rounded-full w-7 h-7 bg-gray-300 hover:bg-gray-200"
           title="{{ trans('core/base::forms.remove_image') }}">
            <i class="fa fa-times"></i>
        </a>
    </div>
    <div class="image-box-actions">
        <a href="#" class="btn_gallery" data-result="{{ $name }}" data-action="{{ $attributes['action'] ?? 'select-image' }}">
            {{ trans('core/base::forms.choose_image') }}
        </a>
    </div>
</div>
<script>
    function removeImageHandler(e) {
        const parent = $(e).closest('.image-box');
        parent.find('.preview-image-wrapper').remove();
        parent.find('input').val('');
    }
    $(function() {
        const img = $('.preview-image-wrapper').clone();
        $("[data-action]").click(function(e) {
            e.preventDefault();
            TnMedia.default({
                id: 'tnmedia-root',
                popup: true,
                uploadAPI: '{!! route('media.files.upload') !!}',
                listAPI: '{!! route('media.list') !!}',
                insert: (items) => {
                    const parent = $(this).closest('.image-box');

                    const name = $(this).data('result');
                    parent.find(`input[name=${name}]`).val(items[0].url);
                    if (!parent.find('.preview-image-wrapper img').length) {
                        const newImg = img.clone();
                        newImg.find('img').attr('src', items[0].full_url);
                        parent.prepend(newImg);
                    } else {
                        parent.find('.preview_image').attr('src', items[0].full_url);
                    }
                }
            })
        })
    })
</script>
