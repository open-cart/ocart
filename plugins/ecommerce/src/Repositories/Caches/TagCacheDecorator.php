<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\TagRepository;
use Ocart\Ecommerce\Repositories\TagRepositoryEloquent;

/**
 * Class TagCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class TagCacheDecorator extends CacheRepositoryDecorator implements TagRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [ProductRepository::class];

    /**
     * TagCacheDecorator constructor.
     * @param TagRepositoryEloquent $repository
     */
    public function __construct(TagRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}