<?php
namespace Ocart\Ecommerce\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface CategoryRepository extends RepositoryInterface, RepositoryCriteriaInterface
{

    /**
     * All category is featured
     *
     * @return mixed
     */
    public function getFeature();
}
