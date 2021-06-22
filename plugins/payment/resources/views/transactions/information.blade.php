<div>
    <p class="py-2">
        {{ trans('plugins/payment::payment.created_at') }}: <strong>{{ $transaction->created_at }}</strong>
    </p>
    <p class="py-2">
        {{ trans('plugins/payment::payment.payment_channel') }}: <strong>{!! $transaction->payment_channel->toHtml() !!}</strong>

    </p>
    <p class="py-2">
        {{ trans('plugins/payment::payment.total') }}: <strong>{{ $transaction->amount }}</strong>

    </p>
    <p class="py-2">
        {{ trans('plugins/payment::payment.status') }}: <strong>{{ $transaction->status }}</strong>
    </p>
</div>