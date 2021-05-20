<?php

namespace Ocart\Acl\Repositories\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MyCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class UserSearchCriteria implements CriteriaInterface
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
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
        /** @var Request $request */
        $request = $this->request;

        if ($request->get('submit') == 'search') {
            if ($request->get('name')) {
                $name = $request->get('name');
                $model = $model->where(function($q) use ($name){
                    $q->orWhere('name', 'like', "%$name%");
                    $q->orWhere('email', 'like', "%$name%");
                });
            }
        }

        return $model;
    }
}
