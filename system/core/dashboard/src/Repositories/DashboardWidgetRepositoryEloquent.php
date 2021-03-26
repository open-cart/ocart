<?php

namespace Ocart\Dashboard\Repositories;

use Ocart\Dashboard\Models\DashboardWidget;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class SettingRepositoryEloquent.
 *
 * @package namespace App\Repositories\Ocart\Setting;
 */
class DashboardWidgetRepositoryEloquent extends BaseRepository implements DashboardWidgetRepository
{

    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DashboardWidget::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
