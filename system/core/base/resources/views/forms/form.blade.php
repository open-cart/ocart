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

                            @foreach ($fields as $field)
                                @if( ! in_array($field->getName(), $exclude) )
                                    {!! $field->render() !!}
                                @endif
                            @endforeach

                        @endif
                    </div>
                    <div class=" bg-white p-6 rounded-md">
                        123
                    </div>
                </div>
                <div class="col-span-3 space-y-4">
                    <div class="rounded-md bg-white">
                        <div class="border-b p-3 flex justify-between">
                            <h3>title</h3>
                        </div>
                        <div class="p-3">
                            <button type="submit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                                Save
                            </button>
                        </div>
                    </div>
                    <div class="p-6 rounded-md bg-white">2</div>
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
