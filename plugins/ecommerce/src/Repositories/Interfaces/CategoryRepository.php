<?php
namespace Ocart\Ecommerce\Repositories\Interfaces;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface CategoryRepository extends RepositoryInterface, RepositoryCriteriaInterface, CacheableInterface
{

    /**
     * @return mixed
     */
    public function getFeature();
}
