<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Ecommerce\Models\CustomerAddress;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerAddressRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CustomerAddressRepositoryEloquent extends RepositoriesAbstract implements CustomerAddressRepository
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
