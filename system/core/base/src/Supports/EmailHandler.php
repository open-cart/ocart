<?php

namespace Ocart\Core\Supports;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\View\ViewFinderInterface;
use Ocart\Media\Facades\TnMedia;

class EmailHandler
{
    protected $mail;

    protected $preview = false;

    /**
     * @var Mailer
     */
    protected $mailer;

    protected $module = '';

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
            'site_logo'        => asset('/images/logo-default.jpg'),//setting('admin_logo') ? TnMedia::url(setting('admin_logo')) : url(config('core.base.general.logo', '')),
            'date_time'        => now()->toDateTimeString(),
            'date_year'        => now()->format('Y'),
            'site_admin_email' => setting('admin_email', ''),
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

    public function sendUsingTemplate($template, $data = [])
    {
        $this->send($this->getTemplateContent($template), $this->getTemplateSubject($template));
    }

    /**
     * @param string $template
     * @param string $type
     * @return string|null
     */
    public function getTemplateContent(string $template, string $type = 'plugins'): ?string
    {
        return File::get(view()->getFinder()->find($template));
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

        $mailable = new EmailAbstract($content, $title, []);

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
     * @return array|string|null
     */
    public function getTemplateSubject($template)
    {
        return setting('email-subject::' .$template, 'subject');
    }
}