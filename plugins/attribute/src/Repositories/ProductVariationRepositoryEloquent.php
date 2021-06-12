<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\ProductVariation;
use Ocart\Attribute\Repositories\Interfaces\ProductVariationRepository;
use Ocart\Core\Supports\RepositoriesAbstract;

class ProductVariationRepositoryEloquent  extends RepositoriesAbstract implements ProductVariationRepository
{

    public function model()
    {
        return ProductVariation::class;
    }
}