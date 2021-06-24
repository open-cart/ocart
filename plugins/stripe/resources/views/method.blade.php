@if (get_payment_setting('status', STRIPE_PAYMENT_METHOD_NAME) == 1)
<li class="p-2" x-on:click="tab = '{{ STRIPE_PAYMENT_METHOD_NAME }}'">
    <label class="flex justify-between">
        <span>
            <input name="payment_method" @if(setting('default_payment_method') == STRIPE_PAYMENT_METHOD_NAME) checked @endif value="{{ STRIPE_PAYMENT_METHOD_NAME }}" type="radio">
            <span>Stripe</span>
        </span>
        <span class="flex">
                <img class="wc-stripe-card-icon amex" src="{{asset('images/amex.svg')}}">
                <img class="wc-stripe-card-icon discover" src="{{asset('images/discover.svg')}}">
                <img class="wc-stripe-card-icon visa" src="{{asset('images/visa.svg')}}">
                <img class="wc-stripe-card-icon mastercard" src="{{asset('images/mastercard.svg')}}">
            </span>
    </label>
    <div style="display: none" x-show="tab === '{{ STRIPE_PAYMENT_METHOD_NAME }}'">

        <div id="form-cart-stripe" class="mt-4">
        </div>
        {!! get_payment_setting('description', STRIPE_PAYMENT_METHOD_NAME) !!}
    </div>
</li>
<style>
    .wc-stripe-card-icon{
        width: 43px;
        height: 26px;
        margin: 0 2px;
    }
    .space-between{
        display: flex;
        justify-content: space-between;
        margin-bottom: 14px;
    }
</style>
@push('footer')
<script src="https://js.stripe.com/v3/?ver=3.3.4"></script>
<script>
    var SPayment = SPayment || {};

    SPayment = {
        init() {
            const stripe = Stripe('{{ setting('stripe_public_key') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                style: {
                    base: {
                        fontSize: '18px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    }
                }
            });

            cardElement.mount('#form-cart-stripe');

            const cardButton = document.getElementById('payment-checkout-btn');

            cardButton.addEventListener('click', async (event) => {
                event.preventDefault();
                const _self = $(event.target);
                const form = _self.closest('form');
                if ($('input[name=payment_method]:checked').val() === 'stripe') {
                    const submitText = _self.html();

                    _self.html('Processing. Please wait...');

                    stripe.createToken(cardElement).then(res => {
                        console.log(res)
                        if (res.error) {

                        } else {
                            form.append($('<input type="hidden" name="stripeToken">').val(res.id));
                            form.submit();
                        }
                    }).finally(() => {
                        _self.html(submitText);
                    })
                } else {
                    form.submit();
                }
            });
        }

    }
    SPayment.init();
    $(document).on('pjax:complete', function() {
        SPayment.init();
    })

</script>
@endpush
@endif