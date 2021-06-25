<?php

namespace Ocart\Stripe;

use Illuminate\Http\Request;
use Ocart\Payment\Enums\PaymentMethodEnum;
use Ocart\Payment\Enums\PaymentStatusEnum;
use Ocart\Payment\Services\ProduceServiceInterface;
use Ocart\Payment\Services\Traits\PaymentTrait;
use Stripe\Charge;
use Stripe\Stripe;
use Exception;

class StripePaymentService  implements ProduceServiceInterface
{
    use PaymentTrait;

    /**
     * Token
     *
     * @var string
     */
    protected $token;

    /**
     * Amount of payment
     *
     * @var double
     */
    protected $amount;

    /**
     * Payment currency
     *
     * @var string
     */
    protected $currency;

    /**
     * For Stripe, after make charge successfully, it will return a charge ID for tracking purpose
     * We will store this Charge ID in our DB for tracking purpose
     *
     * @var string
     */
    protected $chargeId;

    /**
     * Execute main service
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function execute(Request $request)
    {
        if (!$request->input('stripeToken')) {
            throw new Exception(trans('plugins/payment::payment.could_not_get_stripe_token'));
        }

        $this->token = $request->stripeToken;

        $chargeId = $this->makePayment($request);

        // Hook after made payment
        $this->afterMakePayment($chargeId, $request);

        return $chargeId;
    }

    protected function makePayment($request)
    {
        $this->amount = $request->input('amount');
        $this->currency = $request->input('currency', config('plugins.payment.payment.currency'));
        $this->currency = strtoupper($this->currency);
        $description = $request->input('description');

        Stripe::setApiKey(setting('stripe_private_key'));
        Stripe::setClientId(setting('stripe_public_key'));

        $amount = $this->amount;

        $multiplier = $this->getStripeCurrencyMultiplier($this->currency);

        if ($multiplier > 1) {
            $amount = (int) ($amount * $multiplier);
        }

        $charge = Charge::create([
            'amount'      => $amount,
            'currency'    => $this->currency,
            'source'      => $this->token,
            'description' => $description,
        ]);

        $this->chargeId = $charge['id'];

        return $this->chargeId;
    }

    protected function getStripeCurrencyMultiplier($currency)
    {
        $currency = strtoupper($currency);

        // default
        if (empty($currency)) {
            return 100;
        }

        // these currencies no need to multiply by 100ths
        $zeroDecimalCurrencies = [
            'BIF',
            'CLP',
            'DJF',
            'GNF',
            'JPY',
            'KMF',
            'KRW',
            'MGA',
            'PYG',
            'RWF',
            'VND',
            'VUV',
            'XAF',
            'XOF',
            'XPF',
        ];

        return in_array(strtoupper($currency), $zeroDecimalCurrencies) ? 1 : 100;
    }

    protected function afterMakePayment($chargeId, Request $request)
    {
        try {
            $payment = $this->getPaymentDetails($chargeId);
            if ($payment && ($payment->paid || $payment->status == 'succeeded')) {
                $paymentStatus = PaymentStatusEnum::COMPLETED;
            } else {
                $paymentStatus = PaymentStatusEnum::FAILED;
            }
        } catch (Exception $exception) {
            $paymentStatus = PaymentStatusEnum::FAILED;
        }

        $this->storeLocalPayment([
            'amount'          => $this->amount,
            'currency'        => $this->currency,
            'charge_id'       => $chargeId,
            'order_id'        => $request->input('order_id'),
            'payment_channel' => STRIPE_PAYMENT_METHOD_NAME,
            'status'          => $paymentStatus,
        ]);

        return true;
    }

    /**
     * Get payment details
     *
     * @param string $chargeId Stripe charge Id
     * @return mixed Object payment details
     * @throws Exception
     */
    public function getPaymentDetails($chargeId)
    {
        Stripe::setApiKey(setting('stripe_private_key'));
        Stripe::setClientId(setting('stripe_public_key'));

        return Charge::retrieve($chargeId);
    }
}