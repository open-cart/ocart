<?php

namespace Ocart\Ecommerce\Supports;

class EcommerceHelper
{

    /**
     * @return bool
     */
    public function isCartEnabled()
    {
        return get_ecommerce_setting('shopping_cart_enabled', '1') == 1;
    }

    /**
     * @return bool
     */
    public function isTaxEnabled()
    {
        return get_ecommerce_setting('tax_enabled', '1') == 1;
    }

    /**
     * @return bool
     */
    public function isDisplayProductIncludingTaxes(): bool
    {
        if (!$this->isTaxEnabled()) {
            return false;
        }

        return get_ecommerce_setting('display_product_price_including_taxes', '0') == '1';
    }
}