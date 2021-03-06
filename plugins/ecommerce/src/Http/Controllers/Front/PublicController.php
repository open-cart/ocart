<?php

namespace Ocart\Ecommerce\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Repositories\ProductRepositoryEloquent;
use Ocart\SeoHelper\Facades\SeoHelper;
use Ocart\Theme\Facades\Theme;
use function MongoDB\BSON\toJSON;

class PublicController extends BaseController
{

    /**
     * @var ProductRepository
     */
    protected $repo;
    protected $repoCategory;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->repo = $productRepository;
        $this->repoCategory = $categoryRepository;
    }

    /**
     * Chi tiet san pham
     * @return mixed
     */
    public function product($slug)
    {
        $product = $this->repo->with(['categories'])->with(['tags'])->findByField('slug', $slug)->first();
        if (empty($product)) {
            abort(404);
        }
        $title = $product->name;
//        $description = Str::limit(strip_tags($product->description), 250);
        $description = Str::limit($product->description, 250);
        SeoHelper::setTitle($title);
        SeoHelper::setDescription($description);
        $meta = SeoHelper::openGraph();
        $meta->setTitle($title);
        $meta->setDescription($description);
        $meta->setType('product');

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, ECOMMERCE_PRODUCT_MODULE_SCREEN_NAME, $product);

        return Theme::scope('product',  compact('product'),'packages/ecommerce::product');
    }

    public function shop()
    {
        $title = 'shop';
        $description = 'shop';

        SeoHelper::setTitle($title);
        SeoHelper::setDescription($description);
        $meta = SeoHelper::openGraph();
        $meta->setTitle($title);
        $meta->setDescription($description);
        $meta->setType('Shop');

        $products = $this->repo->with('categories')->paginate( 9);

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, ECOMMERCE_CATEGORY_MODULE_SCREEN_NAME, []);

        return Theme::scope('shop',  compact( 'products'),'packages/ecommerce::shop');
    }

    /**
     * Danh muc san pham
     * @return mixed
     */
    public function productCategory($slug)
    {
        $category = $this->repoCategory->findByField('slug', $slug)->first();
        if (empty($category)) {
            abort(404);
       }

        $title = $category->name;
        $description = Str::limit(strip_tags($category->description), 250);
        SeoHelper::setTitle($title);
        SeoHelper::setDescription($description);
        $meta = SeoHelper::openGraph();
        $meta->setTitle($title);
        $meta->setDescription($description);
        $meta->setType('category product');

        $products = $this->repo->productForCategory($category->id, 9);

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, ECOMMERCE_CATEGORY_MODULE_SCREEN_NAME, $category);

        return Theme::scope('product-category',  compact('category', 'products'),'packages/ecommerce::product-category');
    }
}
