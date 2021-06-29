<x-modal content_classes="w-auto" target="test-email-modal">
    <x-slot name="header">
        <div>
            <h3 class="text-2xl pb-3">Send a test email</h3>
        </div>
    </x-slot>
    <x-slot name="content">
        <div  class="py-4 space-y-3">
            <p>
                {{ trans('To send test email, please make sure you are updated configuration to send mail!') }}
            </p>
            <x-input class="w-full email-test"
                     placeholder="Enter the email which you want to send..."/>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-end pt-2">
            <x-button
                    x-on:click="close()"
                    type="button"
                    color="bg-yellow-500 hover:bg-blue-400 mr-2">
                cancel
            </x-button>
            <x-button
                    class="send-email"
                    type="button">
                Send
            </x-button>
        </div>
    </x-slot>
</x-modal>
<script>
    (function() {
        const parent = $('#test-email-modal').parent();
        parent.find('.send-email').click(function () {
            const _self = $(this);
            _self.addClass('button-loading');
            axios.post('{!! route('setting.email.send.test') !!}', {
                email: parent.find("input.email-test").val()
            }).finally(() => {
                _self.removeClass('button-loading');
            })
        });
    })()
</script>