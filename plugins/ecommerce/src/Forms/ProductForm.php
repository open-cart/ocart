<?php
namespace Ocart\Ecommerce\Forms;

use Illuminate\Support\Collection;
use Ocart\Core\Forms\Field;
use Ocart\Ecommerce\Forms\Fields\CategoryMultiField;
use Ocart\Ecommerce\Forms\Fields\TagField;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Ecommerce\Repositories\Interfaces\TaxRepository;

class ProductForm extends FormAbstract
{

    public function buildForm()
    {
        $this->formHelper->addCustomField('categoryMulti', CategoryMultiField::class);

        $selectedCategories = [];
        if ($this->getModel()) {
            $selectedCategories = $this->getModel()->categories()->pluck('category_id')->all();
        }

        if (empty($selectedCategories)) {
            /** @var $repo CategoryRepository */
            $repo = app(CategoryRepository::class);

            $selectedCategories = $repo->findWhere(['is_default' => 1])->pluck('id');
        }

        $repo = app(BrandRepository::class);
        $list = $repo->all();
        $brands = [];
        foreach ($list as $row) {
            $brands[$row->id] = $row->indent_text . ' ' . $row->name;
        }
        $brands = [0 => 'No brand'] + $brands;

        $taxRepository = app(TaxRepository::class);
        /** @var Collection $list */
        $list = $taxRepository->all();
        $taxes = $list->pluck('title', 'id')->prepend('-- select --', '')->toArray();

        $this
            ->setupModel(new Product())
            ->withCustomFields()
            ->setModuleName('ecommerce_product')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->addCustomField('tags', TagField::class)
            ->add('name', Field::TEXT, [
                'label'      => trans('plugins/ecommerce::products.forms.name'),
                'rules' => 'min:5',
            ])
            ->add('slug', Field::TEXT, [
                'rules' => 'min:5',
            ])
            ->add('description', Field::TEXTAREA, [
                'rules' => 'max:5000',
                'attr' => [
                      'rows' => 3,
                    'class' => $this->formHelper->getConfig('defaults.field_class') . ' editor-inline'
                ]
            ])
            ->add('content', Field::EDITOR, [])
            ->add('images[]', Field::MEDIA_IMAGES, [
                'label'      =>'Images',
                'value'     => $this->getModel() ? $this->getModel()->images : []
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
//            ->addMetaBoxes([
//                'images' => [
//                    'title' => trans('images'),
//                    'content' => apply_filters(
//                        'product_images',
//                        view('plugins/ecommerce::images'),
//                        $this
//                    )
//                ],
//            ])

            ->add('is_featured', 'onOff')
            ->add('status', 'select', [
                'label' => 'Status',
                'choices'    => BaseStatusEnum::labels()
            ])
            ->add('categories[]', 'categoryMulti', [
                'label'      =>'Category',
                'choices'    => get_product_categories_children(),
                'value'      => old('categories', $selectedCategories),
            ])
            ->add('tax_id', 'select', [
                'label' => 'Tax',
                'choices'    => $taxes
            ])
            ->add('tags[]', 'tags', [
                'label'      => trans('Tags')
            ])
            ->add('brand_id', 'select', [
                'label'      =>'Brand',
                'choices'    => $brands
            ])
            ->setBreakFieldPoint('is_featured');
    }
}
