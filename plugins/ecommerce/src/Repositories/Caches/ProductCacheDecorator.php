<?php

namespace Ocart\Ecommerce\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Repositories\ProductRepositoryEloquent;

/**
 * Class CategoryCacheDecorator
 * @package Ocart\Blog\Repositories\Caches
 */
class ProductCacheDecorator extends CacheRepositoryDecorator implements ProductRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * ProductCacheDecorator constructor.
     * @param ProductRepositoryEloquent $repository
     */
    public function __construct(ProductRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @inheritDoc
     */
    public function createSku(): string
    {
        return $this->repository->createSku();
    }

    /**
     * @inheritDoc
     */
    public function productForCategory($categoryId, $paginate = 9)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function getFeature($limit)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function getNews($limit)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function getRelate($categoryId, $limit)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function getFeatureCategory($categoryId, $limit)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}