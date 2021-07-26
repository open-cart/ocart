<?php

namespace Ocart\Attribute\Repositories\Caches;

use Ocart\Attribute\Repositories\AttributeGroupRepositoryEloquent;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Ocart\Core\Supports\CacheRepositoryDecorator;

/**
 * Class AttributeGroupCacheDecorator
 * @package Ocart\Attribute\Repositories\Caches
 */
class AttributeGroupCacheDecorator extends CacheRepositoryDecorator implements AttributeGroupRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * AttributeGroupCacheDecorator constructor.
     * @param AttributeGroupRepositoryEloquent $repository
     */
    public function __construct(AttributeGroupRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}