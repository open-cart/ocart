<?php
namespace System\Core\Forms;

use Illuminate\Support\Facades\Config;
use Kris\LaravelFormBuilder\Form;
use System\Core\Forms\Fields\OnOffField;

abstract class FormAbstract extends Form
{

    protected $template = 'core::forms.form';

    protected $moduleName = '';

    protected $actionButtons = '';

    public function __construct()
    {
        $this->setFormOption('template', $this->template);
    }

    /**
     * @return string
     */
    public function getModuleName(): string
    {
        return $this->moduleName;
    }

    public function setModuleName($module)
    {
        $this->moduleName = $module;
        return $this;
    }

    /**
     * @return $this
     */
    public function withCustomFields(): self
    {
//        if (!$this->formHelper->hasCustomField('customSelect')) {
//            $this->addCustomField('customSelect', CustomSelectField::class);
//        }

//        if (!$this->formHelper->hasCustomField('editor')) {
//            $this->addCustomField('editor', EditorField::class);
//        }
        if (!$this->formHelper->hasCustomField('onOff')) {
            $this->addCustomField('onOff', OnOffField::class);
        }
//        if (!$this->formHelper->hasCustomField('customRadio')) {
//            $this->addCustomField('customRadio', CustomRadioField::class);
//        }
//        if (!$this->formHelper->hasCustomField('mediaImage')) {
//            $this->addCustomField('mediaImage', MediaImageField::class);
//        }
//        if (!$this->formHelper->hasCustomField('color')) {
//            $this->addCustomField('color', ColorField::class);
//        }
//        if (!$this->formHelper->hasCustomField('time')) {
//            $this->addCustomField('time', TimeField::class);
//        }

        return apply_filters('form_custom_fields', $this, $this->formHelper);
    }

    /**
     * @return string
     */
    public function getActionButtons(): string
    {
        if ($this->actionButtons === '') {
            return view('core/base::elements.form-actions')->render();
        }

        return $this->actionButtons;
    }

    /**
     * @return $this
     */
    public function removeActionButtons(): self
    {
        $this->actionButtons = '';
        return $this;
    }

    /**
     * @param string $actionButtons
     * @return $this
     */
    public function setActionButtons($actionButtons): self
    {
        $this->actionButtons = $actionButtons;
        return $this;
    }

    /**
     * @param array $options
     * @param bool $showStart
     * @param bool $showFields
     * @param bool $showEnd
     * @return string
     */
    public function renderForm(array $options = [], $showStart = true, $showFields = true, $showEnd = true)
    {
        apply_filters(BASE_FILTER_BEFORE_RENDER_FORM, $this, $this->moduleName, $this->getModel());

        return parent::renderForm($options, $showStart, $showFields, $showEnd);
    }
}
