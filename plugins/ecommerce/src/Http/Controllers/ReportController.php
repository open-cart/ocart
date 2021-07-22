<?php

namespace Ocart\Ecommerce\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Ecommerce\Enums\OrderStatusEnum;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Payment\Enums\PaymentStatusEnum;

class ReportController
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    public function __construct(
        OrderRepository $orderRepository,
        ProductRepository $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }


    /**
     * @param BaseHttpResponse $response
     */
    public function getDashboardWidgetGeneral(BaseHttpResponse $response)
    {
        $startOfMonth = now()->startOfMonth()->toDateString();
        $today = now()->toDateString();

        $processingOrders = $this->orderRepository
            ->getModel()
            ->where(['status' => OrderStatusEnum::PENDING])
            ->where('created_at', '>=', $startOfMonth)
            ->where('created_at', '<=', $today)
            ->count();

        $completedOrders = $this->orderRepository
            ->getModel()
            ->where(['status' => OrderStatusEnum::COMPLETED])
            ->where('created_at', '>=', $startOfMonth)
            ->where('created_at', '<=', $today)
            ->count();

        $revenue = $this->orderRepository->getModel()
            ->join('payments', 'payments.id', '=', 'ecommerce_orders.payment_id')
            ->where('payments.created_at', '>=', $startOfMonth)
            ->where('payments.created_at', '<=', $today)
            ->where('payments.status', PaymentStatusEnum::COMPLETED)
            ->sum(DB::raw('COALESCE(payments.amount, 0) - COALESCE(payments.refunded_amount, 0)'));


        $lowStockProducts = $this->productRepository
            ->getModel()
//            ->where('with_storehouse_management', 1)
//            ->where('quantity', '<', 2)
//            ->where('quantity', '>', 0)
            ->count();

        $outOfStockProducts = $this->productRepository
            ->getModel()
//            ->where('with_storehouse_management', 1)
//            ->where('quantity', '<', 1)
            ->count();

        return $response
            ->setData(
                view('plugins.ecommerce::reports.widgets.general',
                    compact(
                        'processingOrders',
                        'revenue',
                        'completedOrders',
                        'outOfStockProducts',
                        'lowStockProducts'
                    )
                )
                    ->render()
            );
    }
}