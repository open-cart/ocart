<?php

namespace Ocart\Payment\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Payment\Enums\PaymentMethodEnum;
use Ocart\Payment\Enums\PaymentStatusEnum;

class PaymentTransactionFilterForm extends FormAbstract
{
    protected $template = 'core::forms.form-filter';

    public function buildForm()
    {
        $this
            ->setModuleName('page-filter')
            ->add('name', Field::TEXT, [
                'label' => trans('plugins/payment::payment.search.label'),
                'wrapper_class' => 'col-span-2',
                'attr' => [
                    'placeholder' => trans('packages/page::pages.search.placeholder'),
                ]
            ])->add('status', Field::SELECT, [
                'label' => trans('plugins/payment::payment.status'),
                'wrapper_class' => 'col-span-2',
                'choices'    => PaymentStatusEnum::labels(),
                'labels'    => PaymentStatusEnum::labels(),
                'attr' => [
                    'placeholder' =>  trans('plugins/payment::payment.select_status'),
                ]
            ])->add('payment_channel', Field::SELECT, [
                'label' => trans('plugins/payment::payment.payment_channel'),
                'wrapper_class' => 'col-span-2',
                'choices'    => PaymentMethodEnum::labels(),
                'labels'    => PaymentMethodEnum::labels(),
                'attr' => [
                    'placeholder' => trans('plugins/payment::payment.select_method'),
                ]
            ]);
    }
}
