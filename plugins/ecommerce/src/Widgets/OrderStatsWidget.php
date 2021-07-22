<?php

namespace Ocart\Ecommerce\Widgets;

use Ocart\Dashboard\Supports\StatsWidget;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

class OrderStatsWidget extends StatsWidget
{

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function buildWidget()
    {
        parent::buildWidget();

        $this->setTotal($this->orderRepository->count());
    }
}