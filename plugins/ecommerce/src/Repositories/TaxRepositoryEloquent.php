<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Ecommerce\Models\Tax;
use Ocart\Ecommerce\Repositories\Interfaces\TaxRepository;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class TaxRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TaxRepositoryEloquent extends RepositoriesAbstract implements TaxRepository
{
    use CacheableRepository;

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
        return Tax::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
//        $this->pushCriteria(app(LanguageCriteriaCriteria::class));
//        $this->pushCriteria(app(RequestCriteria::class));
//        $this->pushCriteria(app(BeforeQueryCriteria::class));
    }

}
