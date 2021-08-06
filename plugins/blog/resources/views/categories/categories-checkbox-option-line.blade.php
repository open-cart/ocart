@php
/**
 * @var string $value
 */
$value = isset($value) ? (array)$value : [];
@endphp
@if($categories)
    <ul class="space-y-1 pl-4">
        @foreach($categories as $category)
            @if($category->id != $currentId)
                <li value="{{ $category->id ?? '' }}"
                        {{ $category->id == $value ? 'selected' : '' }}>
                    <label class="flex items-center space-x-3">
                        {!! Form::checkbox($name, $category->id, in_array($category->id, $value), ['class' => 'rounded-md h-4 w-4 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
{{--                        {!! Form::customLabel($name, $category->name, ['class' => 'text-gray-900 font-medium']) !!}--}}
                        <span class="text-gray-900 font-medium dark:text-gray-300">{!! $category->name !!}</span>
                    </label>
                    @include('plugins.blog::categories.categories-checkbox-option-line', [
                        'categories' => $category->child_cats,
                        'value' => $value,
                        'currentId' => $currentId,
                        'name' => $name
                    ])
                </li>
            @endif
        @endforeach
    </ul>
@endif
