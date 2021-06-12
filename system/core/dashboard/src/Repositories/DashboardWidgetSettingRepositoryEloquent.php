<?php

namespace Ocart\Dashboard\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Dashboard\Models\DashboardWidgetSetting;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class SettingRepositoryEloquent.
 *
 * @package namespace App\Repositories\Ocart\Setting;
 */
class DashboardWidgetSettingRepositoryEloquent extends RepositoriesAbstract implements DashboardWidgetSettingRepository
{

    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DashboardWidgetSetting::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
