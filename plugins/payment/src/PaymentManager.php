<?php

namespace Ocart\Payment;

use Illuminate\Support\Manager;
use Ocart\Payment\Enums\PaymentMethodEnum;
use Ocart\Payment\Services\Gateways\BankTransferPaymentService;
use Ocart\Payment\Services\Gateways\CodPaymentService;

class PaymentManager extends Manager
{

    public function getDefaultDriver()
    {
        return PaymentMethodEnum::COD;
    }

    public function createCodDriver()
    {
        return new CodPaymentService();
    }

    public function createBankTransfer()
    {
        return new BankTransferPaymentService();
    }
}

