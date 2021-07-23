<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\CategoryRepositoryEloquent;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

/**
 * Class CategoryCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class CategoryCacheDecorator extends CacheRepositoryDecorator implements CategoryRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [ProductRepository::class];

    public function __construct(CategoryRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}