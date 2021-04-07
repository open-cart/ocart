<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Ecommerce\Models\OrderAddress;
use Ocart\Ecommerce\Repositories\Interfaces\OrderAddressRepository;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderAddressRepositoryEloquent extends BaseRepository implements OrderAddressRepository
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
        return OrderAddress::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }

}
