<?php
namespace Ocart\Core\Forms;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Kris\LaravelFormBuilder\Form;
use Ocart\Core\Forms\Fields\MediaImageField;
use Ocart\Core\Forms\Fields\MediaImagesField;
use Ocart\Core\Forms\Fields\OnOffField;

abstract class FormAbstract extends Form
{

    protected $template = 'core::forms.form';

    protected $moduleName = '';

    protected $actionButtons = '';

    /**
     * @var array
     */
    protected $metaBoxes = [];

    /**
     * @var string
     */
    protected $breakFieldPoint = '';

    public function __construct()
    {
        $this->setFormOption('template', $this->template);
    }

    /**
     * @param string $breakFieldPoint
     * @return FormAbstract
     */
    public function setBreakFieldPoint(string $breakFieldPoint)
    {
        $this->breakFieldPoint = $breakFieldPoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getBreakFieldPoint(): string
    {
        return $this->breakFieldPoint;
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
        if (!$this->formHelper->hasCustomField('mediaImage')) {
            $this->addCustomField('mediaImage', MediaImageField::class);
        }
        if (!$this->formHelper->hasCustomField('mediaImages')) {
            $this->addCustomField('mediaImages', MediaImagesField::class);
        }
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

    /**
     * @return array
     */
    public function getMetaBoxes(): array
    {
        uasort($this->metaBoxes, function ($before, $after) {
            if (Arr::get($before, 'priority', 0) > Arr::get($after, 'priority', 0)) {
                return 1;
            } elseif (Arr::get($before, 'priority', 0) < Arr::get($after, 'priority', 0)) {
                return -1;
            }

            return 0;
        });

        return $this->metaBoxes;
    }


    /**
     * @param string $name
     * @return string
     * @throws Throwable
     */
    public function getMetaBox($name): string
    {
        if (!Arr::get($this->metaBoxes, $name)) {
            return '';
        }

        $meta_box = $this->metaBoxes[$name];

        return view('core/base::forms.partials.meta-box', compact('meta_box'))->render();
    }

    /**
     * @param array $boxes
     * @return $this
     */
    public function addMetaBoxes($boxes): self
    {
        if (!is_array($boxes)) {
            $boxes = [$boxes];
        }
        $this->metaBoxes = array_merge($this->metaBoxes, $boxes);

        return $this;
    }

    /**
     * @param string $name
     * @return FormAbstract
     */
    public function removeMetaBox($name): self
    {
        Arr::forget($this->metaBoxes, $name);
        return $this;
    }

    /**
     * @param $model
     * @return $this|FormAbstract
     */
    protected function setupModel($model)
    {
        if ($this->model) {
            return $this;
        }

        return parent::setupModel($model);
    }
}
