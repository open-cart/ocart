<?php

namespace Ocart\Ecommerce\Widgets;

use Ocart\Dashboard\Supports\StatsWidget;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;

class ProductStatsWidget extends StatsWidget
{

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function buildWidget()
    {
        parent::buildWidget();

        $this->setTotal($this->productRepository->count());
    }
}