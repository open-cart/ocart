<?php

namespace Ocart\Blog\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Table\TableExportHandler;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PostExport extends TableExportHandler
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
            $this->drawingImage($event, 'A', $index);
        }
    }
}