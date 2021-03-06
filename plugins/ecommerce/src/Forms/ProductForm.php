<?php
namespace Ocart\Ecommerce\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Page\Supports\Template;
use System\Core\Enums\BaseStatusEnum;
use System\Core\Forms\FormAbstract;

class ProductForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->withCustomFields()
            ->setModuleName('product')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('plugins/ecommerce::products.forms.name'),
                'rules' => 'min:5',
            ])
            ->add('slug', Field::TEXT, [
                'rules' => 'min:5',
            ])
            ->add('description', Field::TEXTAREA, [
                'rules' => 'max:5000'
            ])
            ->add('content', Field::TEXTAREA, [
                'rules' => 'max:5000'
            ])

            ->addMetaBoxes([
                'overview' => [
                    'title' => trans('Overview'),
                    'content' => apply_filters(
                        'product_overview_form',
                        $this->getFormBuilder()
                            ->create(ProductOverviewForm::class, ['model' => $this->getModel()])
                            ->renderForm(),
                        $this
                    )
                ],
            ])

            ->add('is_featured', 'onOff')
            ->add('status', 'select', [
                'choices'    => BaseStatusEnum::labels()
            ])
            ->setBreakFieldPoint('is_featured');
    }
}
