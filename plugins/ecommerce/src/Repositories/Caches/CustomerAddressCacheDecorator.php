<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\CustomerAddressRepositoryEloquent;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerAddressRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerRepository;

/**
 * Class CustomerAddressCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class CustomerAddressCacheDecorator extends CacheRepositoryDecorator implements CustomerAddressRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [CustomerRepository::class];

    public function __construct(CustomerAddressRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}