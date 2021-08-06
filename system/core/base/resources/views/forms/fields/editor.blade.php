@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif

            @if ($showLabel && $options['label'] !== false && $options['label_show'])
                {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
            @endif

            @if ($showField)
                {!! call_user_func_array([Form::class, setting('rich_editor', 'tinymce')], [$name, $options['value'], $options['attr']]) !!}
                <?php include helpBlockPath(); ?>
            @endif

            <?php include errorBlockPath(); ?>

            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif