<?php
namespace Ocart\Theme\Forms;

use Ocart\Core\Forms\FormAbstract;

class OptionForm extends FormAbstract
{
    public function buildForm()
    {
        $this->withCustomFields();
    }
}