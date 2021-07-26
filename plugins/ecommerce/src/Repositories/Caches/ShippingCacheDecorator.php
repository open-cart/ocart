<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\ShippingRepository;
use Ocart\Ecommerce\Repositories\ShippingRepositoryEloquent;

/**
 * Class ShippingCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class ShippingCacheDecorator extends CacheRepositoryDecorator implements ShippingRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * ShippingCacheDecorator constructor.
     * @param ShippingRepositoryEloquent $repository
     */
    public function __construct(ShippingRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}