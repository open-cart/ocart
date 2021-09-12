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
    public function executeTag(Request $request, Product $product)
    {
        $tags = $request->input('tags');
        if (!empty($tags)) {
            $product->tags()->detach();
            foreach ($tags as $tag) {
                $product->tags()->attach($tag);
            }
        }
    }
}
