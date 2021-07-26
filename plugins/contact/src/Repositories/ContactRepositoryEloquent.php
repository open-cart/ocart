<?php

namespace Ocart\Contact\Repositories;

use Ocart\Contact\Enums\ContactStatusEnum;
use Ocart\Contact\Models\Contact;
use Ocart\Contact\Repositories\Interfaces\ContactRepository;
use Ocart\Core\Supports\RepositoriesAbstract;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactRepositoryEloquent extends RepositoriesAbstract implements ContactRepository
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
        return Contact::class;
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

    public function getUnread($select = ['*'])
    {
        return $this->orderBy('id', 'desc')
            ->findWhere(['status' => ContactStatusEnum::UNREAD]);
    }

    public function countUnread()
    {
        return $this->count(['status' => ContactStatusEnum::UNREAD]);
    }
}
