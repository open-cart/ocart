<?php

namespace Ocart\Payment\Repositories\Criteria;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MyCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class PaymentSearchCriteria implements CriteriaInterface
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

        if ($request->get('submit') == 'search') {
            if ($request->get('name')) {
                $name = $request->get('name');
                $model = $model->where(function($q) use ($name){
                    $q->orWhere('charge_id', 'like', "%$name%");
                });
            }
            if ($request->get('status')) {
                $name = $request->get('status');
                $model = $model->where('status', $name);
            }
            if ($request->get('payment_channel')) {
                $name = $request->get('payment_channel');
                $model = $model->where('payment_channel', $name);
            }
        }

        if ($request->get('order')) {

        } else {
            $model = $model->orderBy('id', 'desc');
        }

        return $model;
    }
}
