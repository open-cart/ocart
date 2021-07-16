<?php

namespace Ocart\Theme;

use Illuminate\Support\Arr;
use Ocart\Core\Forms\Field;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Theme\Facades\Theme;
use Ocart\Theme\Forms\OptionForm;

class ThemeOption
{
    protected $formBuilder;

    protected $form;

    protected $fields = [];

    protected $selections = [];

    protected $optionFrom = OptionForm::class;

    /**
     * @var array
     */
    public $priority = [];

    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
        $this->form = $formBuilder->create(OptionForm::class);
    }

    /**
     * @return \Kris\LaravelFormBuilder\Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return FormBuilder
     */
    public function getFormBuilder(): FormBuilder
    {
        return $this->formBuilder;
    }

    public function constructSections()
    {
        return $this->selections;
    }

    /**
     * @param string $sectionId
     * @return \Kris\LaravelFormBuilder\Fields\FormField[]
     */
    public function constructFields(string $sectionId)
    {
        $fields = [];
        foreach ($this->fields as $field) {
            if (Arr::get($field, 'section_id') == $sectionId) {
                $priority = $field['priority'];
                while (isset($fields[$priority])) {
                    $priority++;
                }
                $fields[$priority] = $field;
            }
        }
        ksort($fields);

        $form = $this->formBuilder->create($this->optionFrom);

        foreach ($fields as $field) {
            $args = Arr::except($field, ['name', 'type']);
            $args['value'] = $this->getOption($field['name'], Arr::get($field, 'defaultValue'));
            $form->add($field['name'], $field['type'], $args);
        }

        return $form->getFields();
    }

    public function hasSectionFields(string $sectionId)
    {
        return Arr::has($this->fields, $sectionId);
    }

    public function setSections(array $sections) {
        foreach ($sections as $section) {
            $this->setSection($section);
        }

        return $this;
    }

    public function setSection(array $section) {
        if (empty($section)) {
            return $this;
        }
        if (isset($section['fields'])) {
            $this->processFieldsArray($section['id'], $section['fields']);

            unset($section['fields']);
        }

        $this->selections[$section['id']] = $section;

        return $this;
    }

    /**
     * @param string $sectionId
     * @param array $fields
     */
    public function processFieldsArray(string $sectionId = '', array $fields = []): void
    {
        if (!empty($sectionId) && is_array($fields) && !empty($fields)) {
            foreach ($fields as $field) {
                if (!is_array($field)) {
                    continue;
                }
                $field['section_id'] = $sectionId;
                $this->setField($field);
            }
        }
    }

    /**
     * @param array $field
     * @return $this
     */
    public function setField(array $field = []): self
    {
        if (is_array($field) && !empty($field)) {
            if (!isset($field['priority'])) {
                $field['priority'] = $this->getPriority('fields');
            }

            $id = Arr::get($field, 'id', Arr::get($field, 'name'));
            $this->fields[$id] = $field;
        }
        return $this;
    }

    /**
     * @param string $id
     * @return bool|array
     */
    public function getField(string $id = '')
    {
        if (!empty($id)) {
            return Arr::get($this->fields, $id, false);
        }

        return false;
    }

    /**
     * @param string $type
     * @return int
     */
    public function getPriority(string $type): int
    {
        if (!isset($this->priority[$type])) {
            $this->priority[$type] = 1;
        }
        $priority = $this->priority[$type];
        $this->priority[$type] += 1;

        return $priority;
    }

    public function getOption($key, $default = null)
    {
        if (is_array($default)) {
            $default = json_encode($default);
        }

        $default = setting($this->getOptionKey($key), $default);

        $value = setting($this->getOptionKey($key, $this->getCurrentLocaleCode()), $default);

        $value = $value ?: $default;

        if (is_array($value)) {
            $value = json_encode($value);
        }

        return $value;
    }

    protected function getOptionKey(string $key, $locale = '')
    {
        $theme = setting('theme');

        if (!$theme) {
            $theme = Theme::getThemeName();
        }

        return 'theme-' . $theme . $locale . '-' . $key;
    }

    public function setOption($key, $value)
    {
//        $option = Arr::get($this->fields, $key);

//        if ($option && Arr::get($option, 'clean_tags', true)) {
//            $value = clean($value);
//        }

        if (is_array($value)) {
            $value = json_encode($value);
        }

        setting()->set($this->getOptionKey($key, $this->getCurrentLocaleCode()), $value);

        return $this;
    }

    /**
     * @return bool|void
     */
    public function saveOptions()
    {
        return setting()->save();
    }

    /**
     * @return null|string
     */
    protected function getCurrentLocaleCode(): ?string
    {
        return '-en';
    }
}