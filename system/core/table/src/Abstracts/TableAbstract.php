<?php

namespace Ocart\Table\Abstracts;

use Collective\Html\HtmlBuilder;
use Illuminate\Support\Arr;
use Illuminate\View\ComponentAttributeBag;
use Ocart\Table\DataArrayTransformer;
use Ocart\Table\DataTables;
use Ocart\Table\TableExportHandler;
use Prettus\Repository\Contracts\RepositoryInterface;

abstract class TableAbstract
{
    protected $table;

    protected $bulkAction;

    protected $buttons;

    protected $filters;

    public $data;

    public $html;

    public $searchForm;

    protected $request;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    public $view = 'core/table::simple-table';

    /**
     * @var array
     */
    protected $tableAttributes = [];

    protected $actions = ['excel'];

    /**
     * Excel export type writer.
     *
     * @var string
     */
    protected $excelWriter = 'Xlsx';

    /**
     * Export class handler.
     *
     * @var string
     */
    protected $exportClass = TableExportHandler::class;

    public function __construct(DataTables $table, HtmlBuilder $html)
    {
        $this->table = $table;
        $this->html = $html;
        // code
    }

    public function render($view = null, $options = [])
    {
        if ($action = $this->request()->get('action') and in_array($action, $this->actions)) {
            if ($action == 'print') {
                return app()->call([$this, 'printPreview']);
            }

            return app()->call([$this, $action]);
        }

        $options['table'] = $this;

        return view($view ?? $this->view, $options);
    }

    public function addCreateButton($link, $permission = null, $buttons = [])
    {
        if (!$permission || \Auth::user()->can($permission)) {
            $buttons['create'] = view('core::elements.tables.actions.create', compact('link', 'permission'));
        }

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

            $th[] = '<th ' . $thAttr . '>' . $row['title'] . '</th>';
        }

        return $th;
    }

    protected $columnRefs = [];

    protected function cb($column)
    {
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

                $td[] = '<td ' . $tdAttr . '>' . $this->cb($row)($item) . '</td>';
            }

            $tr[] = '<tr>' . implode('', $td) . '</tr>';
        }
        return $tr;
    }

    public function columns()
    {
        return $this->table->getColumns();
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

    public function request()
    {
        return $this->request ?: $this->request = request();
    }

    /**
     * Get export filename.
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename();
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return class_basename($this) . '_' . date('YmdHis');
    }

    public function excel()
    {
        $ext = '.' . strtolower($this->excelWriter);

        return $this->buildExcelFile()->download($this->getFilename() . $ext, $this->excelWriter);
    }

    protected function buildExcelFile()
    {
        $dataForExport = collect($this->getDataForExport());

        return new $this->exportClass($dataForExport);
    }

    protected function getDataForExport()
    {
        $columns = $this->columns();

        $transformer = new DataArrayTransformer();

        return $this->data->map(function ($row) use ($columns, $transformer) {
            return $transformer->transform($row, $columns, 'exportable');
        });
    }

    /**
     * @return string[]
     */
    public function getDefaultButtons(): array
    {
        return [
            'reload',
        ];
    }
}
