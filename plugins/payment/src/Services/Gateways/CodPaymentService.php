<?php
namespace Ocart\Payment\Services\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ocart\Payment\Enums\PaymentMethodEnum;
use Ocart\Payment\Enums\PaymentStatusEnum;
use Ocart\Payment\Services\ProduceServiceInterface;
use Ocart\Payment\Services\Traits\PaymentTrait;

class CodPaymentService implements ProduceServiceInterface
{
    use PaymentTrait;

    public function execute(Request $request)
    {
        $chargeId = Str::upper(Str::random(10));

        $this->storeLocalPayment([
            'amount'          => $request->input('amount'),
            'currency'        => $request->input('currency'),
            'charge_id'       => $chargeId,
            'order_id'        => $request->input('order_id'),
            'payment_channel' => PaymentMethodEnum::COD,
            'status'          => PaymentStatusEnum::PENDING,
        ]);

        return $chargeId;
    }
}