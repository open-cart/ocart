<?php


namespace Ocart\Ecommerce\Services\Abstracts;


use Illuminate\Http\Request;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;

abstract class StoreCategoryServiceAbstract
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * StoreCategoryServiceAbstract constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return mixed
     */
    abstract public function execute(Request $request, Product $product);

}
