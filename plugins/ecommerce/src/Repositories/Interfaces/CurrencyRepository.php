<?php
namespace Ocart\Ecommerce\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface CurrencyRepository extends RepositoryInterface, RepositoryCriteriaInterface
{

    public function updateIsDefault($is_default, $id);
}
