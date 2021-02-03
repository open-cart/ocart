<?php


namespace Core\Library\Menu;


use Illuminate\Support\Collection;
use IteratorAggregate;

class Builder implements IteratorAggregate
{
    /**
     * @var Collection
     */
    protected $items;

    public function __construct()
    {
        $this->items = new Collection();
    }

    public function add($link = null)
    {
        $item = new Item($this, null, $link ?? new Link('', 'undefined'));

        $this->items->add($item);

        return $item;
    }

    public function prependMenu($index, $link = null)
    {
        $item = new Item($this, null, $link ?? new Link('', 'undefined'));

        $this->items->splice($index, 0, [$item]);

        return $item;
    }

    public function appendMenu($index, $link = null)
    {
        $item = new Item($this, null, $link ?? new Link('', 'undefined'));

        $this->items->splice($index+1, 0, [$item]);

        return $item;
    }

    /**
     * @param $title
     * @return Item
     */
    public function get($title)
    {
        return $this->whereTitle($title)->first();
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->items;
    }


    public function toArray() {
        return $this->items->filter(function ($item) {
            return !$item->parentId;
        })->toArray();
    }

    /**
     * Filter items recursively.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return Collection
     */
    public function filterRecursive($attribute, $value)
    {
        $collection = new Collection();

        // Iterate over all the items in the main collection
        $this->items->each(function ($item) use ($attribute, $value, &$collection) {
            if (!$this->hasProperty($attribute)) {
                return false;
            }

            if ($item->$attribute == $value) {
                $collection->push($item);

                // Check if item has any children
                if ($item->hasChildren()) {
                    $collection = $collection->merge($this->filterRecursive($attribute, $item->id));
                }
            }
        });

        return $collection;
    }

    /**
     * Search the menu based on an attribute.
     *
     * @param string $method
     * @param array  $args
     *
     * @return bool|Builder|Collection
     */
    public function __call($method, $args)
    {
        preg_match('/^[W|w]here([a-zA-Z0-9_]+)$/', $method, $matches);

        if ($matches) {
            $attribute = strtolower($matches[1]);
        } else {
            return false;
        }

        $value = $args ? $args[0] : null;
        $recursive = isset($args[1]) ? $args[1] : false;

        if ($recursive) {
            return $this->filterRecursive($attribute, $value);
        }

        return $this->items->filter(function ($item) use ($attribute, $value) {
            if (!$item->hasProperty($attribute)) {
                return false;
            }

            if ($item->$attribute == $value) {
                return true;
            }

            return false;
        })->values();
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return $this->items->filter(function ($item) {
            return !$item->parentId;
        })->getIterator();
    }
}
