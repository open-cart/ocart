<?php
namespace Ocart\Payment\Forms;

use Ocart\Core\Forms\FormAbstract;
use Ocart\Payment\Enums\PaymentStatusEnum;
use Ocart\Payment\Models\Payment;

class PaymentTransactionForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->setupModel(new Payment())
            ->withCustomFields()
            ->setModuleName('payment_transaction')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->addMetaBoxes([
                'information' => [
                    'title' => trans('plugins/payment::payment.information'),
                    'content' => apply_filters(
                        'payment_transaction_information',
                        view('plugins.payment::transactions.information', ['transaction' => $this->getModel()]),
                        $this
                    )
                ],
            ])
            ->add('status', 'select', [
                'label'      => trans('admin.status'),
                'choices'    => PaymentStatusEnum::labels()
            ])
            ->setBreakFieldPoint('status');
    }
}
