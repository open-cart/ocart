<?php


namespace System\Core\Library\Menu;
use Illuminate\Contracts\Support\Arrayable;

class Item implements Arrayable
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $children = [];

    /**
     * @var string
     */
    protected $parentId = '';

    /**
     * @var string|string
     */
    protected $id = '';

    /**
     * @var Link
     */
    protected $link;

    public function __construct(Builder $builder, $title, $link)
    {
        $this->builder = $builder;
        $this->title = $title;
        $this->link = $link;
        $this->id = str_replace('.', '', uniqid('id-', true));
    }

    public function getIndex()
    {
        return $this->builder->all()->search(function($item) {
            return $item === $this;
        });
    }

    public function prependMenu($link = null)
    {
        return $this->builder->prependMenu($this->getIndex(), $link);
    }

    public function appendMenu($link = null)
    {
        return $this->builder->appendMenu($this->getIndex(), $link);
    }

    public function as($title) {
        $this->title = $title;
        return $this;
    }

    public function add($link = null)
    {
        if (is_string($link)) {
            $item = $this->builder->add(new Link('', $link));
        } else {
            $item = $this->builder->add($link);
        }

        $item->setParentId($this->id);

        $this->children[] =& $item;

        return $item;
    }

    public function addClass($class) {
        $this->link->addParentClass($class);
        return $this;
    }

    public function addChildren($callback)
    {
        $callback($this);
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function hasChildren()
    {
        return count($this->children) > 0;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function hasProperty($property)
    {
        if (property_exists($this, $property)) {
            return true;
        }

        return false;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'parentId' => $this->parentId,
            'title' => $this->title,
            'link' => $this->link,
            'children' => array_map(function ($value) {
                return $value instanceof Arrayable ? $value->toArray() : $value;
            }, $this->children)
        ];
    }

    /**
     * Search in meta data if a property doesn't exist otherwise return the property.
     *
     * @param  string
     *
     * @return string
     */
    public function __get($prop)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
}
