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

//        $event->sheet->getDelegate()
//            ->getStyle('F1:F' . $totalRows)
//            ->getAlignment()
//            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
//
//        $event->sheet
//            ->getDelegate()
//            ->getStyle('C1:C' . $totalRows)
//            ->getAlignment()
//            ->setHorizontal(Alignment::HORIZONTAL_LEFT);
//
//        $event->sheet->getDelegate()
//            ->getColumnDimension('C')
//            ->setWidth(40);

        for ($index = 1; $index <= $totalRows; $index++) {

            $delegate->getColumnDimension($this->getNameFromNumber($index))->setWidth(25);
            $this->drawingImage($event, 'A', $index);

//            $status = $event->sheet->getDelegate()
//                ->getStyle('G' . $index)
//                ->getFont()
//                ->getColor();
//
//            $value = $event->sheet->getDelegate()
//                ->getCell('G' . $index)
//                ->getValue();
//
//            if ($value == BaseStatusEnum::PUBLISHED) {
//                $status->setARGB('1d9977');
//            } else {
//                $status->setARGB('dc3545');
//            }
//
//            $event->sheet
//                ->getDelegate()
//                ->getCell('G' . $index)
//                ->setValue(BaseStatusEnum::getLabel($value));
        }
    }
}