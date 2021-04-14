<?php
namespace Ocart\Distributor\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Core\Forms\FormAbstract;
use Ocart\Distributor\Models\Distributor;
use Ocart\Distributor\Models\DistributorLocation;

class DistributorForm extends FormAbstract
{

    public function buildForm()
    {
        $list = ['' => '- Chọn tỉnh thành -'] + DistributorLocation::all()->pluck('name', 'code')->toArray();

        $this
            ->setupModel(new Distributor())
            ->withCustomFields()
            ->setModuleName('distributors')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('plugins/distributor::distributor.forms.name'),
            ])
            ->add('phone', Field::TEXT, [
                'label'      => trans('plugins/distributor::distributor.forms.phone'),
            ])
            ->add('address', Field::TEXT, [
                'label'      => trans('plugins/distributor::distributor.forms.address'),
            ])
            ->add('location', Field::SELECT, [
                'label'      => trans('plugins/distributor::distributor.forms.location'),
                'choices'    => $list
            ]);
    }
}
