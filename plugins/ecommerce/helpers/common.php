<?php
use \Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Illuminate\Support\Arr;

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

if (!function_exists('add_to_cart')) {
    function add_to_cart($data)
    {
        Cart::add([
            'id' => $data['id'],
            'name' => $data['name'],
            'price' => $data['price'],
            'weight' => 500,
            'qty' => 1,
            'options' => [
                'image' => head($data['images']),
                'category' => head($data['categories']),
                'slug' => $data['slug']
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