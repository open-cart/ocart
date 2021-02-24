<?php
namespace Ocart\Table\Abstracts;

use Collective\Html\HtmlBuilder;
use Illuminate\Support\Arr;
use Illuminate\View\ComponentAttributeBag;

abstract class TableAbstract
{
    protected $_table;

    protected $bulkAction;

    protected $buttons;

    protected $filters;

    public $data;

    public $html;

    public $view = 'core/table::simple-table';

    /**
     * @var array
     */
    protected $tableAttributes = [];

    public function __construct(HtmlBuilder $html)
    {
        $this->html = $html;
        // code
    }

    public function render($view = null, $options = [])
    {
        $options['table'] = $this;
        return view($view ?? $this->view, $options);
    }

    public function columns()
    {
        return [];
    }

    public function addCreateButton($link, $permission = null)
    {
        $buttons['create'] = view('core::elements.tables.actions.create', compact('link', 'permission'));
        return $buttons;
    }

    public function buttons()
    {
        return [];
    }

    public function renderBulkAction()
    {
        return 'bulkAction';
    }

    protected function _formatRow($row)
    {
        $row['titleAttr'] = $row['titleAttr'] ?? '';
        $row['attributes'] = $row['attributes'] ?? [];
        return $row;
    }

    public function compileTableHeaders()
    {
        $th = [];
        foreach ($this->columns() as $row) {
            $row = $this->_formatRow($row);
            $thAttr = $this->html->attributes(array_merge(
                Arr::only($row, ['class', 'id', 'title', 'width', 'style', 'data-class', 'data-hide']),
                $row['attributes'],
                isset($row['titleAttr']) ? ['title' => $row['titleAttr']] : []
            ));

            $th[] = '<th '.$thAttr.'>' . $row['title'] . '</th>';
        }

        return $th;
    }

    protected $columnRefs = [];

    protected function cb($column) {
        if (isset($column['render']) && $column['render'] instanceof \Closure) {
            return $column['render'];
        }

        return function ($item) use ($column) {
            return $item->{$column['name']};
        };
    }

    public function compileTableBody()
    {
        $tr = [];
        foreach ($this->data as $item) {
            $td = [];

            foreach ($this->columns() as $name => $row) {
                $row = $this->_formatRow($row);

                $tdAttr = $this->html->attributes(array_merge(
                    Arr::only($row, ['class', 'id', 'title', 'width', 'style', 'data-class', 'data-hide']),
                    $row['attributes'],
                    isset($row['titleAttr']) ? ['title' => $row['titleAttr']] : []
                ));

                $td[] = '<td '.$tdAttr.'>' . $this->cb($row)($item) . '</td>';
            }

            $tr[] = '<tr>' . implode('', $td) . '</tr>';
        }
        return $tr;
    }

    public function table($attributes = [])
    {
        $this->setAttributes($attributes);
        return view('tb2', [
            'attributes' => new ComponentAttributeBag($this->tableAttributes),
            'columns' => $this->columns(),
            'data' => $this->data
        ]);
    }

    public function setAttributes($attributes)
    {
        $this->tableAttributes = $attributes;
    }

    protected function tableActions($edit, $delete, $item)
    {
        return view('core::elements.tables.actions', compact('edit', 'delete', 'item'));
    }
}
