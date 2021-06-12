<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Ecommerce\Models\Order;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends RepositoriesAbstract implements OrderRepository
{
    protected $fieldSearchable = [
        'alias' => 'like',
    ];

    /**
     * Specify Models class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }

}
