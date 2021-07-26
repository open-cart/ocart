<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\ShippingRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShippingRuleRepository;
use Ocart\Ecommerce\Repositories\ShippingRuleRepositoryEloquent;

/**
 * Class ShippingRuleCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class ShippingRuleCacheDecorator extends CacheRepositoryDecorator implements ShippingRuleRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [ShippingRepository::class];

    /**
     * ShippingRuleCacheDecorator constructor.
     * @param ShippingRuleRepositoryEloquent $repository
     */
    public function __construct(ShippingRuleRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}