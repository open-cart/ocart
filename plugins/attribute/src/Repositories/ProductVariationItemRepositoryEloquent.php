<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\ProductVariationItem;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationItemRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class ProductVariationItemRepositoryEloquent  extends BaseRepository implements ProductVariationItemRepository
{

    public function model()
    {
        return ProductVariationItem::class;
    }
}