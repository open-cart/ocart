<?php

namespace Ocart\Payment\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Payment\Models\Payment;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentRepositoryEloquent extends RepositoriesAbstract implements PaymentRepository
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
        return Payment::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {

    }

}
