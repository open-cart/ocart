<?php

namespace App\Plugins\Blog\Repositories;

use App\Criteria\LanguageCriteriaCriteria;
use App\Plugins\Blog\Models\Page;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PageRepositoryEloquent extends BaseRepository implements PageRepository
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
        return Page::class;
    }

    /**
     * @var \string[][]
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'alias' => [
                'required',
                'regex:/(^([0-9A-Za-z\-_]+)$)/',
                'string',
                'max:100'
            ],
            'description.*.title'  => 'required|string|max:200',
            'description.*.keyword'  => 'nullable|string|max:200',
            'description.*.description'  => 'nullable|string|max:300'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'alias' => 'required'
        ]
    ];

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(LanguageCriteriaCriteria::class));
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
