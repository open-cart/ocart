<?php

namespace Ocart\Blog\Repositories;

use Ocart\Blog\Models\Post;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    protected $fieldSearchable = [
        'name' => 'like',
    ];

    /**
     * Specify Models class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    /**
     * @var \string[][]
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'content' => 'required',
            'slug' => [
                'required',
                'regex:/(^([0-9A-Za-z\-_]+)$)/',
                'string',
                'max:191'
            ],
//            'description.*.title'  => 'required|string|max:200',
//            'description.*.keyword'  => 'nullable|string|max:200',
//            'description.*.description'  => 'nullable|string|max:300'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'filled'
        ]
    ];

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
