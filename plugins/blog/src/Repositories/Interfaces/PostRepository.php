<?php

namespace Ocart\Blog\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PageRepository.
 *
 * @package namespace App\Repositories;
 */
interface PostRepository extends RepositoryInterface, RepositoryCriteriaInterface
{

    /**
     * Lấy danh sách bài viết thuộc danh mục
     *
     * @param $categoryId
     * @param int $paginate
     * @return mixed
     */
    public function postForCategory($categoryId, $paginate = 9);

    /**
     * Lấy danh sách bài viết liên quan
     *
     * @param $categoryId
     * @param $limit
     * @return mixed
     */
    public function getRelate($categoryId, $limit);

    /**
     * Lấy danh sách bài viết hot
     *
     * @param $limit
     * @return mixed
     */
    public function getFeature($limit);
}
