<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\ProductWithAttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\ProductWithAttributeGroupRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class ProductWithAttributeGroupRepositoryEloquent  extends BaseRepository implements ProductWithAttributeGroupRepository
{

    public function model()
    {
        return ProductWithAttributeGroup::class;
    }
}