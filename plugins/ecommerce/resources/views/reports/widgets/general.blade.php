<style>
    .wc_status_list li {
        width              : 50%;
        float              : left;
        padding            : 0;
        -webkit-box-sizing : border-box;
        box-sizing         : border-box;
        margin             : 0;
        color              : #aaa
    }

    .wc_status_list li a {
        display            : block;
        color              : #aaa;
        padding            : 9px 12px;
        -webkit-transition : all ease .5s;
        transition         : all ease .5s;
        position           : relative;
        font-size          : 12px
    }

    .wc_status_list li a strong {
        font-size   : 18px;
        line-height : 1.2em;
        font-weight : 400;
        display     : block;
        color       : #21759b
    }

    .wc_status_list li a:hover {
        color : #2ea2cc
    }

    .wc_status_list li a:hover strong, .wc_status_list li a:hover::before {
        color : #2ea2cc !important
    }

    .wc_status_list li a::before {
        font-family : Font Awesome\ 5 Free;
        speak          : none;
        font-weight    : 900;
        font-variant   : normal;
        text-transform : none;
        margin         : 0;
        text-indent    : 0;
        top            : 0;
        left           : 0;
        height         : 100%;
        text-align     : center;
        content        : "";
        font-size      : 2em;
        position       : relative;
        width          : auto;
        line-height    : 1.2em;
        color          : #c7c7c7;
        float          : left;
        margin-right   : 12px;
        margin-bottom  : 12px
    }

    .wc_status_list li:first-child {
        border-top : 0
    }

    .wc_status_list li.sales-this-month {
        width : 100%
    }

    .wc_status_list li.sales-this-month a::before {
        content     : '\f201'
    }

    .wc_status_list li.best-seller-this-month a::before {
        content : '\e006'
    }

    .wc_status_list li.processing-orders a::before {
        content : '\f48b';
        color   : #7ad03a
    }

    .wc_status_list li.completed-orders a::before {
        content : '\f48b';
        color   : #999
    }

    .wc_status_list li.low-in-stock a::before {
        content : '\f06a';
        color   : #ffba00
    }

    .wc_status_list li.out-of-stock a::before {
        content : '\f057';
        color   : #a00;
        font-weight : 400;
    }
</style>

<ul class="wc_status_list">
    <li class="border-t dark:border-gray-600 sales-this-month">
        <a href="#">
                <strong>
                    {{ format_price($revenue) }}
                </strong> {{ trans('plugins/ecommerce::reports.revenue_this_month') }}
        </a>
    </li>
    <li class="border-t border-r dark:border-gray-600 processing-orders">
        <a href="#">
            <strong>{{ $processingOrders }}</strong> {{ trans('plugins/ecommerce::reports.order_processing_this_month') }}
        </a>
    </li>
    <li class="border-t dark:border-gray-600 completed-orders">
        <a href="#">
            <strong>{{ $completedOrders }}</strong> {{ trans('plugins/ecommerce::reports.order_completed_this_month') }}
        </a>
    </li>
    <li class="border-t border-r dark:border-gray-600 low-in-stock">
        <a href="#">
            <strong>{{ $lowStockProducts }}</strong> {{ trans('plugins/ecommerce::reports.product_will_be_out_of_stock') }}
        </a>
    </li>
    <li class="border-t dark:border-gray-600 out-of-stock">
        <a href="#">
            <strong>{{ $outOfStockProducts }}</strong> {{ trans('plugins/ecommerce::reports.product_out_of_stock') }}
        </a>
    </li>
</ul>