<div class="image-box">
    <input type="hidden" name="{{ $name }}" value="{{ $value }}" class="image-data">
    <div class="preview-image-wrapper @if (!Arr::get($attributes, 'allow_thumb', true)) preview-image-wrapper-not-allow-thumb @endif">
{{--        <img src="{{ get_object_image($value, Arr::get($attributes, 'allow_thumb', true) == true ? 'thumb' : null) }}" alt="{{ __('preview image') }}" class="preview_image" @if (Arr::get($attributes, 'allow_thumb', true)) width="150" @endif>--}}
        <img src="{{ TnMedia::url($value) ?? '/images/no-image.jpg' }}" alt="{{ __('preview image') }}" class="preview_image" @if (Arr::get($attributes, 'allow_thumb', true)) width="150" @endif>
        <a class="btn_remove_image" title="{{ trans('core/base::forms.remove_image') }}">
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
    $(function() {
        $("[data-action]").click(function(e) {
            e.preventDefault();
            TnMedia.default({
                id: 'tnmedia-root',
                popup: true,
                uploadAPI: '{!! route('media.files.upload') !!}',
                listAPI: '{!! route('media.list') !!}',
                insert: (items) => {
                    const name = $(this).data('result');
                    $(`input[name=${name}]`).val(items[0].full_url);
                    $('.preview_image').attr('src', items[0].full_url);
                }
            })
        })
    })
</script>
