<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class AttributeGroupRepositoryEloquent  extends BaseRepository implements AttributeGroupRepository
{

    public function model()
    {
        return AttributeGroup::class;
    }
}