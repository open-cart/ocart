<?php

namespace Ocart\Ecommerce\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PageRepository.
 *
 * @package namespace App\Repositories;
 */
interface ProductRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    /**
     * Tạo ra 1 sku không trùng lặp cho sản phẩm
     * @return string
     */
    public function createSku(): string;

    /**
     * Lấy danh sách sản phẩm theo danh mục
     *
     * @param $categoryId
     * @param int $paginate
     * @return mixed
     */
    public function productForCategory($categoryId, $paginate = 9);

    /**
     * Lấy danh sách sản phẩm hot
     *
     * @param $limit
     * @return mixed
     */
    public function getFeature($limit);

    /**
     * Lấy danh sách sản phẩm mới
     *
     * @param $limit
     * @return mixed
     */
    public function getNews($limit);

    /**
     * Lấy danh sách sản phẩm liên quan
     *
     * @param $categoryId
     * @param $limit
     * @return mixed
     */
    public function getRelate($categoryId, $limit);

    /**
     * Lấy danh sách sản phẩm hot theo danh mục
     *
     * @param $categoryId
     * @param $limit
     * @return mixed
     */
    public function getFeatureCategory($categoryId, $limit);
}
