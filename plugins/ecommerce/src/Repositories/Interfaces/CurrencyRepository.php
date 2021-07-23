<?php
namespace Ocart\Ecommerce\Repositories\Interfaces;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface CurrencyRepository extends RepositoryInterface, RepositoryCriteriaInterface, CacheableInterface
{

    /**
     * Update currency default
     *
     * @param $is_default
     * @param $id
     * @return mixed
     */
    public function updateIsDefault($is_default, $id);
}
