<?php

namespace App\Criteria;

use App\Plugins\Blog\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MyCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class LanguageCriteriaCriteria implements CriteriaInterface
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
        $descriptionModel = $model->getModel()->language()->getModel();
        return $model->leftJoin($descriptionModel->getTable(), $descriptionModel->qualifyColumn('page_id'), $model->qualifyColumn('id'))
            ->where($descriptionModel->qualifyColumn('lang'), session('language', 'vi'));
    }
}
