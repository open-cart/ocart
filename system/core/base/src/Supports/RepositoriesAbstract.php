<?php

namespace Ocart\Core\Supports;

use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class RepositoriesAbstract extends BaseRepository
{
    protected static $booted = [];

    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    /**
     * Push Criteria for filter the query
     *
     * @param $criteria
     *
     * @return $this
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function pushCriteria($criteria)
    {
        if (is_string($criteria)) {
            $criteria = app($criteria);
        }

        return parent::pushCriteria($criteria);
    }
}