<?php
namespace Ocart\Ecommerce\Services;


use Illuminate\Http\Request;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Services\Abstracts\StoreCategoryServiceAbstract;

class StoreCategoryService extends StoreCategoryServiceAbstract
{

    public function execute(Request $request, Product $product)
    {
        $categories = $request->input('categories');
        if (!empty($categories)) {
            $product->categories()->detach();
            foreach ($categories as $category) {
                $product->categories()->attach($category);
            }
        }
    }
}
