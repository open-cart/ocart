<?php

namespace Ocart\Core\Supports;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Exception;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Helpers\CacheKeys;
use ReflectionObject;


class CacheRepositoryDecorator implements RepositoryInterface
{
    /**
     * @var CacheRepository
     */
    protected $cacheRepository = null;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var bool
     */
    protected $cacheSkip = false;

    /**
     * @var array
     */
    protected $tags = [];

    /**
     * CacheDecorator constructor.
     * @param RepositoryInterface $repository
     * @param string|null $cacheGroup
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Set Cache Repository
     *
     * @param CacheRepository $repository
     *
     * @return $this
     */
    public function setCacheRepository(CacheRepository $repository)
    {
        $this->cacheRepository = $repository;

        return $this;
    }

    /**
     * Return instance of Cache Repository
     *
     * @return CacheRepository
     */
    public function getCacheRepository()
    {
        if (is_null($this->cacheRepository)) {
            $this->cacheRepository = app(config('repository.cache.repository', 'cache'));
        }

        return $this->cacheRepository;
    }

    /**
     * Skip Cache
     *
     * @param bool $status
     *
     * @return $this
     */
    public function skipCache($status = true)
    {
        $this->cacheSkip = $status;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSkippedCache()
    {
        $skipped = isset($this->cacheSkip) ? $this->cacheSkip : false;
        $request = app('Illuminate\Http\Request');
        $skipCacheParam = config('repository.cache.params.skipCache', 'skipCache');

        if ($request->has($skipCacheParam) && $request->get($skipCacheParam)) {
            $skipped = true;
        }

        return $skipped;
    }

    /**
     * @param $method
     *
     * @return bool
     */
    protected function allowedCache($method)
    {
        $cacheEnabled = config('repository.cache.enabled', true);

        if (!$cacheEnabled) {
            return false;
        }

        $cacheOnly = isset($this->cacheOnly) ? $this->cacheOnly : config('repository.cache.allowed.only', null);
        $cacheExcept = isset($this->cacheExcept) ? $this->cacheExcept : config('repository.cache.allowed.except', null);

        if (is_array($cacheOnly)) {
            return in_array($method, $cacheOnly);
        }

        if (is_array($cacheExcept)) {
            return !in_array($method, $cacheExcept);
        }

        if (is_null($cacheOnly) && is_null($cacheExcept)) {
            return true;
        }

        return false;
    }

    /**
     * Get Cache key for the method
     *
     * @param $method
     * @param $args
     *
     * @return string
     */
    public function getCacheKey($method, $args = null)
    {

        $request = app('Illuminate\Http\Request');
        $args = serialize($args);
        $criteria = $this->serializeCriteria();
        $key = sprintf('%s@%s-%s', get_called_class(), $method, md5($args . $criteria . $request->fullUrl()));

        CacheKeys::putKey(get_called_class(), $key);

        return $key;

    }

    /**
     * Serialize the criteria making sure the Closures are taken care of.
     *
     * @return string
     */
    protected function serializeCriteria()
    {
        try {
            return serialize($this->getCriteria());
        } catch (Exception $e) {
            return serialize($this->getCriteria()->map(function ($criterion) {
                return $this->serializeCriterion($criterion);
            }));
        }
    }

    /**
     * Serialize single criterion with customized serialization of Closures.
     *
     * @param CriteriaInterface $criterion
     * @return CriteriaInterface|array
     *
     * @throws Exception
     */
    protected function serializeCriterion($criterion)
    {
        try {
            serialize($criterion);

            return $criterion;
        } catch (Exception $e) {
            // We want to take care of the closure serialization errors,
            // other than that we will simply re-throw the exception.
            if ($e->getMessage() !== "Serialization of 'Closure' is not allowed") {
                throw $e;
            }

            $r = new ReflectionObject($criterion);

            return [
                'hash' => md5((string)$r),
            ];
        }
    }

    /**
     * @param string $function
     * @param array $args
     * @return mixed
     */
    public function getDataIfExistCache($function, array $args)
    {
        try {
            if (!$this->allowedCache($function) || $this->isSkippedCache()) {
                return call_user_func_array([$this->repository, $function], $args);
            }

            $key = $this->getCacheKey($function, func_get_args());

            $minutes = $this->getCacheMinutes();

            return $this->getCacheRepository()->remember($key, $minutes, function () use ($function, $args) {
                return call_user_func_array([$this->repository, $function], $args);
            });
        } catch (Exception $e) {
            throw $e;
//            dd($this->repository, $function, $args, $e);
        }
    }

    public function flushCacheAndUpdateData($function, array $args, $flushCache = true)
    {
        if ($flushCache) {
            $this->forgetGroup(get_called_class());

            if (is_array($this->tags) && count($this->tags)) {
                foreach ($this->tags as $tag) {
                    $this->forgetGroup(get_class(app($tag)));
                }
            }
        }

        return call_user_func_array([$this->repository, $function], $args);
    }

    protected function forgetGroup($group)
    {
        $cacheKeys = CacheKeys::getKeys($group);

        if (is_array($cacheKeys)) {
            foreach ($cacheKeys as $key) {
                $this->getCacheRepository()->forget($key);
            }
        }
    }

    public function getCacheMinutes()
    {
        $cacheMinutes = isset($this->cacheMinutes) ? $this->cacheMinutes : config('repository.cache.minutes', 30);

        return $cacheMinutes;
    }

    /**
     * {@inheritDoc}
     */
    public function pluck($column, $key = null)
    {
        // TODO: Implement pluck() method.
    }

    /**
     * {@inheritDoc}
     */
    public function sync($id, $relation, $attributes, $detaching = true)
    {
        // TODO: Implement sync() method.
    }

    /**
     * {@inheritDoc}
     */
    public function syncWithoutDetaching($id, $relation, $attributes)
    {
        // TODO: Implement syncWithoutDetaching() method.
    }

    /**
     * Retrieve data of repository with limit applied
     *
     * @param $limit
     * @return mixed
     */
    public function limit($limit)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function all($columns = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function simplePaginate($limit = null, $columns = ['*'])
    {
        return $this->paginate($limit, $columns);
    }

    /**
     * {@inheritDoc}
     */
    public function find($id, $columns = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function findByField($field, $value = null, $columns = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function findWhere(array $where, $columns = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function findWhereIn($field, array $values, $columns = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function findWhereNotIn($field, array $values, $columns = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function findWhereBetween($field, array $values, $columns = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $attributes)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function update(array $attributes, $id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function delete($id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function orderBy($column, $direction = 'asc')
    {
        $this->repository->orderBy($column, $direction);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function firstOrNew(array $attributes = [])
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function firstOrCreate(array $attributes = [])
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function lists($column, $key = null)
    {
        return $this->repository->lists($column, $key);
    }

    /**
     * {@inheritDoc}
     */
    public function with($relations)
    {
        $this->repository->with($relations);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function whereHas($relation, $closure)
    {
        $this->repository->whereHas($relation, $closure);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function withCount($relations)
    {
        $this->repository->withCount($relations);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hidden(array $fields)
    {
        $this->repository->hidden($fields);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function visible(array $fields)
    {
        $this->repository->visible($fields);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function scopeQuery(\Closure $scope)
    {
        $this->repository->scopeQuery($scope);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function resetScope()
    {
        $this->repository->resetScope();
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->repository->getFieldsSearchable();
    }

    public function setPresenter($presenter)
    {
        $this->repository->setPresenter($presenter);
        return $this;
    }

    public function skipPresenter($status = true)
    {
        $this->repository->skipPresenter($status);
        return $this;
    }

    public function pushCriteria($criteria)
    {
        $this->repository->pushCriteria($criteria);
        return $this;
    }

    public function popCriteria($criteria)
    {
        $this->repository->popCriteria($criteria);
        return $this;
    }

    public function getCriteria()
    {
        return $this->repository->getCriteria();
    }

    public function getByCriteria(CriteriaInterface $criteria)
    {
        return $this->repository->getCriteria();
    }

    public function skipCriteria($status = true)
    {
        $this->repository->skipCriteria($status);
        return $this;
    }

    public function resetCriteria()
    {
        $this->repository->resetCriteria();
        return $this;
    }

    /**
     * Trigger static method calls to the model
     *
     * @param $method
     * @param $arguments
     *
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([new static(), $method], $arguments);
    }

    /**
     * Trigger method calls to the model
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->repository, $method], $arguments);
    }
}
