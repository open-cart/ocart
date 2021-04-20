{{--@foreach($permissions as $permission)--}}
{{--    <div>--}}
{{--        <label class="flex items-center space-x-3">--}}
{{--            {!! Form::checkbox('permissions[]', $permission->id, in_array($permission->id, $active), ['class' => 'rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}--}}
{{--            --}}{{--                        {!! Form::customLabel($name, $category->name, ['class' => 'text-gray-900 font-medium']) !!}--}}
{{--            <span class="text-gray-900 font-medium">{!! $permission->name !!}</span>--}}
{{--        </label>--}}
{{--    </div>--}}
{{--@endforeach--}}

@foreach($prTree as $key => $permission)
    @if(!is_array($permission))
    <div>
        <label class="flex items-center space-x-3">
            {!! Form::checkbox('permissions[]', $permission->id, in_array($permission->id, $active), [
    'class' => 'rounded-md h-5 w-5 border-gray-300 text-indigo-600
    shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
            {{--                        {!! Form::customLabel($name, $category->name, ['class' => 'text-gray-900 font-medium']) !!}--}}
            <span class="text-gray-900 font-medium capitalize dark:text-gray-300">{!! $permission->description ?? $key !!}</span>
        </label>
    </div>
    @else
        <div class="mt-3">
            <label class="flex items-center space-x-3">
{{--                {!! Form::checkbox('permissions[]', $permission->id, in_array($permission->id, $active), ['class' => 'rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}--}}
                {{--                        {!! Form::customLabel($name, $category->name, ['class' => 'text-gray-900 font-medium']) !!}--}}
                <span class="text-gray-900 font-medium capitalize dark:text-gray-300">{!! $key !!}</span>
            </label>
        </div>
        <div class="pl-6">
            @include('packages.acl::roles.permissions', [
                        'prTree' => $permission,
                        'active' => $active
                    ])
        </div>
{{--        @foreach($permission as $permission2)--}}
{{--            <div class="pl-6">--}}
{{--                <label class="flex items-center space-x-3">--}}
{{--                    {!! Form::checkbox('permissions[]', $permission2->id, in_array($permission2->id, $active), ['class' => 'rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}--}}
{{--                                            {!! Form::customLabel($name, $category->name, ['class' => 'text-gray-900 font-medium']) !!}--}}
{{--                    <span class="text-gray-900 font-medium">{!! $permission2->name !!}</span>--}}
{{--                </label>--}}
{{--            </div>--}}
{{--        @endforeach--}}
    @endif
@endforeach