<?php

namespace App\Repositories;

use App\Models\Language;
use Ocart\Core\Supports\RepositoriesAbstract;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class LanguageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LanguageRepositoryEloquent extends RepositoriesAbstract implements LanguageRepository
{
    /**
     * @var
     */
    protected static $_listActive;

    /**
     * @var
     */
    protected static $_listCodeActive;

    /**
     * Specify Models class name
     *
     * @return string
     */
    public function model()
    {
        return Language::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    function getListActive()
    {
        if (self::$_listActive === null) {
            self::$_listActive = $this->findByField('status', 1)
                ->keyBy('code');
        }
        return self::$_listActive;
    }

    function getCodeActive()
    {
        if (self::$_listCodeActive === null) {
            self::$_listCodeActive = $this->findByField('status', 1)
                ->pluck('name', 'code')
                ->all();
        }
        return self::$_listCodeActive;
    }
}
