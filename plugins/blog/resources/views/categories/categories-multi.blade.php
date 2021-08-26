<div class="form-group form-group-no-margin @if ($errors->has($name)) has-error @endif">
    <div class="multi-choices-widget list-item-checkbox h-64 overflow-scroll -ml-4">
        @if(isset($options['choices']) && (is_array($options['choices']) || $options['choices'] instanceof \Illuminate\Support\Collection))
            @include('plugins.blog::categories.categories-checkbox-option-line', [
                'categories' => $options['choices'],
                'value' => $options['value'],
                'currentId' => null,
                'name' => $name
            ])
        @endif
    </div>
</div>
