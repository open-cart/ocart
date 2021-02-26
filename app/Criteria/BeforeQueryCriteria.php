<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class BeforeQueryCriteria.
 *
 * @package namespace App\Criteria;
 */
class BeforeQueryCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return apply_filters(BEFORE_QUERY_CRITERIA, $model, $model->getModel());
    }
}
