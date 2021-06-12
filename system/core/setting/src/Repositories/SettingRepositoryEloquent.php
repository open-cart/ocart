<?php

namespace Ocart\Setting\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Setting\Setting;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class SettingRepositoryEloquent.
 *
 * @package namespace App\Repositories\Ocart\Setting;
 */
class SettingRepositoryEloquent extends RepositoriesAbstract implements SettingRepository
{

    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Setting::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
