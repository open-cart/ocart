<x-app-layout>
    <x-slot name="header">
        123
    </x-slot>
    <div class="pb-12">
        <div class="sm:px-6 lg:px-8">
            @if($showStart)
                {!! Form::open(Arr::except($formOptions, ['template'])) !!}
            @endif

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-9 space-y-4">
                    <div class=" bg-white p-6 rounded-md space-y-4">
                        @if($showFields)
                            @foreach ($fields as $key => $field)
                                @if ($field->getName() == $form->getBreakFieldPoint())
                                    @break
                                @else
                                    @unset($fields[$key])
                                @endif
                                @if( ! in_array($field->getName(), $exclude) )
                                    {!! $field->render() !!}
                                @endif
                            @endforeach
                        @endif
                    </div>

                    @foreach ($form->getMetaBoxes() as $key => $metaBox)
                        {!! $form->getMetaBox($key) !!}
                    @endforeach

                    {!! do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'advanced', $form->getModel()) !!}
                </div>
                <div class="col-span-3 space-y-4">
                    {!! $form->getActionButtons() !!}
                    {!! do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'top', $form->getModel()) !!}

                    @foreach ($fields as $field)
                        @if( ! in_array($field->getName(), $exclude) )
                            <div class="rounded-md bg-white">
                                <div class="border-b p-3 flex justify-between">
                                    <h4>{!! Form::customLabel($field->getName(), $field->getOption('label'), $field->getOption('label_attr')) !!}</h4>
                                </div>
                                <div class="px-3 py-6">
                                    {!! $field->render([], in_array($field->getType(), ['radio', 'checkbox'])) !!}
                                </div>
                            </div>
                        @endif
                    @endforeach

                    {!! do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'side', $form->getModel()) !!}
                </div>

            </div>

            @if($showEnd)
                {!! Form::close() !!}
            @endif
        </div>
    </div>
</x-app-layout>
<script>
    $(document).on('submit', '#from-builder', function(event) {
        $.pjax.submit(event, '#body');
    });
</script>
