<?php

namespace Ocart\Media\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Media\Repositories\Interfaces\MediaFileRepository;
use Ocart\Media\Repositories\MediaFileRepositoryEloquent;

/**
 * Class MediaFileCacheDecorator
 * @package Ocart\Menu\Repositories\Caches
 */
class MediaFileCacheDecorator extends CacheRepositoryDecorator implements MediaFileRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * MediaFileCacheDecorator constructor.
     * @param MediaFileRepositoryEloquent $repository
     */
    public function __construct(MediaFileRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @inheritDoc
     */
    public function createName($name, $folder)
    {
        return $this->repository->createName($name, $folder);
    }
}