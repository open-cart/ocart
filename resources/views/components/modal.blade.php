@props(['contentClasses' => 'w-11/12', 'target' => '', 'targetHide' => ''])

<span x-data="{open: false, show() {this.open = true}, close() {this.open = false},}"
      x-init="$watch('open', value => {if(value) {$('html').addClass('overflow-hidden')} else {$('html').removeClass('overflow-hidden')} })">
    <div id="{!! $target !!}" class="hidden" x-on:click="$dispatch('before-show');show()"></div>
    <div id="{!! $targetHide !!}" class="hidden" x-on:click="close()"></div>
    <div
        {{ $attributes->merge(['class' => 'z-10 fixed w-full h-full top-0 left-0 flex items-center justify-center']) }}
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
        style="display:none"
        x-show="open"
    >
        <div class="modal-overlay absolute w-full h-full bg-gray-900 dark:bg-gray-500 opacity-50"
             x-on:click="close"></div>

        <div
            class="modal-container bg-white dark:bg-gray-800 dark:text-gray-300 mx-auto rounded shadow-lg z-50 max-h-screen overflow-y-auto {{ $contentClasses }}">
            <div
                x-on:click="close"
                class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <x-theme::icons.close class="w-6 h-6 text-white"/>

                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                {!! $header !!}
                {{--                <x-divider class="-mx-6"/>--}}
                {!! $content !!}
                {{--                <x-divider class="-mx-6"/>--}}
                {!! $footer !!}
            </div>
        </div>
    </div>
</span>
