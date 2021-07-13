<?php
namespace Ocart\Blog\Repositories\Criteria;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class BlogSearchCriteria implements CriteriaInterface
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
     * @param Builder              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        /** @var Request $request */
        $request = $this->request;

        if ($request->get('name')) {
            $name = $request->get('name');
            $model = $model->where(function($q) use ($name){
                $q->orWhere('name', 'like', "%$name%");
                $q->orWhere('sku', 'like', "%$name%");
                $q->orWhere('description', 'like', "%$name%");
            });
        }

        if ($request->get('status')) {
            $model = $model->where('status', $request->get('status'));
        }

        if ($request->get('is_featured')) {
            $model = $model->where('is_featured', $request->get('is_featured'));
        }

        if ($request->get('order')) {

        } else {
            $model = $model->orderBy('id', 'desc');
        }

        return $model;
    }
}