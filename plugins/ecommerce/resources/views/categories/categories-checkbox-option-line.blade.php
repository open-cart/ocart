@php
/**
 * @var string $value
 */
$value = isset($value) ? (array)$value : [];
@endphp
@if($categories)
    <ul class="space-y-3">
        @foreach($categories as $category)
            @if($category->id != $currentId)
                <li value="{{ $category->id ?? '' }}"
                        {{ $category->id == $value ? 'selected' : '' }}>
                    <label class="flex items-center space-x-3">
                        {!! Form::checkbox($name, $category->id, in_array($category->id, $value), ['class' => 'rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
{{--                        {!! Form::customLabel($name, $category->name, ['class' => 'text-gray-900 font-medium']) !!}--}}
                        <span class="text-gray-900 font-medium">{!! $category->name !!}</span>
                    </label>
                    @include('plugins/ecommerce::categories.categories-checkbox-option-line', [
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
