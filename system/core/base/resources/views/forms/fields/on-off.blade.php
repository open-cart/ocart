@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif

            @if ($showField)
                <x-switch
                    checked="{!! $options['value'] === '1' ? 'true':'false' !!}"
                    name="{!! $name !!}"
                    color="bg-green-600"
                />
                @if ($showLabel && $options['label'] !== false && $options['label_show'])
                    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
                @endif
                <?php include helpBlockPath(); ?>
            @endif

            <?php include errorBlockPath(); ?>

            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif
