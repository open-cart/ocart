<x-app-layout>
    <x-slot name="header">
        <ol class="list-reset flex text-grey-dark">
            <li>
                <a href="{{ route('admin:home') }}" class="text-blue font-bold flex items-center">
                    <i data-feather="home" width="16"></i>&nbsp;Home
                </a>
            </li>
            <li><span class="mx-2">/</span></li>
            <li><a href="#" class="text-blue font-bold">Bài viết</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ route('pages.index') }}" class="text-blue font-bold">Page</a></li>
            <li><span class="mx-2">/</span></li>
            <li>Thêm mới</li>
        </ol>
    </x-slot>

    <div class="pb-12 pt-3">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ $url_action }}"
                          method="POST"
                          accept-charset="UTF-8"
                          class="form-horizontal"
                          id="from-page"
                          enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field()}}
                        <div class="border-b -mx-6 px-6">
                            <h3 class="text-xl">Tạo mới</h3>
                        </div>
                        <div>
                            <!-- content -->
                            @foreach($languages as $lang => $language)
                            <div
                                x-data="{isOpen: true}"
                                class="border my-3 px-3">
                                <div class="border-b p-3 -mx-3 flex justify-between">
                                    <h3>
                                        {!! $language->name !!}
                                    </h3>
                                    <div
                                        x-on:click="isOpen = !isOpen"
                                        class="flex-end cursor-pointer">
                                        <i x-show="isOpen" data-feather="minus"></i>
                                        <i x-show="!isOpen" data-feather="plus"></i>
                                    </div>
                                </div>
                                <div
                                    x-show="isOpen"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-90"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-90"
                                    class="pb-6">
                                    <x-blog::control
                                        required
                                        :errors="$errors"
                                        name="description.{!! $lang !!}.title"
                                        info="{!! trans('admin.max_c',['max'=>200]) !!}"
                                        title="{!! __('Plugins/Blog::lang.title') !!}">
                                        <x-blog::input
                                            name="description[{!! $lang !!}][title]"
                                            value="{!! old('description.'.$lang.'.title', \Arr::get($page, 'description.'.$lang.'.title')) !!}"

                                            icon="edit-3"
                                            class="w-full"/>
                                    </x-blog::control>
                                    <x-blog::control
                                        :errors="$errors"
                                        name="description.{!! $lang !!}.keyword"
                                        info="{!! trans('admin.max_c',['max'=>200]) !!}"
                                        title="{!! __('Plugins/Blog::lang.keyword') !!}">
                                        <x-blog::input
                                            name="description[{!! $lang !!}][keyword]"
                                            value="{!! old('description.'.$lang.'.keyword', \Arr::get($page, 'description.'.$lang.'.keyword')) !!}"
                                            icon="edit-3"
                                            class="w-full"/>
                                    </x-blog::control>
                                    <x-blog::control
                                        :errors="$errors"
                                        name="description.{!! $lang !!}.description"
                                        info="{!! trans('admin.max_c',['max'=>300]) !!}"
                                        title="{!! __('Plugins/Blog::lang.description') !!}">
                                        <textarea
                                            name="description[{!! $lang !!}][description]"
                                            class="resize border border-gray-300 rounded-md w-full focus:ring-0"
                                        >{!! old('description.'.$lang.'.description', \Arr::get($page, 'description.'.$lang.'.description')) !!}</textarea>
                                    </x-blog::control>
                                    <x-blog::control
                                        :errors="$errors"
                                        name="description.{!! $lang !!}.content"
                                        title="{!! __('Plugins/Blog::lang.description') !!}">
                                        <textarea
                                            name="description[{!! $lang !!}][content]"
                                            class="resize border border-gray-300 rounded-md w-full focus:ring-0"
                                        >{!! old('description.'.$lang.'.content', \Arr::get($page, 'description.'.$lang.'.content')) !!}</textarea>
                                    </x-blog::control>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div>
                            <div>
                                {!! __('Plugins/Blog::lang.image') !!}
                            </div>
                            <x-blog::control
                                :error="$errors->has('alias')"
                                :errors="$errors"
                                title="{!! __('Plugins/Blog::lang.alias') !!}"
                                name="alias"
                                info="{!! trans('admin.max_c',['max'=>100]) !!}"
                            >
                                <x-blog::input
                                    value="{!! old('alias', \Arr::get($page, 'alias')) !!}"
                                    name="alias"
                                    icon="edit-3"
                                    class="w-full"/>
                            </x-blog::control>
                            <x-blog::control
                                :errors="$errors"
                                title="{!!  __('admin.status') !!}"
                                name="status"
                            >
                                <x-switch
                                    checked="{!! old('status', \Arr::get($page, 'status', '2')) == 2 ? 'false' : 'true' !!}"
                                    name="status"
                                    color="green"
                                />
                            </x-blog::control>
                        </div>
                        <div class="border-t -mx-6 px-6 pt-6">
                            <div class="flex">
                                <div class="lg:w-64"></div>
                                <div class="flex flex-auto justify-between">
                                    <div>
                                        <x-button color="yellow">
                                            {!! __('admin.reset') !!}
                                        </x-button>
                                    </div>
                                    <div>
                                        <x-button color="blue">
                                            {!! __('admin.submit') !!}
                                        </x-button>
                                    </div>
                                </div>
                                <div class="xl:w-32 2xl:w-64"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).on('submit', '#from-page', function(event) {
        $.pjax.submit(event, '#body');
    });
</script>
