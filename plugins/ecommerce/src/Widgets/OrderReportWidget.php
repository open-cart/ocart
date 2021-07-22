<?php

namespace Ocart\Ecommerce\Widgets;

use Ocart\Dashboard\Supports\BaseWidget;

class OrderReportWidget extends BaseWidget
{
    public function getUrl()
    {
        return route('ecommerce.report.dashboard-widget.general');
    }

}