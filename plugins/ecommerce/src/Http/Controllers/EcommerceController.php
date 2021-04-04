<?php

namespace Ocart\Ecommerce\Http\Controllers;

use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Ecommerce\Http\Requests\UpdateSettingRequest;
use Ocart\Setting\SettingManager;
use Ocart\Setting\SettingStore;

class EcommerceController extends BaseController
{
    public function getSettings()
    {
        page_title()->setTitle(trans('plugins/ecommerce::ecommerce.settings'));

        return view('plugins/ecommerce::settings.index');
    }

    public function postSettings(
        BaseHttpResponse $response,
        SettingManager $settingStore,
        UpdateSettingRequest $request)
    {
        foreach ($request->except(['_token', 'currencies', 'deleted_currencies', 'available_countries']) as $settingKey => $settingValue) {
            $settingStore->set(config('plugins.ecommerce.general.prefix') . $settingKey, $settingValue);
        }

        $settingStore->save();

        $currencies = $request->get('currencies', []);
        $dataCurrencies = [];
        foreach ($currencies['title'] as $key => $value) {
            if (empty($value) || empty($currencies['symbol'][$key])) {
                continue;
            }

            $currency['order'] = $key;
            $currency['title'] = $value;
            $currency['id'] = \Arr::get($currencies, 'id.'.$key);
            $currency['symbol'] = $currencies['symbol'][$key];
            $currency['decimals'] = $currencies['decimals'][$key];
            $currency['exchange_rate'] = $currencies['exchange_rate'][$key];
            $currency['is_prefix_symbol'] = $currencies['is_prefix_symbol'][$key];

            $dataCurrencies[] = $currency;
        }

        dd($dataCurrencies);

        return $response->setNextUrl(route('ecommerce.settings'));
    }
}