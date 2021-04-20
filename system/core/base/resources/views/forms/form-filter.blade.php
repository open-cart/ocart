<div id="form-filter-table">
    @if($showStart)
        {!! Form::open(Arr::except($formOptions, ['template', 'modalId'])) !!}
    @endif
    <div class="grid grid-cols-12 gap-2">
        @if($showFields)
            @foreach ($fields as $key => $field)
                @if( ! in_array($field->getName(), $exclude) )
                    <div class="{!! $field->getOption('wrapper_class') !!}">
                        {!! $field->render([], false) !!}
                    </div>
                @endif
            @endforeach
        @endif
        <div class="col-span-1">
{{--            <input class="px-4 py-2 border focus:ring-blue-400 focus:border-blue-500 w-full--}}
{{--         sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600--}}
{{--         dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" name="name"--}}
{{--                   placeholder="search..."--}}
{{--                   type="text">--}}

            <input type="hidden" name="submit" value="search"/>
            <button class="inline-flex items-center px-4 py-1.5 bg-indigo-500 hover:bg-indigo-600 border border-transparent rounded-md text-white tracking-widest
focus:border-transparent focus:outline-none
  disabled:opacity-25 transition ease-in-out duration-150
   w-48 dark:text-gray-300" id="searchButton">
                <i class="zmdi zmdi-search">&nbsp;{{__('general.search')}}</i>
            </button>
        </div>
    </div>
    @if($showEnd)
        {!! Form::close() !!}
    @endif
</div>

<script>
    $(function() {
        const filterForm = $('#form-filter-table');

        const searchFn = function(event) {
            event.preventDefault();
            console.log('click 1');

            $.pjax.submit(event, '#body');
        }

        filterForm.on('submit', 'form', searchFn)
    })

</script>