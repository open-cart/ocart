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
