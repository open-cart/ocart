<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\CustomerRepositoryEloquent;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerRepository;

/**
 * Class TaxCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class CustomerCacheDecorator extends CacheRepositoryDecorator implements CustomerRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * CustomerCacheDecorator constructor.
     * @param CustomerRepositoryEloquent $repository
     */
    public function __construct(CustomerRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}