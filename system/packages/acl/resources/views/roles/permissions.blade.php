<!-- Permission Flag -->
<ul id="permission-flag-view">
    <li class="mt-3">
        <div>
            <label class="flex items-center space-x-3">
                {!! Form::checkbox('permissions[]', 'root', Arr::get($active, 'root'), [
    'class' => 'rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 cursor-pointer
     focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
                <span class="text-gray-900 font-medium capitalize dark:text-gray-300">Root</span>
            </label>
        </div>
        @foreach($prTree['root'] as $key => $permission)

            <ul>
                <li class="pl-6" x-data="{open: false}">
                    <div class="mt-3 flex items-center">
                    <span class="text-center w-6 hover:bg-gray-400 hover:bg-opacity-20 rounded-full cursor-pointer" x-on:click="open = !open">
                        <i class="fa fa-caret-right" :class="{'transform rotate-90': open}"></i>
                    </span>
                        <label >
                            <div class="flex items-center space-x-3">
                                {!! Form::checkbox('permissions[]', $permission, Arr::get($active, $permission), [
    'class' => 'rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 cursor-pointer
     focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
                                <span class="text-gray-900 font-medium capitalize dark:text-gray-300">{!! $permissions[$permission]['name'] !!}</span>
                            </div>
                        </label>
                    </div>
                    <ul x-show="open" style="display: none" class="pl-8 mt-3">
                        @include('packages.acl::roles.flag', [
                            'prTree' => $prTree,
                            'parent' => $permission,
                            'permissions' => $permissions,
                            'active' => $active
                        ])
                    </ul>
                </li>
            </ul>
        @endforeach
    </li>
</ul>
<script>
    function checkParentPermission(li, e) {
        const div = li.closest('ul').closest('li').find('div').first();
        if (div.length) {
            div.find('input').not(this).prop("checked", e.target.checked);
            checkParentPermission(li.closest('ul').closest('li'), e);
        }
    }
    $("#permission-flag-view").find('input[type="checkbox"]').change(function(e) {
        const _self = $(this);
        _self.closest('li').find('input').not(this).prop("checked", e.target.checked);
        const li = _self.closest('li');
        console.log('e.target.checked', e.target.checked)
        if (li.length && e.target.checked === true) {
            checkParentPermission(li, e);
        }
    })
</script>