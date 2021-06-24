@if (get_payment_setting('status', STRIPE_PAYMENT_METHOD_NAME) == 1)
<li class="p-2" x-on:click="tab = '{{ STRIPE_PAYMENT_METHOD_NAME }}'">
    <label class="flex justify-between">
        <span>
            <input name="payment_method" @if(setting('default_payment_method') == STRIPE_PAYMENT_METHOD_NAME) checked @endif value="{{ STRIPE_PAYMENT_METHOD_NAME }}" type="radio">
            <span>Stripe</span>
        </span>
        <span class="flex">
                <img class="stripe-card-icon amex" src="{{asset('images/amex.svg')}}">
                <img class="stripe-card-icon discover" src="{{asset('images/discover.svg')}}">
                <img class="stripe-card-icon visa" src="{{asset('images/visa.svg')}}">
                <img class="stripe-card-icon mastercard" src="{{asset('images/mastercard.svg')}}">
            </span>
    </label>
    <div style="display: none" x-show="tab === '{{ STRIPE_PAYMENT_METHOD_NAME }}'">

        <div id="form-cart-stripe" class="mt-4">
        </div>
        {!! get_payment_setting('description', STRIPE_PAYMENT_METHOD_NAME) !!}
    </div>
</li>
<style>
    .stripe-card-icon{
        width: 43px;
        height: 26px;
        margin: 0 2px;
    }
</style>
<script>
    if (typeof Stripe !== 'function') {
        function stripeReadyHandler() {
            if (!document.getElementById('form-cart-stripe')) {
                return;
            }
            if (typeof Stripe !== 'function') {
                return;
            }
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
                        if (res.error) {
                            showError(res.error);
                        } else {
                            form.append($('<input type="hidden" name="stripeToken">').val(res.token.id));
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

        if (typeof $.pjax !== 'undefined') {
            $(document).on('pjax:complete', function() {
                stripeReadyHandler();
            });
        }

        const script = document.createElement('script');
        script.src = 'https://js.stripe.com/v3/?ver=3.3.4';
        script.type = 'text/javascript';
        script.async = true;
        document.head.append(script);

        script.onload = function() {
            stripeReadyHandler();
        }
    }
</script>
@endif