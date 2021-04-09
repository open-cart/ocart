<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Ecommerce\Models\Customer;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerRepository;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CustomerRepositoryEloquent extends BaseRepository implements CustomerRepository
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
        return Customer::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }

}
