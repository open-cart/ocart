<?php

namespace Ocart\Dashboard\Repositories;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface DashboardWidgetRepository extends RepositoryInterface, CacheableInterface, RepositoryCriteriaInterface
{

}