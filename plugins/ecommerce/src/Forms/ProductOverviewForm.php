<?php


namespace Ocart\Ecommerce\Forms;


use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Forms\FormAbstract;

class ProductOverviewForm extends FormAbstract
{
    protected $template = 'plugins.ecommerce::product-overview';

    public function buildForm()
    {
        $this
            ->withCustomFields()
            ->setModuleName('ecommerce_product_overview')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('sku', Field::TEXT, [
                'label' => 'Sku',
                'attr' => [
                    'placeholder' => 'VD: SP_000001',
                ]
//                'rules' => 'min:5',

            ])->add('price', Field::TEXT, [
                'label' => 'Price',
//                'rules' => 'min:5',
                'default_value' => 0
            ])->add('sale_price', Field::TEXT, [
                'label' => 'Price sale',
//                'rules' => 'min:5',
                'default_value' => 0
            ]);
    }
}
