<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\ProductVariationItem;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationItemRepository;
use Ocart\Core\Supports\RepositoriesAbstract;

class ProductVariationItemRepositoryEloquent  extends RepositoriesAbstract implements ProductVariationItemRepository
{

    public function model()
    {
        return ProductVariationItem::class;
    }
}