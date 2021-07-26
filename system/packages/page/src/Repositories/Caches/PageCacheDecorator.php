<?php

namespace Ocart\Page\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Page\Repositories\PageRepositoryEloquent;

/**
 * Class PageCacheDecorator
 * @package Ocart\Page\Repositories\Caches
 */
class PageCacheDecorator extends CacheRepositoryDecorator implements PageRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * PageCacheDecorator constructor.
     * @param PageRepositoryEloquent $repository
     */
    public function __construct(PageRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}