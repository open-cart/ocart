<?php
namespace Ocart\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Ocart\Core\Facades\EmailHandler;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class SettingController
{

    function getEmailConfig()
    {
        return view('core.setting::email-config');
    }

    public function postEditEmailConfig(Request $request, BaseHttpResponse $response)
    {

        $this->saveSettings($request->except(['_token']));

        return $response
            ->setPreviousUrl(route('settings.email'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param array $data
     */
    protected function saveSettings(array $data)
    {
        foreach ($data as $settingKey => $settingValue) {
            setting()->set($settingKey, $settingValue);
        }

        setting()->save();
    }

    public function getEditEmailTemplate($module, Request $request)
    {
        page_title()->setTitle(trans('core/setting::setting.email.title'));

        $emailContent = EmailHandler::getTemplateContent($request->input('template'));

        $pluginData = [
            'name'          => $module,
            'template_file' => $request->input('template'),
        ];

        return view('core.setting::email-template-edit', [
            'pluginData' => $pluginData,
            'emailContent' => $emailContent
        ]);
    }

    public function postEditEmailTemplate(Request $request, BaseHttpResponse $response)
    {
        EmailHandler::saveTemplateSubject($request->input('template'), $request->input('subject'));

        EmailHandler::saveTemplateContent($request->input('template'), $request->input('email_content'));

        return $response->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function resetToDefaultTemplate(Request $request, BaseHttpResponse $response)
    {

    }
}