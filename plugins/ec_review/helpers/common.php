<?php
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\EcommerceReview\Repositories\ReviewRepository;

if (!function_exists('check_if_reviewed_product')) {
    /**
     * @param int $productId
     * @param int|null $customerId
     * @return bool
     */
    function check_if_reviewed_product($productId, $customerId = null)
    {
        if ($customerId == null && auth()->check()) {
            $customerId = auth()->user()->getAuthIdentifier();
        }

        $existed = app(ReviewRepository::class)->count([
            'customer_id' => $customerId,
            'product_id'  => $productId,
        ]);

        return $existed > 0;
    }
}

if (!function_exists('get_count_reviewed_of_product')) {
    /**
     * @param int $productId
     * @return mixed
     */
    function get_count_reviewed_of_product($productId)
    {
        return app(ReviewRepository::class)->count([
            'product_id' => $productId,
            'status'     => BaseStatusEnum::PUBLISHED,
        ]);
    }
}

if (!function_exists('get_average_star_of_product')) {
    /**
     * @param int $productId
     * @return mixed
     */
    function get_average_star_of_product($productId)
    {
        $avg = (float)app(ReviewRepository::class)->getModel()
            ->where('product_id', $productId)
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->avg('star');

        return number_format($avg, 2);
    }
}
