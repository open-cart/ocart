<?php

namespace Ocart\Menu\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Menu\Repositories\MenuNodeRepository;
use Ocart\Menu\Repositories\MenuNodeRepositoryEloquent;

/**
 * Class MenuNodeCacheDecorator
 * @package Ocart\Page\Repositories\Caches
 */
class MenuNodeCacheDecorator extends CacheRepositoryDecorator implements MenuNodeRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * MenuNodeCacheDecorator constructor.
     * @param MenuNodeRepositoryEloquent $repository
     */
    public function __construct(MenuNodeRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}