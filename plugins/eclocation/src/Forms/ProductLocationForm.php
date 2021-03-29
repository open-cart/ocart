<?php


namespace Ocart\EcLocation\Forms;


use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Core\Models\District;
use Ocart\Core\Models\Province;

class ProductLocationForm extends FormAbstract
{
    protected $template = 'plugins/eclocation::product-location';

    public function buildForm()
    {
        $list = ['' => '- Chọn tỉnh thành -'] + Province::all()->pluck('name', 'provinceid')->toArray();

        $district = [ ''=>'- Chọn quận huyện -'];
        if ($model = $this->getModel()) {
            if ($model->province_id) {
                $district = $district + District::where('provinceid', $model->province_id)
                        ->get()->pluck('name', 'districtid')->toArray();
            }
        }

        $this
            ->withCustomFields()
            ->setModuleName('product-location')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('province_id', 'select', [
                'label' => 'Tỉnh thành',
                'choices'    => $list
            ])
            ->add('district_id', 'select', [
                'label' => 'Quận huyện',
                'choices'    => $district
            ])
            ->add('address', Field::TEXT, [
                'label' => 'Địa chỉ chi tiết',
            ])
            ->add('location', Field::TEXT, [
                'label' => 'Vị trí bản đồ',
                'help_block' => [
                    'tag' => 'small',
                    'text' => 'Vị trí lat,long của bản đồ.'
                ]
            ])
            ->add('acreage', Field::NUMBER, [
                'label' => 'Diện tích(m2)',
            ]);
    }
}
