<?php

namespace Ocart\EcommerceReview\Repositories;

use App\Criteria\BeforeQueryCriteria;
use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\EcommerceReview\Models\Review;
use Prettus\Repository\Traits\CacheableRepository;

class ReviewRepositoryEloquent extends RepositoriesAbstract implements ReviewRepository
{
    use CacheableRepository;

    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [ProductRepository::class];

    /**
     * Specify Models class name
     *
     * @return string
     */
    public function model()
    {
        return Review::class;
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

}