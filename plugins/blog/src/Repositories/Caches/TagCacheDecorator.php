<?php

namespace Ocart\Blog\Repositories\Caches;

use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Blog\Repositories\Interfaces\TagRepository;
use Ocart\Blog\Repositories\TagRepositoryEloquent;
use Ocart\Core\Supports\CacheRepositoryDecorator;

/**
 * Class TagCacheDecorator
 * @package Ocart\Blog\Repositories\Caches
 */
class TagCacheDecorator extends CacheRepositoryDecorator implements TagRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [PostRepository::class];

    public function __construct(TagRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}