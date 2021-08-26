<?php

namespace Ocart\Menu\Supports;

use Ocart\Core\Supports\SortItemsWithChildrenSupport;
use Prettus\Repository\Contracts\RepositoryInterface;

class Menu
{
    public function registerMenuOptions(RepositoryInterface $repository, string $name)
    {
        $all = $repository->all();

        /** @var SortItemsWithChildrenSupport $sortSupport */
        $sortSupport = app(SortItemsWithChildrenSupport::class);

        $list = $sortSupport->setItems($all)->setChildrenProperty('child_cats')->sort();

        $options = $this->generateSelect([
            'list' => $list,
            'type' => get_class($repository->getModel()),
            'children' => false
        ]);

        if ($list->isEmpty()) {
            return '';
        }

        echo view('packages.menu::menu-options', compact('name', 'options'));
    }

    public function generateSelect($args = [])
    {
        $list = $args['list'];


        if ($list->isNotEmpty()) {
            return view('packages.menu::menu', $args)->render();
        }

        return '';
    }
}