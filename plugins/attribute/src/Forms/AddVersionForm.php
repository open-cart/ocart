<?php
namespace Ocart\Attribute\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Ecommerce\Forms\ProductOverviewForm;

class AddVersionForm extends FormAbstract
{
    protected $template = 'plugins.attribute::components.products.add-version';

    public function buildForm()
    {
        $this
            ->setupModel(new AttributeGroup())
            ->withCustomFields()
            ->setModuleName('attribute_groups')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('title', Field::TEXT, [
                'label' => trans('plugins/attribute::attributes.title'),
            ])->add('images[]', \Ocart\Core\Forms\Field::MEDIA_IMAGES, [
                'label'      =>'Images',
                'value'     => [], // $this->getModel() ? $this->getModel()->images :
            ])->addMetaBoxes([
                'overview' => [
                    'title' => trans('Overview'),
                    'content' => apply_filters(
                        'product_overview_form',
                        $this->getFormBuilder()
                            ->create(ProductOverviewForm::class, ['model' => $this->getModel()])
                            ->renderForm(),
                        $this
                    ),
                    'wrap' => false
                ],
            ]);
    }
}
