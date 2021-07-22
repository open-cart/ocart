<?php

use Ocart\Core\Supports\SortItemsWithChildrenSupport;
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

//        $repo->orderBy($repo->getModel()->qualifyColumn('is_default'), 'DESC');
//        $repo->orderBy($repo->getModel()->qualifyColumn('order'), 'ASC');
        $repo->orderBy($repo->getModel()->qualifyColumn('name'), 'ASC');
        $categories = $repo->all();

        /** @var SortItemsWithChildrenSupport $sortSupport */
        $sortSupport = app(SortItemsWithChildrenSupport::class);

        $list = $sortSupport->setItems($categories)->setChildrenProperty('child_cats')->sort();

        $categories = sort_item_with_children($list);

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

if (!function_exists('get_product_categories_with_children')) {
    function get_product_categories_children()
    {
        /** @var CategoryRepository $repo */
        $repo = app(CategoryRepository::class);

        $repo->orderBy($repo->getModel()->qualifyColumn('name'), 'ASC');
        $categories = $repo->all();

        /** @var SortItemsWithChildrenSupport $sortSupport */
        $sortSupport = app(SortItemsWithChildrenSupport::class);

        return $sortSupport->setItems($categories)->setChildrenProperty('child_cats')->sort();
    }
}

if (!function_exists('get_categories_feature')) {
    /**
     * @param array $args
     * @return array|mixed
     */
    function get_categories_feature(array $args = [])
    {
        $repo = app(CategoryRepository::class);

        $repo->orderBy($repo->getModel()->qualifyColumn('updated_at'), 'DESC');
        $repo->orderBy($repo->getModel()->qualifyColumn('order'), 'ASC');
        /** @var \Ocart\Ecommerce\Repositories\CategoryRepositoryEloquent $repo */
        $categories = $repo->getFeature()->all();

        return $categories;
    }
}
if (!function_exists('get_categories_feature_parent_main')) {
    /**
     * @param array $args
     * @return array|mixed
     */
    function get_categories_feature_parent_main(array $args = [])
    {
        $indent = Arr::get($args, 'indent', '——');

        $repo = app(CategoryRepository::class);

        $repo->orderBy($repo->getModel()->qualifyColumn('updated_at'), 'DESC');
        $repo->orderBy($repo->getModel()->qualifyColumn('order'), 'ASC');
        /** @var \Ocart\Ecommerce\Repositories\CategoryRepositoryEloquent $repo */
        $categories = $repo->getFeature()->all();

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
        $repo = app(\Ocart\Ecommerce\Repositories\Interfaces\ProductRepository::class);
        return $repo->getFeature($limit);
    }
}

if (!function_exists('get_list_products_new')) {
    function get_list_products_new($limit = 9)
    {
        /** @var \Ocart\Ecommerce\Repositories\Interfaces\ProductRepository $repo */
        /** @var \Ocart\Ecommerce\Repositories\ProductRepositoryEloquent $repo */
        $repo = app(\Ocart\Ecommerce\Repositories\Interfaces\ProductRepository::class);
        return $repo->getNews($limit);
    }
}

if (!function_exists('get_list_products_relate')) {
    function get_list_products_relate($categoryId = 1, $limit = 9)
    {
        /** @var \Ocart\Ecommerce\Repositories\Interfaces\ProductRepository $repo */
        /** @var \Ocart\Ecommerce\Repositories\ProductRepositoryEloquent $repo */
        $repo = app(\Ocart\Ecommerce\Repositories\Interfaces\ProductRepository::class);
        return $repo->getRelate($categoryId, $limit);
    }
}

if (!function_exists('get_list_products_category')) {
    function get_list_products_category($categoryId = 1, $limit = 9)
    {
        /** @var \Ocart\Ecommerce\Repositories\Interfaces\ProductRepository $repo */
        /** @var \Ocart\Ecommerce\Repositories\ProductRepositoryEloquent $repo */
        $repo = app(\Ocart\Ecommerce\Repositories\Interfaces\ProductRepository::class);
        return $repo->getFetureCategory($categoryId, $limit);
    }
}

if (!function_exists('get_ecommerce_setting')) {
    /**
     * @param string $key
     * @param string $default
     * @return string
     */
    function get_ecommerce_setting(string $key, $default = '')
    {
        return setting(get_ecommerce_setting_key($key), $default);
    }
}

if (!function_exists('get_ecommerce_setting_key')) {
    /**
     * @param string $key
     * @return string
     */
    function get_ecommerce_setting_key(string $key)
    {
        return config('plugins.ecommerce.general.prefix') . $key;
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

if(!function_exists('get_application_currency')) {
    /**
     * @return Currency
     */
    function get_application_currency()
    {
        return cms_currency()->getApplicationCurrency();
    }
}

if (!function_exists('get_application_currency_id')) {
    /**
     * @return int|null
     */
    function get_application_currency_id()
    {
        $currency = cms_currency()->getApplicationCurrency();

        return $currency ? $currency->id : null;
    }
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

if (!function_exists('decimal_notation')) {
    /**
     * @param $float
     * @return string
     */
    function decimal_notation($float) {
        $parts = explode('E', $float);

        if(count($parts) === 2){
            $exp = abs(end($parts)) + strlen($parts[0]);
            $decimal = number_format($float, $exp, '.', ',');
            $decimal = str_replace(',', '', $decimal);
            $parts = explode('.', $decimal);
            $parts[1] = rtrim($parts[1], '.0');
            return trim(join('.', $parts), '.');
        }
        else{
            return $float;
        }
    }
}

if (!function_exists('get_cart_content')) {
    function get_cart_content()
    {
        return Cart::content();
    }
}

if (!function_exists('get_cart_count')) {
    function get_cart_count()
    {
        return Cart::count();
    }
}

if (!function_exists('get_cart_pricetotal')) {
    function get_cart_pricetotal()
    {
        return Cart::priceTotal(0, '', '');
    }
}

if (!function_exists('get_cart_subtotal')) {
    function get_cart_subtotal()
    {
        return Cart::subtotal(0, '', '');
    }
}

if (!function_exists('add_to_cart')) {
    function add_to_cart($data, $slug = null, $quantity = 1, $optionAttrs = [])
    {
        Cart::add([
            'id' => $data->id,
            'name' => $data->name,
            'price' => $data->sell_price,
            'weight' => 500,
            'qty' => $quantity,
            'options' => [
                'image' => head($data->images),
                'categories' => $data->categories,
                'slug' => $slug != null ? $slug : $data->slug,
                'attrs' => $optionAttrs,
            ]
        ]);
    }
}

if (!function_exists('remove_to_cart')) {
    function remove_to_cart($rowId)
    {
        Cart::remove($rowId);
    }
}

if (!function_exists('update_to_cart')) {
    function update_to_cart($rowId, $qty)
    {
        Cart::update($rowId, $qty);
    }
}

if (!function_exists('destroy_to_cart')) {
    function destroy_to_cart()
    {
        Cart::destroy();
    }
}

if (!function_exists('createSku')) {
    function create_sku()
    {
        /** @var \Ocart\Ecommerce\Repositories\Interfaces\ProductRepository $repo */
        $repo = app(\Ocart\Ecommerce\Repositories\Interfaces\ProductRepository::class);
        return $repo->createSku();
    }
}

if (!function_exists('get_order_id')) {
    function get_order_id($code = '')
    {
        if (Str::startsWith($code, '#')) {
            $code = Str::of($code)->trim('#');
        }

        return Str::of($code)->ltrim('0');
    }
}




