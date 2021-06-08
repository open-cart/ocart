<?php

namespace Ocart\Ecommerce\Repositories;

use App\Models\User;
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
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }

}
