<?php


namespace Ocart\Blog\Services\Abstracts;


use Illuminate\Http\Request;
use Ocart\Blog\Models\Post;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;

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
     * @param Post $post
     * @return mixed
     */
    abstract public function execute(Request $request, Post $post);

}
