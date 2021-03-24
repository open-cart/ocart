<?php

namespace Ocart\Acl\Repositories;

use App\Criteria\BeforeQueryCriteria;
use App\Criteria\LanguageCriteriaCriteria;
use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
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
        return User::class;
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
