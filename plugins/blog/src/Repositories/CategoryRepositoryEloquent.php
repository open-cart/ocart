<?php

namespace Ocart\Blog\Repositories;

use Ocart\Blog\Models\Category;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Core\Supports\RepositoriesAbstract;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends RepositoriesAbstract implements CategoryRepository
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
        return Category::class;
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


    /**
     * @inheritDoc
     */
    public function getFeature($limit = 9)
    {
        $this->applyConditions([
            'is_featured' => 1
        ]);

        $results = $this->limit($limit);

        return $this->parserResult($results);
    }
}
