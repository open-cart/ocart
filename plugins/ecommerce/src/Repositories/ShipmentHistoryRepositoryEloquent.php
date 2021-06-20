<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Ecommerce\Models\Brand;
use Ocart\Ecommerce\Models\ShipmentHistory;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShipmentHistoryRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ShipmentHistoryRepositoryEloquent extends RepositoriesAbstract implements ShipmentHistoryRepository
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
        return ShipmentHistory::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
//        $this->pushCriteria(app(LanguageCriteriaCriteria::class));
        $this->pushCriteria(app(RequestCriteria::class));
//        $this->pushCriteria(app(BeforeQueryCriteria::class));
    }

}
