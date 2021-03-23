<?php

namespace Ocart\Ecommerce\Http\Controllers;

use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
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
    public function index($id)
    {
        $product = $this->repo->find($id);
        $category = $this->repoCategory->first();

        return Theme::scope('product',  compact('product', 'category'),'package/ecommerce::product');
    }
}