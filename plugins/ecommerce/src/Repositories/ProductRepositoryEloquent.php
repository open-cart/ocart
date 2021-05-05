<?php

namespace Ocart\Ecommerce\Repositories;

use Ocart\Ecommerce\Models\Product;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
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
        return Product::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
//        $this->pushCriteria(app(LanguageCriteriaCriteria::class));
//        $this->pushCriteria(app(RequestCriteria::class));
//        $this->pushCriteria(app(BeforeQueryCriteria::class));
    }

    public function productForCategory($categoryId, $paginate = 9)
    {
        $this->whereHas('categories', function ($query) use ($categoryId) {
            return $query->where($query->qualifyColumn('id'), $categoryId);
        });

        $results = $this->paginate($paginate);

        return $this->parserResult($results);
    }

    public function getFeature($limit)
    {
        $this->applyConditions([
            'is_featured' => 1
        ]);
        $results = $this->limit($limit);

        return $this->parserResult($results);
    }

    public function getRelate($categoryId, $limit)
    {
        $this->whereHas('categories', function ($query) use ($categoryId) {
            return $query->where($query->qualifyColumn('id'), $categoryId);
        });
        $results = $this->limit($limit);

        return $this->parserResult($results);
    }
}
