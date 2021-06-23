<?php
namespace Ocart\Payment\Services\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ocart\Payment\Enums\PaymentMethodEnum;
use Ocart\Payment\Enums\PaymentStatusEnum;
use Ocart\Payment\Services\ProduceServiceInterface;
use Ocart\Payment\Services\Traits\PaymentTrait;

class BankTransferPaymentService implements ProduceServiceInterface
{
    use PaymentTrait;

    /**
     * @param Request $request
     * @return mixed|void
     */
    public function execute(Request $request)
    {
        $chargeId = Str::upper(Str::random(10));

        $this->storeLocalPayment([
            'amount'          => $request->input('amount'),
            'currency'        => $request->input('currency'),
            'charge_id'       => $chargeId,
            'order_id'        => $request->input('order_id'),
            'payment_channel' => PaymentMethodEnum::BANK_TRANSFER,
            'status'          => PaymentStatusEnum::PENDING,
        ]);

        return $chargeId;
    }
}
