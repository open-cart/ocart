<?php

namespace Ocart\Attribute\Repositories\Caches;

use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Attribute\Repositories\ProductWithAttributeGroupRepositoryEloquent;
use Ocart\Core\Supports\CacheRepositoryDecorator;

/**
 * Class ProductWithAttributeGroupCacheDecorator
 * @package Ocart\Attribute\Repositories\Caches
 */
class ProductWithAttributeGroupCacheDecorator extends CacheRepositoryDecorator implements ProductWithAttributeGroupRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * ProductWithAttributeGroupCacheDecorator constructor.
     * @param ProductWithAttributeGroupRepositoryEloquent $repository
     */
    public function __construct(ProductWithAttributeGroupRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}