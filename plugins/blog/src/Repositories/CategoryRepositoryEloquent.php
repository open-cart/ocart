<?php

namespace Ocart\Blog\Repositories;

use Ocart\Blog\Models\Category;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Core\Supports\RepositoriesAbstract;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends RepositoriesAbstract implements CategoryRepository
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
     * {@inheritdoc}
     */
    public function getCategories(array $select, array $orderBy)
    {
        $data = $this->model->with('slugable')->select($select);
        foreach ($orderBy as $by => $direction) {
            $data = $data->orderBy($by, $direction);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
