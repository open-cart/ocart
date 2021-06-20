<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Ecommerce\Models\OrderHistory;
use Ocart\Ecommerce\Repositories\Interfaces\OrderHistoryRepository;

/**
 * Class HistoryRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class OrderHistoryRepositoryEloquent extends RepositoriesAbstract implements OrderHistoryRepository
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
        return OrderHistory::class;
    }
}
