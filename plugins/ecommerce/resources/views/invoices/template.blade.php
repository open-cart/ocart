<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ trans('plugins/ecommerce::orders.invoice_for_order') }} {{ $order->code }}</title>
    <style>
        .invoice-box {
            max-width: 1000px;
            margin: auto;
            /*padding: 20px;*/
            /*border: 1px solid #eee;*/
            /*box-shadow: 0 0 10px rgba(0, 0, 0, .15);*/
            font-size: 13px;
            line-height: 24px;
            font-family: DejaVu Sans, Helvetica, Arial, sans-serif;
            color: #555;
            font-weight: 400;
        }

        .font-bold {
            font-weight: 700;
        }

        .invoice-box table {
            text-align: left;
            width: 100%
        }

        .invoice-box table td {
            padding: 7px 0;
            vertical-align: top
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px
        }

        .invoice-box table tr.heading th {
            /*background: #eee;*/
            border-bottom: 3px solid #ddd;
            font-weight: 700;
            color: #a9a9aa;
            padding: 7px 0;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
            padding-top: 20px
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            padding: 7px 0;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none
        }

        .invoice-box table tr.total td:nth-child(2) {
            /*border-top: 2px solid #eee;*/
            font-weight: 700
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.information table td, .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center
            }
        }

        .rtl {
            direction: rtl;
            font-family: Tahoma, Arial, sans-serif
        }

        .rtl table {
            text-align: right
        }

        .rtl table tr td:nth-child(2) {
            text-align: left
        }
        .text-right {
            text-align: right !important;
        }
        .text-left {
            text-align: left !important;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="5">
                <table>
                    <tr>
                        <td style="width: 150px;">
{{--                            @if (theme_option('logo'))--}}
{{--                                <img src="{{ TnMedia::getImageUrl(theme_option('logo')) }}" style="width:100%; max-width:150px;" alt="{{ theme_option('site_title') }}">--}}
{{--                            @endif--}}
                        </td>

                        <td>
                            {{ trans('plugins/ecommerce::orders.invoice') }}: {{ $order->code }}<br>
                            {{ trans('plugins/ecommerce::orders.created') }}: {{ now()->format('F d, Y') }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="5">
                <table>
                    <tr>
                        <td>
                            {{ $order->address->name }}<br>
                            {{ $order->address->address }}<br>
                            {{ $order->address->email }} <br>
                            {{ $order->address->phone ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $order->user->name ? $order->user->name : $order->address->name }}<br>
                            {{ $order->user->email ? $order->user->email : $order->address->email }}<br>
                            {{ $order->user->phone ? $order->user->phone : $order->address->phone }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <th class="text-left">{{ trans('plugins/ecommerce::products.form.product') }}</th>
            <th class="text-left">{{ trans('plugins/ecommerce::products.form.options') }}</th>
            <th style="width: 75px;" class="text-right">{{ trans('plugins/ecommerce::products.form.quantity') }}</th>
            <th style="width: 100px;" class="text-right">{{ trans('plugins/ecommerce::products.form.price') }}</th>
            <th style="width: 120px;" class="text-right">{{ trans('plugins/ecommerce::products.form.total') }}</th>
        </tr>

        @foreach ($order->products as $orderProduct)
            @php
                $product = $orderProduct->product;
            @endphp
            @if (!empty($product))
                <tr class="item">
                    <td class="text-left">{{ $product->name }}</td>
                    <td class="text-left">(Color: red, Size: XXL)</td>
{{--                    <td>--}}
{{--                        @php $attributes = get_product_attributes($product->id); @endphp--}}
{{--                        @if (!empty($attributes))--}}
{{--                            @foreach ($attributes as $attribute)--}}
{{--                                @if (!$loop->last)--}}
{{--                                    {{ $attribute->attribute_set_title }}: {{ $attribute->title }} <br>--}}
{{--                                @else--}}
{{--                                    {{ $attribute->attribute_set_title }}: {{ $attribute->title }}--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                        @if (!empty($orderProduct->options) && is_array($orderProduct->options))--}}
{{--                            @foreach($orderProduct->options as $option)--}}
{{--                                @if (!empty($option['key']) && !empty($option['value']))--}}
{{--                                    <p class="mb-0"><small>{{ $option['key'] }}: <strong> {{ $option['value'] }}</strong></small></p>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </td>--}}
                    <td class="text-right font-bold"> {{ $orderProduct->qty }} </td>
                    <td class="text-right font-bold">
                        @if ($product->sell_price != $product->price)
                            {!! htmlentities(format_price($product->sell_price)) !!}
                            <del>{!! htmlentities(format_price($product->price)) !!}</del>
                        @else
                            {!! htmlentities(format_price($product->sell_price)) !!}
                        @endif
                    </td>
                    <td class="text-right font-bold">
                        {!! htmlentities(format_price($product->sell_price * $orderProduct->qty)) !!}
                    </td>
                </tr>
            @endif
        @endforeach

        <tr class="total">
            <td colspan="4" class="text-right">
                <p>{{ trans('plugins/ecommerce::products.form.sub_total') }}</p>
                <p>{{ trans('plugins/ecommerce::products.form.shipping_fee') }}</p>
                <p>{{ trans('plugins/ecommerce::products.form.discount') }}</p>
                <p>{{ trans('plugins/ecommerce::products.form.total') }}</p>
            </td>
            <td class="text-right font-bold">
                <p>{!! htmlentities(format_price($order->sub_total)) !!}</p>
                <p>{!! htmlentities(format_price($order->shipping_amount)) !!}</p>
                <p>{!! htmlentities(format_price($order->discount_amount)) !!}</p>
                <p>{!! htmlentities(format_price($order->amount)) !!}</p>
            </td>
        </tr>
        <tr class="heading">
            <th colspan="4" class="text-left">
                Payment info
            </th>
            <th class="text-right">
                {{ trans('plugins/ecommerce::products.form.total') }}
            </th>
        </tr>

        <tr class="details">
            <td colspan="4">
                <div>
                    {{ trans('plugins/ecommerce::orders.payment_method') }}: {{ $order->payment->payment_channel->label() }}
                </div>
                <div>
                    {{ trans('plugins/ecommerce::orders.payment_status_label') }}: {{ $order->payment->status->label() }}
                </div>
            </td>
            <td class="text-right font-bold">
                {!! htmlentities(format_price($order->amount)) !!}
            </td>
        </tr>
    </table>
</div>
</body>
</html>
