<?php

namespace Ocart\Attribute\Repositories\Caches;

use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Attribute\Repositories\ProductVariationRepositoryEloquent;
use Ocart\Core\Supports\CacheRepositoryDecorator;

/**
 * Class ProductVariationCacheDecorator
 * @package Ocart\Attribute\Repositories\Caches
 */
class ProductVariationCacheDecorator extends CacheRepositoryDecorator implements ProductVariationRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * ProductVariationCacheDecorator constructor.
     * @param ProductVariationRepositoryEloquent $repository
     */
    public function __construct(ProductVariationRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}