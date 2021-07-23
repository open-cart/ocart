<?php

namespace Ocart\Menu\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Menu\Repositories\MenuRepository;
use Ocart\Menu\Repositories\MenuRepositoryEloquent;

/**
 * Class MenuCacheDecorator
 * @package Ocart\Page\Repositories\Caches
 */
class MenuCacheDecorator extends CacheRepositoryDecorator implements MenuRepository
{

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * MenuCacheDecorator constructor.
     * @param MenuRepositoryEloquent $repository
     */
    public function __construct(MenuRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}