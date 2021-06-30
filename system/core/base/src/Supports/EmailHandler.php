<?php

namespace Ocart\Core\Supports;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\ViewFinderInterface;
use Ocart\Media\Facades\TnMedia;
use Ocart\Setting\SettingStore;

class EmailHandler
{
    /**
     * @var array
     */
    protected $variables = [];

    protected $preview = false;

    /**
     * @var Mailer
     */
    protected $mailer;

    protected $module = '';

    /**
     * @var array
     */
    protected $templates = [];

    /**
     * @var array
     */
    protected $variableValues = [];

    /**
     * SendMailListener constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;

        $this->variableValues['core'] = [
            'header'           => apply_filters(BASE_FILTER_EMAIL_TEMPLATE_HEADER, $this->getTemplateContent('core::emails.header')),
            'footer'           => apply_filters(BASE_FILTER_EMAIL_TEMPLATE_FOOTER, $this->getTemplateContent('core::emails.footer')),
            'site_title'       => setting('admin_title'),
            'site_url'         => url(''),
            'site_logo'        => TnMedia::url(setting('admin_logo', '/images/logo-default.jpg')),
            'date_time'        => now()->toDateTimeString(),
            'date_year'        => now()->format('Y'),
            'site_admin_email' => setting('admin_email', ''),
        ];

        $this->variables['core'] = [
            'header'           => trans('core/base::base.email_template.header'),
            'footer'           => trans('core/base::base.email_template.footer'),
            'site_title'       => trans('core/base::base.email_template.site_title'),
            'site_url'         => trans('core/base::base.email_template.site_url'),
            'site_logo'        => trans('core/base::base.email_template.site_logo'),
            'date_time'        => trans('core/base::base.email_template.date_time'),
            'date_year'        => trans('core/base::base.email_template.date_year'),
            'site_admin_email' => trans('core/base::base.email_template.site_admin_email'),
        ];
    }

    /**
     * @param string $name
     * @return array|mixed
     */
    public function module(string $name)
    {
        $this->module = $name;

        return $this;
    }

    /**
     * @param string $module
     * @param array $variables
     * @return $this
     */
    public function addVariables(array $variables, ?string $module = null): self
    {
        if (!$module) {
            $module = $this->module;
        }

        foreach ($variables as $name => $description) {
            $this->variables[$module][$name] = $description;
        }

        return $this;
    }

    /**
     * @param string|null $module
     * @return array
     */
    public function getVariables(?string $module = null): array
    {
        if (!$module) {
            return $this->variables;
        }

        return Arr::get($this->variables, $module, []);
    }

    /**
     * @param array $data
     * @param string|null $module
     * @return $this
     */
    public function setVariableValues(array $data, string $module = null): self
    {
        foreach ($data as $name => $value) {
            $this->variableValues[$module ? $module : $this->module][$name] = $value;
        }

        return $this;
    }

    /**
     * @param string $variable
     * @param string $module
     * @param string $default
     * @return string
     */
    public function getVariableValue(string $variable, string $module, string $default = ''): string
    {
        return (string)Arr::get($this->variableValues, $module . '.' . $variable, $default);
    }

    public function preview()
    {
        $this->preview = true;

        return $this;
    }

    public function sendUsingTemplate($template, $email = null, $data = [])
    {
        if (!$this->templateEnabled($template)) {
            return false;
        }

        $content = $this->getTemplateContent($template);
        $subject = $this->getTemplateSubject($template);

        $this->send($content, $subject, $email, $data);

        return true;
    }


    /**
     * @param string $template
     * @param string $type
     * @return array|SettingStore|string|null
     */
    public function templateEnabled(string $template)
    {
        return get_setting_email_status($template);
    }

    /**
     * @param string $template
     * @param string $type
     * @return string|null
     */
    public function getTemplateContent(string $template, string $type = 'plugins'): ?string
    {
        $templateMd5 = md5($template);
        $path = storage_path('app/email-template/' . $templateMd5);

        if (File::exists($path)) {
            return File::get($path);
        }

        return File::get(view()->getFinder()->find($template));
    }

    public function saveTemplateContent($template, $content)
    {
        $templateMd5 = md5($template);
        $path = storage_path('app/email-template/' . $templateMd5);

        if (!File::isDirectory(File::dirname($path))) {
            File::makeDirectory(File::dirname($path), 493, true);
        }

        return File::put($path, $content);
    }

    public function send($content, $title, $to = null, $args = [])
    {
        if (empty($to)) {
            $to = setting('admin_email', setting('email_from_address', config('mail.from.address')));
        }

        $content = $this->prepareData($content);
        $title = $this->prepareData($title);

        if ($this->preview) {
            echo $content; die;
        }

        $mailable = new EmailAbstract($content, $title, $args);

        $this->mailer->to($to)->send($mailable);
    }

    /**
     * @param string $content
     * @param array $variables
     * @return string
     */
    protected function prepareData(string $content, $variables = []) {

        if (!empty($content)) {
            $content = $this->replaceVariableValue(array_keys($this->variableValues['core']), 'core', $content);

            if ($this->module !== 'core') {
                if (empty($variables)) {
                    $variables = Arr::get($this->variableValues, $this->module, []);
                }

                $content = $this->replaceVariableValue(
                    array_keys($variables),
                    $this->module,
                    $content
                );
            }
        }

        return apply_filters(BASE_FILTER_EMAIL_TEMPLATE, $content);
    }

    /**
     * @param array $variables
     * @param string $module
     * @param string $content
     * @return string
     */
    protected function replaceVariableValue(array $variables, string $module, string $content): string
    {
        foreach ($variables as $variable) {
            $keys = [
                '{{ ' . $variable . ' }}',
                '{{' . $variable . '}}',
                '{{ ' . $variable . '}}',
                '{{' . $variable . ' }}',
                '<?php echo e(' . $variable . '); ?>',
            ];

            foreach ($keys as $key) {
                $content = str_replace($key, $this->getVariableValue($variable, $module), $content);
            }
        }

        return $content;
    }

    /**
     * @param $template
     * @param string $default
     * @return array|string|null
     */
    public function getTemplateSubject($template)
    {
        $config = Arr::get($this->templates, $this->module);
        return setting($this->getTemplateSubjectKey($template), Arr::get($config, $template)['subject']);
    }

    public function saveTemplateSubject($template, $content)
    {
        return setting()->set($this->getTemplateSubjectKey($template), $content)->save();
    }

    protected function getTemplateSubjectKey($template)
    {
        return 'email-subject::' .$template;
    }

    public function getConfig($template, $key, $default = null)
    {
        $config = Arr::get($this->templates, $this->module);
        return Arr::get(Arr::get($config, $template, []), $key, $default);
    }

    /**
     * @param string $module
     * @param array $data
     * @return $this
     */
    public function addTemplateSettings(string $module, array $data): self
    {
        if (empty($data)) {
            return $this;
        }

        $this->templates[$module] = $data['templates'];

        if (Arr::get($data, 'variables')) {
            $this->addVariables($data['variables'], $module);
        }

        add_filter(BASE_FILTER_AFTER_SETTING_EMAIL_CONTENT, function ($html) use ($module, $data) {
            return $html . view('core.setting::template-line', compact('module', 'data'))->render();
        }, 99);

        return $this;
    }
}