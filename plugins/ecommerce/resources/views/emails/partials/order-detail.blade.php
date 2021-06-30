<div class="table">
    <table>
        <tr>
            <th style="text-align: left">
                {{ trans('plugins/ecommerce::products.form.product') }}
            </th>
            <th style="text-align: left">
                {{ trans('plugins/ecommerce::products.form.price') }}
            </th>
            <th style="text-align: left">
                {{ trans('plugins/ecommerce::products.form.quantity') }}
            </th>
            <th style="text-align: left">
                {{ trans('plugins/ecommerce::products.form.total') }}
            </th>
        </tr>

        @foreach ($order->products as $orderProduct)
            @php
                $product = $orderProduct->product;
            @endphp
            <tr>
                <td>
                    {{ $orderProduct->product_name }}
                    @if ($product && $product->attributes)
                        @php
                            $attributes = $product->attributes()->with('attribute.attributeGroup')->get();
                        @endphp
                        @if (!empty($attributes))
                            (<small>
                                @foreach ($attributes as $attribute)
                                    {{ $attribute->attribute->attributeGroup->title }}: {{ $attribute->attribute->title }}@if (!$loop->last), @endif
                                @endforeach
                            </small>)
                        @endif
                    @endif

                    @if (!empty($orderProduct->options) && is_array($orderProduct->options))
                        @foreach($orderProduct->options as $option)
                            @if (!empty($option['key']) && !empty($option['value']))
                                <p class="mb-0"><small>{{ $option['key'] }}: <strong> {{ $option['value'] }}</strong></small></p>
                            @endif
                        @endforeach
                    @endif
                </td>

                <td>
                    {{ format_price($orderProduct->price) }}
                </td>

                <td>
                    x {{ $orderProduct->qty }}
                </td>

                <td>
                    {{ format_price($orderProduct->qty * $orderProduct->price) }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                {{ trans('plugins/ecommerce::products.form.sub_total') }}
            </td>
            <td>
                {{ format_price($order->sub_total) }}
            </td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{{ trans('plugins/ecommerce::products.form.shipping_fee') }}
            </td>
            <td>
                {{ format_price($order->shipping_amount) }}
            </td>
        </tr>

        @if (EcommerceHelper::isTaxEnabled())
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>{{ trans('plugins/ecommerce::products.form.tax') }}
                </td>
                <td>
                    {{ format_price($order->tax_amount) }}
                </td>
            </tr>
        @endif

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{{ trans('plugins/ecommerce::products.form.discount') }}
            </td>
            <td>
                {{ format_price($order->discount_amount) }}
            </td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>

            <td>{{ trans('plugins/ecommerce::products.form.total') }}
            </td>
            <td>
                {{ format_price($order->amount) }}
            </td>
        </tr>
    </table><br>
</div>

