<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\BrandRepositoryEloquent;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

/**
 * Class BrandCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class BrandCacheDecorator extends CacheRepositoryDecorator implements BrandRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [ProductRepository::class];

    public function __construct(BrandRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}