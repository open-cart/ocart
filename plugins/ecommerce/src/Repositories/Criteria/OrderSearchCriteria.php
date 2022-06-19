<?php
namespace Ocart\Ecommerce\Repositories\Criteria;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class OrderSearchCriteria implements CriteriaInterface
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

        if ($request->get('query')) {
            $name = $request->get('query');
            $model = $model->where(function($q) use ($name){
                $q->orWhere('id', get_order_id($name));
                $q->orWhereHas('user', function ($q) use ($name) {
                    $q->where('name', 'like', '%' . $name .'%');
                });
                $q->orWhereHas('address', function ($q) use ($name) {
                    $q->orWhere('name', 'like', '%' . $name .'%');
                    $q->orWhere('phone', 'like', '%' . $name .'%');
                    $q->orWhere('email', 'like', '%' . $name .'%');
                });
            });
        }

        if ($request->get('status')) {
            $model = $model->where('status', $request->get('status'));
        }

        $model = $model->where('id', '>', '1');

        if ($request->get('order')) {

        } else {
            $model = $model->orderBy('id', 'desc');
        }

        return $model;
    }
}
