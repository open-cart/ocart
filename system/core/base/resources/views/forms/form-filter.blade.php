<div id="form-filter-table">
    @if($showStart)
        {!! Form::open(Arr::except($formOptions, ['template', 'modalId'])) !!}
    @endif
    <div x-data="{tab: 1}" class="mb-3 -mt-4">
        <nav>
            <ul class="flex">
                <li class="py-2 px-4 cursor-pointer border-b-2 border-indigo-600">
                    <a class="dark:text-white" href="{{ URL::current() }}"><span>All</span></a>
                </li>
            </ul>
        </nav>
    </div>
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
   w-32 dark:text-gray-300" id="searchButton">
                <i class="zmdi zmdi-search">&nbsp;{{__('general.search')}}</i>
            </button>
        </div>
    </div>
        <div class="mb-2">
            @foreach ($fields as $key => $field)
                @if( ! in_array($field->getName(), $exclude) && $field->getValue() && $field->getType() != 'text')
                    <div class="bg-blue-100 inline-flex items-center text-sm rounded mt-2 mr-1 overflow-hidden">
                        <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs px-1">
                            {{ $form->processVariable($field) }}
                        </span>
                        <a type="button"
                                title="Xóa"
                                href="{{ url(URL::current()) .'?' . Arr::query(Arr::except(request()->all(), $field->getNameKey())) }}"
                                class="flex items-center w-6 h-8 inline-block align-middle text-gray-500 bg-blue-200 focus:outline-none">
                            <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                      d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            @endforeach
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