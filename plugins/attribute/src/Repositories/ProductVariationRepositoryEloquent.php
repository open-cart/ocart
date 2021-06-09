<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\ProductVariation;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class ProductVariationRepositoryEloquent  extends BaseRepository implements ProductVariationRepository
{

    public function model()
    {
        return ProductVariation::class;
    }
}