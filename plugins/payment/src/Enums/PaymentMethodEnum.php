<?php

namespace Ocart\Payment\Enums;

use Ocart\Core\Library\Enum;

class PaymentMethodEnum extends Enum
{
//    public const STRIPE = 'stripe';
//    public const PAYPAL = 'paypal';
    public const COD = 'cod';
    public const BANK_TRANSFER = 'bank_transfer';

    protected function init($value)
    {
        if (!$value) {
            $value = self::COD;
        }

        parent::init($value);
    }

    public function toHtml()
    {
//        switch ($this->value) {
//            case self::COMPLETED:
//                return Html::tag('span', $this->getLabel($this->value), [
//                    'class' => 'inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none
//                     text-white bg-green-600 rounded dark:text-gray-300',
//                ]);
//            case self::REFUNDING:
//                return Html::tag('span', $this->getLabel($this->value), [
//                    'class' => 'inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none
//                     text-white bg-blue-500 rounded dark:text-gray-300',
//                ]);
//            case self::PENDING:
//                return Html::tag('span', $this->getLabel($this->value), [
//                    'class' => 'inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none
//                     text-white bg-yellow-400 rounded dark:bg-yellow-600 dark:text-gray-300',
//                ]);
//            default:
//                return '';
//                break;
//        }

        return "<label>{$this->getLabel($this->value)}</label>";
    }

    static function getLabel($value) {
        return trans('plugins/payment::payment.methods.'.$value);
    }
}