<?php

namespace Ocart\Attribute\Repositories\Caches;

use Ocart\Attribute\Repositories\AttributeRepositoryEloquent;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Ocart\Core\Supports\CacheRepositoryDecorator;

/**
 * Class AttributeCacheDecorator
 * @package Ocart\Attribute\Repositories\Caches
 */
class AttributeCacheDecorator extends CacheRepositoryDecorator implements AttributeRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * AttributeCacheDecorator constructor.
     * @param AttributeRepositoryEloquent $repository
     */
    public function __construct(AttributeRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}