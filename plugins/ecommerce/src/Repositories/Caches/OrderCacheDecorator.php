<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\OrderRepositoryEloquent;

/**
 * Class OrderCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class OrderCacheDecorator extends CacheRepositoryDecorator implements OrderRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    public function __construct(OrderRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}