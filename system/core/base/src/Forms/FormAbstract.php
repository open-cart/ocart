<?php
namespace System\Core\Forms;

use Illuminate\Support\Facades\Config;
use Kris\LaravelFormBuilder\Form;

abstract class FormAbstract extends Form
{

    protected $template = 'core::forms.form';


    public function __construct()
    {
        $this->setFormOption('template', $this->template);
    }
}
