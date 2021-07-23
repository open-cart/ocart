<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\ShipmentRepository;
use Ocart\Ecommerce\Repositories\ShipmentRepositoryEloquent;

/**
 * Class ShipmentCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class ShipmentCacheDecorator extends CacheRepositoryDecorator implements ShipmentRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * ShipmentCacheDecorator constructor.
     * @param ShipmentRepositoryEloquent $repository
     */
    public function __construct(ShipmentRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}