@if (Arr::get($meta_box, 'before_wrapper'))
    {!! Arr::get($meta_box, 'before_wrapper') !!}
@endif

@if (Arr::get($meta_box, 'wrap', true))
    <div class="rounded-md border border-white bg-white dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700" {{ Html::attributes(Arr::get($meta_box, 'attributes', [])) }}>
        <div class="border-b px-6 py-3 flex justify-between dark:border-gray-700">
            <h4>
                <span> {{ Arr::get($meta_box, 'title') }}</span>
            </h4>
        </div>
        <div class="px-6 py-6">
            {!! Arr::get($meta_box, 'content') !!}
        </div>
    </div>
@else
    {!! Arr::get($meta_box, 'content') !!}
@endif

@if (Arr::get($meta_box, 'after_wrapper'))
    {!! Arr::get($meta_box, 'after_wrapper') !!}
@endif
