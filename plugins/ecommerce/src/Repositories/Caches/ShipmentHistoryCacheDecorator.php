<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\ShipmentHistoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShipmentRepository;
use Ocart\Ecommerce\Repositories\ShipmentHistoryRepositoryEloquent;

/**
 * Class ShipmentHistoryCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class ShipmentHistoryCacheDecorator extends CacheRepositoryDecorator implements ShipmentHistoryRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [ShipmentRepository::class];

    public function __construct(ShipmentHistoryRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}