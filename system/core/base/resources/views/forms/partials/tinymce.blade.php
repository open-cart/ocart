@php
    Assets::addStylesDirectly([
        'vendor/packages/media/css/app.css',
    ])
        ->addScriptsDirectly([
            'vendor/packages/media/js/app.js',
            'access/tinymce/tinymce.min.js',
            'vendor/core/base/js/editor.js'
        ]);

        if (Arr::get($attributes, 'inline')){
            $attributes['class'] = Arr::get($attributes, 'class', '') . ' editor-tinymce-inline';
        } else {
            $attributes['class'] = Arr::get($attributes, 'class', '') . ' editor-tinymce';
        }
        $attributes['id'] = Arr::get($attributes, 'id', $name);
        $attributes['rows'] = Arr::get($attributes, 'rows', 4);
@endphp

{!! Form::textarea($name, $value, $attributes) !!}