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
}
