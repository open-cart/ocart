<?php

namespace Ocart\Media\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Media\Models\MediaFolder;
use Ocart\Media\Repositories\Interfaces\MediaFolderRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class MediaFolderRepositoryEloquent extends RepositoriesAbstract implements MediaFolderRepository
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
        return MediaFolder::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
//        $this->pushCriteria(app(LanguageCriteriaCriteria::class));
        $this->pushCriteria(app(RequestCriteria::class));
//        $this->pushCriteria(app(BeforeQueryCriteria::class));
    }
}