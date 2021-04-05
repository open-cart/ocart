<?php

namespace Ocart\Payment\Repositories;

use Ocart\Payment\Models\Payment;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentRepositoryEloquent extends BaseRepository implements PaymentRepository
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
