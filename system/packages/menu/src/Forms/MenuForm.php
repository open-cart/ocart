<?php
namespace Ocart\Menu\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Menu\Models\Menu;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class MenuForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->setupModel(new Menu())
            ->withCustomFields()
            ->setModuleName('menu')
            ->setFormOption('class', 'space-y-4 form-save-menu')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('packages/menu::menus.forms.name'),
            ])
            ->add('status', 'select', [
                'label'      => trans('admin.status'),
                'choices'    => BaseStatusEnum::labels()
            ])
            ->setBreakFieldPoint('status');
        $model = $this->getModel();

        if ($model->id) {
            $this->addMetaBoxes([
                'structure' => [
                    'wrap'    => false,
                    'content' => view('packages.menu::menu-structure', [
                        'menu'      => $model,
                        'menu_nodes' => $model->menuNodes ?: [],
                        'locations' => [],
                    ])->render(),
                ],
            ]);
        }
    }
}
