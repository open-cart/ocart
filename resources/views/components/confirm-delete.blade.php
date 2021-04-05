<div
    {{ $attributes->merge(['class' => 'z-10 fixed w-full h-full top-0 left-0 flex items-center justify-center']) }}
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-headline"
    style="display:none"
    >
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-96 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

        <div
            x-on:click="$dispatch('close', { foo: 'bar' })"
            class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
            <span class="text-sm">(Esc)</span>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-center">
                <i data-feather="alert-triangle" width="80" height="80" class="text-yellow-500 opacity-75"></i>
            </div>

            <!--Body-->
            <div class="text-center">
                <h3 class="text-3xl pt-3">
                    {!! __('admin.action_admin.are_you_sure') !!}
                </h3>
                <p class="py-3">
                    {!! __('admin.action_admin.delete_warning') !!}
                </p>
            </div>

            <!--Footer-->
            <div class="flex justify-center pt-2">
                <x-button
                    x-on:click="$dispatch('accept', { foo: 'bar' })"
                    type="button"
                    class="bg-blue-500 hover:bg-blue-400 mr-2">
                    {!! __('admin.action_admin.confirm_yes') !!}
                </x-button>
                <x-button
                    x-on:click="$dispatch('close', { foo: 'bar' })"
                    type="button"
                    class="modal-close px-4 bg-red-500 hover:bg-red-400">
                    {!! __('admin.action_admin.cancel') !!}
                </x-button>
            </div>

        </div>
    </div>
</div>
