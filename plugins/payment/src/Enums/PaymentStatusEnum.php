<?php
namespace Ocart\Payment\Enums;

use Ocart\Core\Library\Enum;
use Html;

class PaymentStatusEnum extends Enum
{
    public const PENDING = 'pending';
    public const COMPLETED = 'completed';
    public const REFUNDING = 'refunding';
    public const REFUNDED = 'refunded';
    public const FRAUD = 'fraud';
    public const FAILED = 'failed';

    protected function init($value)
    {
        if (!$value) {
            $value = self::PENDING;
        }

        parent::init($value); // TODO: Change the autogenerated stub
    }

    public function toHtml()
    {
        switch ($this->value) {
            case self::COMPLETED:
                return Html::tag('span', $this->getLabel($this->value), [
                    'class' => 'inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-green-600 rounded',
                ]);
            case self::REFUNDING:
                return Html::tag('span', $this->getLabel($this->value), [
                    'class' => 'inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-blue-500 rounded',
                ]);
            case self::PENDING:
                return Html::tag('span', $this->getLabel($this->value), [
                    'class' => 'inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-yellow-400 rounded',
                ]);
            default:
                return '';
                break;
        }

        return "<label>{$this->value}</label>";
    }

    static function getLabel($value) {
        return trans('plugins/payment::payment.statuses.'.$value);
    }
}