<?php
namespace Ocart\Payment\Services\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Ocart\Payment\Enums\PaymentMethodEnum;
use Ocart\Payment\Enums\PaymentStatusEnum;
use Ocart\Payment\Repositories\PaymentRepository;

trait PaymentTrait
{
    /**
     * Store payment on local
     *
     * @param array $args
     * @return mixed
     */
    public function storeLocalPayment(array $args = [])
    {
        $data = array_merge([
            'user_id' => Auth::check() ? Auth::user()->getAuthIdentifier() : 0,
        ], $args);

        $paymentChannel = Arr::get($data, 'payment_channel', PaymentMethodEnum::COD);

        return app(PaymentRepository::class)->create([
            'account_id'      => Arr::get($data, 'account_id'),
            'amount'          => $data['amount'],
            'currency'        => $data['currency'],
            'charge_id'       => $data['charge_id'],
            'order_id'        => $data['order_id'],
            'payment_channel' => $paymentChannel,
            'status'          => Arr::get($data, 'status', PaymentStatusEnum::PENDING),
        ]);
    }
}