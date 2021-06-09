<?php
namespace Ocart\Attribute\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class IsVariationCriteria  implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('is_variation', 0);
    }
}