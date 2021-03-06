<?php

namespace Ocart\Core\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Prettus\Repository\Criteria\RequestCriteria;
use Ocart\Core\Models\MetaBox;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class MetaBoxRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MetaBoxRepositoryEloquent extends RepositoriesAbstract implements MetaBoxRepository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MetaBox::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
