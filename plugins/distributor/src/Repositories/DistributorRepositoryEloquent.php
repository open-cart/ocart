<?php

namespace Ocart\Distributor\Repositories;
use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Distributor\Models\Distributor;
use Ocart\Distributor\Repositories\Interfaces\DistributorRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DistributorRepositoryEloquent extends RepositoriesAbstract implements DistributorRepository
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
        return Distributor::class;
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
