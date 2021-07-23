<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\OrderProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\OrderProductRepositoryEloquent;

/**
 * Class OrderProductCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class OrderProductCacheDecorator extends CacheRepositoryDecorator implements OrderProductRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [OrderRepository::class];

    public function __construct(OrderProductRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}