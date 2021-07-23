<?php

namespace Ocart\Contact\Repositories\Caches;

use Ocart\Contact\Repositories\ContactRepositoryEloquent;
use Ocart\Contact\Repositories\Interfaces\ContactRepository;
use Ocart\Core\Supports\CacheRepositoryDecorator;
use Ocart\Payment\Repositories\PaymentRepositoryEloquent;

/**
 * Class ContactCacheDecorator
 * @package Ocart\Payment\Repositories\Caches
 */
class ContactCacheDecorator extends CacheRepositoryDecorator implements ContactRepository
{
    /**
     * Chỉ định tên tags mô hình liên quan để xóa cache khi có cập nhật.
     * @var string[]
     */
    public $tags = [];

    /**
     * ContactCacheDecorator constructor.
     * @param ContactRepositoryEloquent $repository
     */
    public function __construct(ContactRepositoryEloquent $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @inheritDoc
     */
    public function getUnread($select = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function countUnread()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}