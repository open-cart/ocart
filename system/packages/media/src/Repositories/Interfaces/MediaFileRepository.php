<?php

namespace Ocart\Media\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface MediaFileRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    /**
     * @param $name
     * @param $folder
     * @return mixed
     */
    public function createName($name, $folder);
}
