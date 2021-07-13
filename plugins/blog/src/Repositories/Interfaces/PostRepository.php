<?php

namespace Ocart\Blog\Repositories\Interfaces;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PageRepository.
 *
 * @package namespace App\Repositories;
 */
interface PostRepository extends RepositoryInterface, RepositoryCriteriaInterface, CacheableInterface
{
    //
}
