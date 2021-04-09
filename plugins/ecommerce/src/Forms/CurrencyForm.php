<?php
namespace Ocart\Ecommerce\Forms;

use Ocart\Core\Forms\Field;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Ecommerce\Models\Currency;

class CurrencyForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->setupModel(new Currency())
            ->withCustomFields()
            ->setModuleName('ecommerce_currency')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('title', Field::TEXT, [
                'label'      => trans('plugins/ecommerce::currency.title'),
            ])
            ->add('description', Field::TEXT, [
                'label'      => trans('plugins/ecommerce::currency.description'),
            ])
            ->add('symbol', Field::TEXT, [
                'label'      => trans('plugins/ecommerce::currency.symbol'),
            ])
            ->add('exchange_rate', Field::NUMBER, [
                'label'      => trans('plugins/ecommerce::currency.exchange_rate'),
            ])
            ->add('decimals', Field::NUMBER, [
                'label'      => trans('plugins/ecommerce::currency.number_of_decimals'),
            ])
            ->add('is_prefix_symbol', Field::SELECT, [
                'label'      => trans('plugins/ecommerce::currency.position_of_symbol'),
                'choices' => [
                    '1' => trans('plugins/ecommerce::currency.before_number'),
                    '0' => trans('plugins/ecommerce::currency.after_number'),
                ]
            ])
            ->add('thousands_separator', Field::SELECT, [
                'label'      => trans('plugins/ecommerce::currency.thousands_separator'),
                'choices' => [
                    ',' => trans('plugins/ecommerce::ecommerce.setting.separator_comma'),
                    '.' => trans('plugins/ecommerce::ecommerce.setting.separator_period'),
                    ' ' => trans('plugins/ecommerce::ecommerce.setting.separator_space'),
                ]
            ])
            ->add('decimal_separator', Field::SELECT, [
                'label'      => trans('plugins/ecommerce::currency.decimal_separator'),
                'choices' => [
                    ',' => trans('plugins/ecommerce::ecommerce.setting.separator_comma'),
                    '.' => trans('plugins/ecommerce::ecommerce.setting.separator_period'),
                    ' ' => trans('plugins/ecommerce::ecommerce.setting.separator_space'),
                ]
            ])

            ->add('order', Field::NUMBER, [
                'label'      => trans('plugins/ecommerce::currency.order'),
            ])
            ->add('is_default', Field::ON_OFF, [
                'label'      => trans('plugins/ecommerce::currency.is_default'),
            ]);
    }
}
