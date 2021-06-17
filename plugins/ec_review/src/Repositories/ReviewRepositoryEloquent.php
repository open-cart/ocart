<?php

namespace Ocart\EcommerceReview\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\EcommerceReview\Models\Review;

class ReviewRepositoryEloquent extends RepositoriesAbstract implements ReviewRepository
{
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
//        $this->pushCriteria(app(BeforeQueryCriteria::class));
    }

}