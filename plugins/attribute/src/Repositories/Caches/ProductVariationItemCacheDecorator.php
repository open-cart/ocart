<?php

namespace Ocart\Attribute\Repositories\Caches;

use Ocart\Attribute\Repositories\Interfaces\ProductVariationItemRepository;
use Ocart\Attribute\Repositories\ProductVariationItemRepositoryEloquent;
use Ocart\Core\Supports\CacheRepositoryDecorator;

/**
 * Class ProductVariationItemCacheDecorator
 * @package Ocart\Attribute\Repositories\Caches
 */
class ProductVariationItemCacheDecorator extends CacheRepositoryDecorator implements ProductVariationItemRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * ProductVariationItemCacheDecorator constructor.
     * @param ProductVariationItemRepositoryEloquent $repository
     */
    public function __construct(ProductVariationItemRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}