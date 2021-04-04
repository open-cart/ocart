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
        return get_ecommerce_setting('ecommerce_tax_enabled', '1') == 1;
    }
}