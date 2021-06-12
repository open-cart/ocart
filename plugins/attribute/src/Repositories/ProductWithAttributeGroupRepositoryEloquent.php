<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\ProductWithAttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Ocart\Core\Supports\RepositoriesAbstract;

class ProductWithAttributeGroupRepositoryEloquent  extends RepositoriesAbstract implements ProductWithAttributeGroupRepository
{

    public function model()
    {
        return ProductWithAttributeGroup::class;
    }
}