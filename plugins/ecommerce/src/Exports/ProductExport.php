<?php
namespace Ocart\Ecommerce\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Ocart\Table\TableExportHandler;

class ProductExport extends TableExportHandler
{
    /**
     * {@inheritDoc}
     */
    protected function afterSheet(AfterSheet $event)
    {
        parent::afterSheet($event);

        $delegate = $event->sheet->getDelegate();
        $totalRows = $this->collection->count() + 1;

        for ($index = 1; $index <= $totalRows; $index++) {

//            $delegate->getColumnDimension($this->getNameFromNumber($index))->setWidth(25);
            $this->drawingImage($event, 'A', $index);
        }
    }
}