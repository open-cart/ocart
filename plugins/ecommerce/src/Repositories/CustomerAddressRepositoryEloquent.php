<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Ecommerce\Models\CustomerAddress;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerAddressRepository;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CustomerAddressRepositoryEloquent extends BaseRepository implements CustomerAddressRepository
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
        return CustomerAddress::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }

}
