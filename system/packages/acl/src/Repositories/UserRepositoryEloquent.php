<?php

namespace Ocart\Acl\Repositories;

use App\Models\Admin;
use Ocart\Core\Supports\RepositoriesAbstract;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends RepositoriesAbstract implements UserRepository
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
        return Admin::class;
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
