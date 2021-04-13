@props(['contentClasses' => 'w-11/12', 'target' => ''])

<span x-data="{open: false, show() {this.open = true}, close() {this.open = false},}">
    <div id="{!! $target !!}" class="hidden" x-on:click="$dispatch('before-show');show()"></div>
    <div
            {{ $attributes->merge(['class' => 'z-10 fixed w-full h-full top-0 left-0 flex items-center justify-center']) }}
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-headline"
            style="display:none"
            x-show="open"
    >
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"  x-on:click="close"></div>

        <div class="modal-container bg-white mx-auto rounded shadow-lg z-50 overflow-y-auto {{ $contentClasses }}">
            <div
                    x-on:click="close"
                    class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                {!! $header !!}
                <hr class="-mx-6">
                {!! $content !!}
                <hr class="-mx-6">
                <!--Footer-->
                {!! $footer !!}
            </div>
        </div>
    </div>
</span>