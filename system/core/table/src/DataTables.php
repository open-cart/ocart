<?php


namespace Ocart\Table;


class DataTables
{
    protected $_comlumns = array();

    protected $priorityStart = 99;
    protected $priorityEnd = 99;

    public function __construct()
    {

    }

    public function columns($columns = [])
    {
        $this->_comlumns = $columns;
        $this->priorityEnd = $this->priorityStart;
        foreach ($columns as $key => &$column) {
            $column['priority'] = $this->priorityEnd;
            $this->priorityEnd += $this->priorityEnd;
        }

        return $this;
    }

    public function getColumns()
    {
        return collect($this->_comlumns)->sortBy('priority');
    }

    public function addColumn($name, $column)
    {
        $this->priorityEnd -= $this->priorityEnd;
        $column['priority'] = $this->priorityEnd;
        $this->_comlumns[$name] = $column;
    }

    public function prependColumn($name, $column)
    {
        $this->priorityStart -= $this->priorityStart;
        $column['priority'] = $this->priorityStart;

        $this->_comlumns[$name] = $column;
    }
}
