<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\Attribute;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Ocart\Core\Supports\RepositoriesAbstract;

class AttributeRepositoryEloquent  extends RepositoriesAbstract implements AttributeRepository
{

    public function model()
    {
        return Attribute::class;
    }
}