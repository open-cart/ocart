<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\OrderHistoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\OrderHistoryRepositoryEloquent;

/**
 * Class OrderHistoryCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class OrderHistoryCacheDecorator extends CacheRepositoryDecorator implements OrderHistoryRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [OrderRepository::class];

    public function __construct(OrderHistoryRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}