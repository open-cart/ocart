<?php

namespace Ocart\Payment\Repositories\Caches;

use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Payment\Repositories\PaymentRepository;
use Ocart\Payment\Repositories\PaymentRepositoryEloquent;

/**
 * Class PaymentCacheDecorator
 * @package Ocart\Blog\Repositories\Caches
 */
class PaymentCacheDecorator extends CacheRepositoryDecorator implements PaymentRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * PaymentCacheDecorator constructor.
     * @param PaymentRepositoryEloquent $repository
     */
    public function __construct(PaymentRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }
}