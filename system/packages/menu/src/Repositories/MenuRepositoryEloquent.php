<?php

namespace Ocart\Menu\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Menu\Models\Menu;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MenuRepositoryEloquent extends RepositoriesAbstract implements MenuRepository
{
    use CacheableRepository;

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
        return Menu::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }

}
