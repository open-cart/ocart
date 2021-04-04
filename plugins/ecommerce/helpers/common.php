<?php
use \Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Illuminate\Support\Arr;
use \Ocart\Ecommerce\Repositories\Interfaces\CurrencyRepository;
use \Ocart\Ecommerce\Models\Currency;

if (!function_exists('get_categories')) {
    /**
     * @param array $args
     * @return array|mixed
     */
    function get_categories(array $args = [])
    {
        $indent = Arr::get($args, 'indent', '——');

        $repo = app(CategoryRepository::class);

        $repo->orderBy($repo->getModel()->qualifyColumn('is_default'), 'DESC');
        $repo->orderBy($repo->getModel()->qualifyColumn('order'), 'ASC');
        $categories = $repo->all();

        $categories = sort_item_with_children($categories);

        foreach ($categories as $category) {
            $indentText = '';
            $depth = (int)$category->depth;
            for ($i = 0; $i < $depth; $i++) {
                $indentText .= $indent;
            }
            $category->indent_text = $indentText;
        }

        return $categories;
    }
}

if (!function_exists('get_list_products')) {
    function get_list_products() {
        /** @var \Ocart\Ecommerce\Repositories\Interfaces\ProductRepository $repo */
        $repo = app(\Ocart\Ecommerce\Repositories\Interfaces\ProductRepository::class)->with('categories');

        return $repo->all();
    }
}

if (!function_exists('get_list_products_feature')) {
    function get_list_products_feature($limit = 9)
    {
        /** @var \Ocart\Ecommerce\Repositories\Interfaces\ProductRepository $repo */
        /** @var \Ocart\Ecommerce\Repositories\ProductRepositoryEloquent $repo */
        $repo = app(\Ocart\Ecommerce\Repositories\Interfaces\ProductRepository::class)->with('categories');
        return $repo->getFeature($limit);
    }
}

if (!function_exists('get_ecommerce_setting')) {
    /**
     * @param string $key
     * @param null $default
     * @return string
     */
    function get_ecommerce_setting($key, $default = '')
    {
        return setting(config('plugins.ecommerce.general.prefix') . $key, $default);
    }
}

if (!function_exists('cms_currency')) {
    /**
     * @return \Ocart\Ecommerce\Facades\CurrencySupport
     */
    function cms_currency()
    {
        return \Ocart\Ecommerce\Facades\CurrencySupport::getFacadeRoot();
    }
}

function get_application_currency()
{
    return cms_currency()->getApplicationCurrency();
}

if (!function_exists('format_price')) {
    /**
     * @param int $price
     * @param Currency|null $currency
     * @param bool $withoutCurrency
     * @param bool $useSymbol
     * @return string
     */
    function format_price($price, $currency = null, $withoutCurrency = false, $useSymbol = true): string
    {
        if (!$currency) {
            $currency = get_application_currency();
        } elseif ($currency != null && !($currency instanceof Currency)) {
            $currency = app(CurrencyRepository::class)
                ->findByField(['id' => $currency])->first();
        }

        if (!$currency) {
            return human_price_text($price, $currency);
        }
        if ($currency->is_default != 1 && $currency->exchange_rate > 0) {
            $price = $price * $currency->exchange_rate;
        }

        if ($useSymbol && $currency->is_prefix_symbol) {
            return $currency->symbol . human_price_text($price, $currency);
        }

        if ($withoutCurrency) {
            return human_price_text($price, $currency);
        }

        return human_price_text($price, $currency, ($useSymbol ? $currency->symbol : $currency->title));
    }
}

if (!function_exists('human_price_text')) {
    /**
     * @param int $price
     * @param Currency|null $currency
     * @param string $priceUnit
     * @return string
     */
    function human_price_text($price, $currency, $priceUnit = ''): string
    {
        $numberAfterDot = ($currency instanceof Currency) ? $currency->decimals : 0;

        if (config('plugins.ecommerce.general.display_big_money_in_million_billion')) {
            if ($price >= 1000000 && $price < 1000000000) {
                $price = round($price / 1000000, 2);
                $numberAfterDot = 2;
                $priceUnit = __('million') . ' ' . $priceUnit;
            } elseif ($price >= 1000000000) {
                $price = round($price / 1000000000, 2);
                $numberAfterDot = 2;
                $priceUnit = __('billion') . ' ' . $priceUnit;
            }
        }

        if (is_numeric($price)) {
            $price = preg_replace('/[^0-9,.]/s', '', $price);
        }

        $price = number_format($price, $numberAfterDot, Arr::get($currency, 'decimal_separator', '.'), Arr::get($currency, 'thousands_separator', ','));

        return $price . ($priceUnit ? $priceUnit : '');
    }
}