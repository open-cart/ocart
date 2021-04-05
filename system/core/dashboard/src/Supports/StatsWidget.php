<?php

namespace Ocart\Dashboard\Supports;

class StatsWidget extends AbstractDashboardWidget
{
    protected $template = 'core.dashboard::widgets.stats';

    public $total = 0;

    /**
     * @param int $total
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    public function buildWidget()
    {
    }
}