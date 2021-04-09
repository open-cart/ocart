<?php

namespace Ocart\Ecommerce\Http\Controllers;

use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Repositories\ProductRepositoryEloquent;
use Ocart\Theme\Facades\Theme;

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
    public function product($id)
    {
        $product = $this->repo->with('categories')->find($id);

        return Theme::scope('product',  compact('product'),'packages/ecommerce::product');
    }

    /**
     * Danh muc san pham
     * @return mixed
     */
    public function productCategory($id)
    {
        $category = $this->repoCategory->find($id);

        $products = $this->repo->productForCategory($category->id, 9);

        return Theme::scope('product-category',  compact('category', 'products'),'packages/ecommerce::product-category');
    }
}