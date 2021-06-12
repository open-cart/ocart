<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Ocart\Core\Supports\RepositoriesAbstract;

class AttributeGroupRepositoryEloquent  extends RepositoriesAbstract implements AttributeGroupRepository
{

    public function model()
    {
        return AttributeGroup::class;
    }
}