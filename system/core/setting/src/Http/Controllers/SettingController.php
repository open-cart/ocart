<?php
namespace Ocart\Setting\Http\Controllers;

use Illuminate\Http\Request;
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
}