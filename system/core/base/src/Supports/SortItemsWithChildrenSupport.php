<?php

namespace Ocart\Core\Supports;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class SortItemsWithChildrenSupport
{
    /**
     * @var Collection
     */
    protected $items;

    /**
     * @var string
     */
    protected $parentField = 'parent_id';

    /**
     * @var string
     */
    protected $childrenProperty = 'children_items';

    /**
     * @var string
     */
    protected $compareKey = 'id';

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getChildrenProperty(): string
    {
        return $this->childrenProperty;
    }

    /**
     * @return string
     */
    public function getCompareKey(): string
    {
        return $this->compareKey;
    }

    /**
     * @return string
     */
    public function getParentField(): string
    {
        return $this->parentField;
    }

    /**
     * @param string $childrenProperty
     * @return $this
     */
    public function setChildrenProperty(string $childrenProperty)
    {
        $this->childrenProperty = $childrenProperty;
        return $this;
    }

    /**
     * @param string $compareKey
     * @return $this
     */
    public function setCompareKey(string $compareKey)
    {
        $this->compareKey = $compareKey;
        return $this;
    }

    /**
     * @param string $parentField
     * @return $this
     */
    public function setParentField(string $parentField)
    {
        $this->parentField = $parentField;
        return $this;
    }

    /**
     * @param Collection $items
     * @return $this
     */
    public function setItems(Collection $items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return Collection
     */
    public function sort()
    {
        return $this->processSort();
    }

    /**
     * @return Collection
     */
    protected function processSort()
    {
        $items = clone $this->items;
        $all = [];
        foreach ($items as $item) {
            if (!$item->{$this->getParentField()}) {
                $item->{$this->getParentField()} = 0;
            }

            if (!Arr::exists($all, $item->{$this->getParentField()})) {
                $all[$item->{$this->getParentField()}] = [];
            }
            $all[$item->{$this->getParentField()}][] = $item;
        }

        foreach ($items as $item) {
            $item->setRelation($this->getChildrenProperty(), collect(Arr::get($all, $item->{$this->getCompareKey()}, [])));
        }

        return collect($all[0]);
    }
}