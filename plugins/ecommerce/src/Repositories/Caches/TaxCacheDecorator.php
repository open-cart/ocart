<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\TaxRepository;
use Ocart\Ecommerce\Repositories\TaxRepositoryEloquent;

/**
 * Class TaxCacheDecorator
 * @package Ocart\Ecommerce\Repositories\Caches
 */
class TaxCacheDecorator extends CacheRepositoryDecorator implements TaxRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [ProductRepository::class];

    /**
     * TaxCacheDecorator constructor.
     * @param TaxRepositoryEloquent $repository
     */
    public function __construct(TaxRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}