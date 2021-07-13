<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Ecommerce\Models\Currency;
use Ocart\Ecommerce\Repositories\Interfaces\CurrencyRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CurrencyRepositoryEloquent extends RepositoriesAbstract implements CurrencyRepository
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
        return Currency::class;
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

    public function updateIsDefault($is_default, $id)
    {
        if ($is_default != 1) {
            return;
        }

        Currency::where('is_default', 1)->update(['is_default' => 0]);

        $this->applyConditions([
            'id' => $id
        ]);
        $model = $this->model->first();
        $model->is_default = 1;
        $model->save();
    }
}
