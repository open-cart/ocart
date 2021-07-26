<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\CurrencyRepositoryEloquent;
use Ocart\Ecommerce\Repositories\Interfaces\CurrencyRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

/**
 * Class CategoryCacheDecorator
 * @package Ocart\Blog\Repositories\Caches
 */
class CurrencyCacheDecorator extends CacheRepositoryDecorator implements CurrencyRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [ProductRepository::class];

    public function __construct(CurrencyRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @inheritDoc
     */
    public function updateIsDefault($is_default, $id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}