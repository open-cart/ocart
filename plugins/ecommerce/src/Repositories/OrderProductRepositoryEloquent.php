<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Ecommerce\Models\OrderProduct;
use Ocart\Ecommerce\Repositories\Interfaces\OrderProductRepository;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderProductRepositoryEloquent extends BaseRepository implements OrderProductRepository
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
        return OrderProduct::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }

}
