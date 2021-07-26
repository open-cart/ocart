<?php

namespace Ocart\Blog\Repositories\Caches;

use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Blog\Repositories\PostRepositoryEloquent;
use Ocart\Core\Supports\CacheRepositoryDecorator;

/**
 * Class PostCacheDecorator
 * @package Ocart\Blog\Repositories\Caches
 */
class PostCacheDecorator extends CacheRepositoryDecorator implements PostRepository
{
    /**
     * @inheritDoc
     */
    public function __construct(PostRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @inheritDoc
     */
    public function postForCategory($categoryId, $paginate = 9)
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
    public function getFeature($limit)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}