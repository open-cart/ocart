<?php
namespace Ocart\Contact\Repositories\Interfaces;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface ContactRepository extends RepositoryInterface, RepositoryCriteriaInterface, CacheableInterface
{
    /**
     * @param array $select
     * @return mixed
     */
    public function getUnread($select = ['*']);

    /**
     * @return int
     */
    public function countUnread();
}
