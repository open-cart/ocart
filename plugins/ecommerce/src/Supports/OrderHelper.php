<?php

namespace Ocart\Ecommerce\Supports;

use Html;
use Illuminate\Support\Facades\File;

class OrderHelper
{
    /**
     * @param $history
     * @return string|string[]|null
     */
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

    /**
     * @param $order
     * @return mixed
     */
    public function generateInvoice($order)
    {
        $folderPath = storage_path('app/public');
        if (!File::isDirectory($folderPath)) {
            File::makeDirectory($folderPath);
        }

        $invoice = $folderPath . '/invoice-order-' . $order->code . '.pdf';

        if (File::exists($invoice)) {
            return $invoice;
        }

        return \PDF::loadView('plugins.ecommerce::invoices.template', compact('order'))
            ->setPaper('a4')
            ->setWarnings(false)
            ->stream('/invoice-order-' . $order->code . '.pdf');
    }
}