<?php

namespace Ocart\Media\Repositories;

use Ocart\Core\Supports\RepositoriesAbstract;
use Ocart\Media\Models\MediaFile;
use Ocart\Media\Repositories\Interfaces\MediaFileRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class MediaFileRepositoryEloquent extends RepositoriesAbstract implements MediaFileRepository
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
        return MediaFile::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
//        $this->pushCriteria(app(LanguageCriteriaCriteria::class));
//        $this->pushCriteria(app(RequestCriteria::class));
//        $this->pushCriteria(app(BeforeQueryCriteria::class));
    }

    public function createName($name, $folder)
    {
        $index = 1;
        $baseName = $name;
        while ($this->checkIfExistsName($name, $folder)) {
            $name = $baseName . '-' . $index++;
        }
        return $name;
    }

    /**
     * {@inheritDoc}
     */
    protected function checkIfExistsName($name, $folder)
    {
        $count = $this->model
            ->where('name', $name)
            ->where('folder_id', $folder)
            ->withTrashed()
            ->count();

        return $count > 0;
    }
}
