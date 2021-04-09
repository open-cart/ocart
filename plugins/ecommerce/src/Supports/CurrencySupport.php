<?php

namespace Ocart\Ecommerce\Supports;

use Ocart\Ecommerce\Models\Currency;
use Ocart\Ecommerce\Repositories\Interfaces\CurrencyRepository;

class CurrencySupport
{

    /**
     * @var Currency
     */
    protected $currency;

    /**
     * @param Currency $currency
     */
    public function setApplicationCurrency(Currency $currency)
    {
        $this->currency = $currency;

        if (session('currency') == $currency->title) {
            return;
        }
        session(['currency' => $currency->title]);
    }

    /**
     * @return Currency
     */
    public function getApplicationCurrency()
    {
        $currency = $this->currency;

        if (empty($currency)) {
            if (session('currency')) {
                $currency = app(CurrencyRepository::class)->findByField(['title' => session('currency')])->first();
            }

            if (!$currency) {
                $currency = app(CurrencyRepository::class)->findByField(['is_default' => 1])->first();
            }

            if (!$currency) {
                $currency = app(CurrencyRepository::class)->first();
            }

            if (!$currency) {
                $currency = new Currency();
            }

            $this->currency = $currency;
        }

        return $currency;
    }
}