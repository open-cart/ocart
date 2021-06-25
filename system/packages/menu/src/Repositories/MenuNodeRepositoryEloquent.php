<?php

namespace Ocart\Menu\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Menu\Models\MenuNode;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MenuNodeRepositoryEloquent extends RepositoriesAbstract implements MenuNodeRepository
{
    protected $fieldSearchable = [
        'alias' => 'like',
    ];

    /**
     * Specify Models class name
     *
     * @return string
     */
    public function model()
    {
        return MenuNode::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }

}
