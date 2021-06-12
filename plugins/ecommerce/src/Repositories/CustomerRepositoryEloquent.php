<?php

namespace Ocart\Ecommerce\Repositories;

use App\Models\User;
use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CustomerRepositoryEloquent extends RepositoriesAbstract implements CustomerRepository
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
