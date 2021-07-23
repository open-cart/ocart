<?php

namespace Ocart\Ecommerce\Repositories;

use App\Criteria\BeforeQueryCriteria;
use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Hashids\Hashids;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductRepositoryEloquent extends RepositoriesAbstract implements ProductRepository
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
        return Product::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
//        $this->pushCriteria(app(LanguageCriteriaCriteria::class));
//        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(app(BeforeQueryCriteria::class));
    }

    public function createSku(): string
    {
        $num = setting('increment_sku', 1);

        setting()->set('increment_sku', $num + 1)->save();

        $sku = 'SP_' . str_pad($num, 6, '0', STR_PAD_LEFT);

        $query = $this->makeModel();

        $count = $query->where('sku', $sku)->count();

        if ($count) {
            $hashids = new Hashids('increment_sku', 8, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');

            return $hashids->encode($num);
        }

        return $sku;
    }

    public function productForCategory($categoryId, $paginate = 9)
    {
        $this->applyConditions([
            'is_variation' => 0
        ]);
        $this->whereHas('categories', function ($query) use ($categoryId) {
            return $query->where($query->qualifyColumn('id'), $categoryId);
        });

        return $this->paginate($paginate);
    }

    public function getFeature($limit)
    {
        $this->applyConditions([
            'is_featured' => 1,
            'is_variation' => 0
        ]);
        return $this->with('categories')
            ->take($limit)
            ->all(['*'], $limit);
    }

    public function getNews($limit)
    {
        $this->applyConditions([
            'is_variation' => 0
        ]);

        return $this->with('categories')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->all(['*'], $limit);
    }

    public function getRelate($categoryId, $limit)
    {
        $this->applyConditions([
            'is_variation' => 0
        ]);
        $this->whereHas('categories', function ($query) use ($categoryId) {
            return $query->where($query->qualifyColumn('id'), $categoryId);
        });

        $this->with('categories')->take($limit);

        return $this->all(['*'], $categoryId, $limit);
    }

    public function getFeatureCategory($categoryId, $limit)
    {
        $this->applyConditions([
            'is_featured' => 1,
            'is_variation' => 0
        ]);
        $this->whereHas('categories', function ($query) use ($categoryId) {
            return $query->where($query->qualifyColumn('id'), $categoryId);
        });
        $this->orderBy('created_at', 'desc');
        $this->take($limit);
        return $this->with('categories')->all(['*'], [$categoryId, $limit]);
    }
}
