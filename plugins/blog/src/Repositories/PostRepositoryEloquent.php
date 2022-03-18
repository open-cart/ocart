<?php

namespace Ocart\Blog\Repositories;

use Ocart\Blog\Models\Post;
use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Core\Supports\RepositoriesAbstract;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PostRepositoryEloquent extends RepositoriesAbstract implements PostRepository
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


    public function postForCategory($categoryId, $paginate = 9)
    {
        $this->whereHas('categories', function ($query) use ($categoryId) {
            return $query->where($query->qualifyColumn('id'), $categoryId);
        });
        $results = $this->paginate($paginate);

        return $this->parserResult($results);
    }

    public function postForTag($tagId, $paginate = 9)
    {
        $this->whereHas('tags', function ($query) use ($tagId) {
            return $query->where($query->qualifyColumn('id'), $tagId);
        });
        $results = $this->paginate($paginate);

        return $this->parserResult($results);
    }

    public function getFeature($limit)
    {
        $this->applyConditions([
            'is_featured' => 1
        ]);
        $results = $this->orderBy('updated_at', 'desc')->limit($limit);

        return $this->parserResult($results);
    }

    public function getFeaturePaginate($limit = 8, $columns = ['*'])
    {
        $this->applyConditions([
            'is_featured' => 1
        ]);
        $results = $this->orderBy('updated_at', 'desc')->paginate($limit, $columns);

        return $this->parserResult($results);
    }

    public function getFeatureFormatType($type, $limit)
    {
        $this->applyConditions([
            'is_featured' => 1,
            'format_type' => $type
        ]);
        $results = $this->orderBy('updated_at', 'desc')->limit($limit);

        return $this->parserResult($results);
    }

    public function getRelate($categoryId, $limit)
    {
        $this->whereHas('categories', function ($query) use ($categoryId) {
            return $query->where($query->qualifyColumn('id'), $categoryId);
        });
        $this->applyConditions([
            'is_featured' => 1
        ]);
        $results = $this->orderBy('updated_at', 'desc')->limit($limit);

        return $this->parserResult($results);
    }
}
