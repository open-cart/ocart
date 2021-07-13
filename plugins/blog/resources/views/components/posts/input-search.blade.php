@props(['align' => 'left', 'name'=> '', 'source' => null, 'contentClasses' => 'py-1 bg-white', 'options' => []])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'origin-top-left left-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'origin-top-right right-0';
            break;
    }
@endphp
<script>
    function searchTagsData() {
        function showError(e) {
            if (e?.errors) {
                toast.error(Object.values(e.errors).find(Boolean));
            } else {
                toast.error(e.message);
            }
            throw e;
        }

        return {
            open: false,
            oldValue: undefined,
            selected: @json($options['value']),
            showForm: false,
            loading: false,
            tagName: '',
            change(data) {
                if (this.selected.some(x => x.id == data.id)) {
                    this.selected = this.selected.filter(x => x.id !== data.id);
                    {{--axios.post('{{ route('post_add_tag') }}', {--}}
                    {{--    post_id: 1,--}}
                    {{--    tag_id: data.id--}}
                    {{--})--}}
                } else {
                    this.selected.push(data);
                }
            },
            openSearch: function (e) {
                this.showForm = false;
                const parent = $(this.$el);
                this.open = true;
                this.$nextTick(() => {
                    this.$refs['input-search'].focus()
                })

                parent.find(".container-loading-search").html('loading');
                parent.find(".container-result-search").html('');
                const url = parent.attr('data-source');
                axios.get(url, {params: {
                        name: ''
                    }}).then(res => {
                    parent.find(".container-result-search").html(res)
                }).finally(() => {
                    parent.find(".container-loading-search").html('')
                });
            },
            fetchSomething: function (e) {
                const parent = $(this.$el);
                this.open = true;
                const value = e.target.value;
                if (value === this.oldValue) {
                    return;
                }
                this.oldValue = value;

                parent.find(".container-loading-search").html('loading');
                parent.find(".container-result-search").html('');
                const url = parent.attr('data-source');
                axios.get(url, {params: {
                        name: value
                    }}).then(res => {
                    parent.find(".container-result-search").html(res)
                }).finally(() => {
                    parent.find(".container-loading-search").html('')
                });
            },
            createTag() {
                if (this.loading) {
                    return;
                }
                this.loading = true;
                axios.post('{{ route('blog.tags.store') }}', {
                    name: this.tagName
                }).then(() => {
                    this.showForm = false;
                    this.openSearch()
                    return {};
                }).catch(showError).finally(() => {
                    this.loading = false;
                })
            },
            showFormCreate() {
                this.showForm = true;
                this.tagName = '';
                this.$nextTick(() => {
                    this.$refs['tag-new-name'].focus()
                })
            },
            closeForm() {
                this.showForm = false;
                this.$nextTick(() => {
                    this.$refs['input-search'].focus()
                })
            },
            toPage(url) {
                const parent = $(this.$el);

                parent.find(".container-loading-search").html('loading');
                parent.find(".container-result-search").hide();

                axios.get(url).then(res => {
                    parent.find(".container-result-search").html(res)
                    parent.find(".container-result-search").show()
                }).finally(() => {
                    parent.find(".container-loading-search").html('')
                });
            }
        }
    }
</script>
<div class="relative w-full"
     data-source="{!! $source !!}"
     x-data="searchTagsData()"
     >
    <template x-for="(item, index) in selected" :key="index">
        <div class="bg-blue-100 inline-flex items-center text-sm rounded mt-2 mr-1 overflow-hidden">
            <input type="hidden" name="{{ $options['real_name'] }}" x-bind:value="item.id">
            <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs px-1 dark:text-gray-600" x-text="item.name"></span>
            <button type="button"
                    title="{{ trans('admin.delete') }}"
                    x-on:click="change(item)"
                    class="w-6 h-8 inline-block align-middle text-gray-500 bg-blue-200 focus:outline-none">
                <svg class="w-6 h-6 text-gray-600 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"></path></svg>
            </button>
        </div>
    </template>
    <div class="cursor-pointer bg-blue-100 inline-flex items-center text-sm rounded mt-2 mr-1 overflow-hidden"
         title="Add"
         x-on:click="openSearch($event)">
        <span class="">&nbsp;</span>
        <x-icons.plus class="w-6 h-8 dark:text-gray-600"/>
        <span class="">&nbsp;</span>
    </div>
    <div x-show="open"
         x-on:click.away="open = false"
         @close.stop="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute z-50 mt-2 border bg-white
          dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300
          w-full rounded-md shadow-lg {{ $alignmentClasses }}"
         style="display: none;">
        <div x-show="!showForm">
            @if(isset($first))
                {{ $first }}
            @endif
            <div class="container-loading-search px-3"></div>
            <div class="container-result-search" style="overflow: auto; height: 200px;"></div>
            @if(isset($last))
                {{ $last }}
            @endif
        </div>
        <div x-show="showForm"
             class="p-3">
            <span >
                <x-input x-ref="tag-new-name"
                         x-model="tagName"
                         id="tag-new-name"
                         placeholder="{{ trans('plugins/blog::posts.name_new_tag') }}"
                         class="w-full"/>
            </span>
            <div class="pt-3">
                <x-button type="button"
                          x-bind:disabled="!tagName"
                          x-on:click="createTag">
                    <span x-show="loading">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                    {{ trans('admin.add_new') }}
                </x-button>
                <button type="button" x-on:click="closeForm">
                    {{ trans('admin.cancel') }}
                </button>
            </div>
        </div>
    </div>
</div>