<?php

namespace App\Plugins\Blog\Repositories;

use App\Plugins\Blog\Models\PageDescription;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PageDescriptionRepositoryEloquent extends BaseRepository implements PageDescriptionRepository
{
    /**
     * @var \string[][]
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required',
//            'text'  => 'min:3',
//            'author'=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required'
        ]
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PageDescription::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
