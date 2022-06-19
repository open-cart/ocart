<x-modal
    contentClasses="w-11/12 md:w-5/12 mb-auto mt-4"
    target="search-modal"
    targetHide="search-modal-hide"
    class="search-modal-class z-50 items-start"
>
    <x-slot name="header"></x-slot>
    <x-slot name="content">
        <x-theme::form.search/>
    </x-slot>
    <x-slot name="footer"></x-slot>
</x-modal>

<style>
    .search-modal-class .modal-content {
        padding: 0px !important;
    }
    @media (max-width: 768px) {
        .search-modal-class .modal-close {
            display: none !important;
        }
    }

</style>
