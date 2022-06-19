@props(['id' => 'form-search', 'type' => 'default'])

<div id="{{ $id }}">
    <form
        action="{{ route('blog') }}"
        method="GET"
        class="relative @if($type == 'default') pr-12 md:pr-14 @endif bg-white overflow-hidden rounded-md w-full"
    >
        <label for="search" class="flex items-center">
            <button
                type="button"
                class="@if($type == 'right') text-blue-500 order-last @endif w-12 md:w-14 h-full flex flex-shrink-0 justify-center items-center cursor-pointer focus:outline-none">
                <x-theme::icons.search class="w-6"/>
            </button>
            <input
                id="{{$id}}form-search-name"
                class="@if($type == 'right') text-right @endif h-12 lg:h-14 text-heading outline-none w-full placeholder-gray-400 text-sm lg:text-base"
                placeholder="Tìm kiếm"
                autocomplete="off"
                name="name"
                value=""
            >
            <input type="hidden" name="submit" value="search"/>

        </label>
        @if($type != 'right')
            <div
                id="{{$id}}remove-search-text"
                class="w-12 md:w-14 outline-none text-2xl md:text-3xl text-gray-400 absolute top-0 right-0 h-full flex items-center justify-center transition duration-200 ease-in-out hover:text-heading focus:outline-none cursor-pointer"
            >
                <x-theme::icons.close class="w-6 h-6"/>
            </div>
        @endif

    </form>
</div>

<script>
    $('#search-modal').click(function () {
        setTimeout(() => {
            $('#{{$id}}form-search-name').focus();
        }, 300);
    });

    $(function () {
        const filterForm = $('#{{$id}}');

        const searchFn = function (event) {
            event.preventDefault();
            $('#search-modal-hide').click();
            function isEmpty( el ){
                return !$.trim(el.html())
            }
            if (isEmpty($('#layout-content-main'))) {
                $.pjax.submit(event, '#body-content');
            }else {
                $.pjax.submit(event, '#layout-content-main');
            }
        }

        filterForm.on('click', 'button', () => {
            filterForm.find('form').submit();
        });

        filterForm.on('click', '#{{$id}}remove-search-text', () => {
            $('#{{$id}}form-search-name').val('');
        });

        filterForm.on('submit', 'form', searchFn)
    })

</script>
