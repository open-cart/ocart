<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\OrderAddressRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\OrderAddressRepositoryEloquent;

/**
 * Class OrderAddressCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class OrderAddressCacheDecorator extends CacheRepositoryDecorator implements OrderAddressRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [OrderRepository::class];

    public function __construct(OrderAddressRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}