<?php

namespace Ocart\Ecommerce\Supports;

use Html;

class OrderHelper
{
    public function processHistoryVariables($history)
    {
        if (empty($history)) {
            return null;
        }


        $variables = [
            'order_id'  => Html::link(route('ecommerce.orders.update', $history->order->id), $history->order->code)
                ->toHtml(),
            'user_name' => '<strong>' . ($history->user_id === 0 ? trans('plugins/ecommerce::orders.system') :
                ($history->user ? $history->user->name : ($history->order->user->name ?
                    $history->order->user->name :
                    $history->order->address->name
                ))) .'</strong>',
        ];

        $content = $history->description;

        foreach ($variables as $key => $value) {
            $content = str_replace('% ' . $key . ' %', $value, $content);
            $content = str_replace('%' . $key . '%', $value, $content);
            $content = str_replace('% ' . $key . '%', $value, $content);
            $content = str_replace('%' . $key . ' %', $value, $content);
        }

        return $content;
    }
}