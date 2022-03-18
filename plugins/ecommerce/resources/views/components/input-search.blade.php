@props(['align' => 'left', 'name'=> '', 'source' => null, 'contentClasses' => 'py-1 bg-white'])

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
    function searchData() {
        return {
            open: false,
            oldValue: undefined,
            change(dispatch, data) {
                this.open = false;
                dispatch('change-item', data)
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
     x-data="searchData()"
     x-on:click.away="open = false"
     @close.stop="open = false">
    <x-input {{ $attributes->merge(['class' => 'w-full']) }}
             x-on:input.debounce.250="fetchSomething($event)"
             x-on:focus="fetchSomething($event)"/>
    <div x-show="open"
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
        @if(isset($first))
            {{ $first }}
        @endif
        <div class="container-loading-search px-3"></div>
        <div class="container-result-search px-3"></div>
    </div>
</div>
