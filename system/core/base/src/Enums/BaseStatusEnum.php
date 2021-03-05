<?php
namespace System\Core\Enums;


use System\Core\Library\Enum;
use Html;

class BaseStatusEnum extends Enum
{

    public const PUBLISHED = 'published';
    public const DRAFT = 'draft';
    public const PENDING = 'pending';

    public function toHtml()
    {
        switch ($this->value) {
            case self::PUBLISHED:
                return Html::tag('span', $this->getLabel($this->value), [
                    'class' => 'inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-green-600 rounded',
                ]);
            case self::DRAFT:
                return Html::tag('span', $this->getLabel($this->value), [
                    'class' => 'inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-blue-500 rounded',
                ]);
            case self::PENDING:
                return Html::tag('span', $this->getLabel($this->value), [
                    'class' => 'inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-yellow-400 rounded',
                ]);
        default:
            break;
        }

        return "<label>{$this->value}</label>";
    }

    static function getLabel($value) {
        return trans('core/base::enums.statuses.'.$value);
    }
}
