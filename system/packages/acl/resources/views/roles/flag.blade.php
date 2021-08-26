@foreach($prTree[$parent] as $key => $permission)
    @if(!is_array(Arr::get($prTree, $permission)))
        <li class="flex">
            <span class="text-center w-6">&nbsp;</span>
            <label>
                <div class="flex items-center space-x-3">
                    {!! Form::checkbox('permissions[]', $permission, Arr::get($active, $permission), [
        'class' => 'rounded-md h-5 w-5 border-gray-300 text-indigo-600 cursor-pointer
        shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
                    <span class="text-gray-900 font-medium capitalize dark:text-gray-300">{!! $permissions[$permission]['name'] ?? $key !!}</span>
                </div>
            </label>
        </li>
    @else
        <li x-data="{open: false}">
            <div class="mt-3 flex items-center">
                <span class="text-center w-6 hover:bg-gray-400 hover:bg-opacity-20 rounded-full cursor-pointer" x-on:click="open = !open">
                    <i class="fa fa-caret-right" :class="{'transform rotate-90': open}"></i>
                </span>
                <label >
                    <div class="flex items-center space-x-3">
                        {!! Form::checkbox('permissions[]', $permission, Arr::get($active, $permission), ['id' => $permission, 'class' => 'rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
                        <span class="text-gray-900 font-medium capitalize dark:text-gray-300">{!! $permissions[$permission]['name'] !!}</span>
                    </div>
                </label>
            </div>
            <ul x-show="open" style="display: none" class="pl-6 mt-3">
                @include('packages.acl::roles.flag', [
                            'prTree' => $prTree,
                            'parent' => $permission,
                            'permissions' => $permissions,
                            'active' => $active
                        ])
            </ul>
        </li>
    @endif
@endforeach