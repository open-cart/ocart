<?php

namespace Ocart\Blog\Repositories\Caches;

use Ocart\Blog\Repositories\CategoryRepositoryEloquent;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Core\Supports\CacheRepositoryDecorator;

/**
 * Class CategoryCacheDecorator
 * @package Ocart\Blog\Repositories\Caches
 */
class CategoryCacheDecorator extends CacheRepositoryDecorator implements CategoryRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [PostRepository::class];

    public function __construct(CategoryRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}