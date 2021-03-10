<?php

namespace Ocart\Media\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface MediaFileRepository extends RepositoryInterface, RepositoryCriteriaInterface
{

    public function createSlug($name = null, $a, $b);
}