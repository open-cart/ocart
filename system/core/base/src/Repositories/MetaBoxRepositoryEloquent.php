<?php

namespace System\Core\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use System\Core\Models\MetaBox;

/**
 * Class MetaBoxRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MetaBoxRepositoryEloquent extends BaseRepository implements MetaBoxRepository
{
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
