<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\StoreRepository;
use Ocart\Ecommerce\Repositories\StoreRepositoryEloquent;

/**
 * Class StoreCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class StoreCacheDecorator extends CacheRepositoryDecorator implements StoreRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * StoreCacheDecorator constructor.
     * @param StoreRepositoryEloquent $repository
     */
    public function __construct(StoreRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}