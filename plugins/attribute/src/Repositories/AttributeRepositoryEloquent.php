<?php
namespace Ocart\Attribute\Repositories;

use Ocart\Attribute\Models\Attribute;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class AttributeRepositoryEloquent  extends BaseRepository implements AttributeRepository
{

    public function model()
    {
        return Attribute::class;
    }
}