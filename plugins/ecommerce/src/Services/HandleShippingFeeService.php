<?php

namespace Ocart\Ecommerce\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Ocart\Ecommerce\Models\Shipping;
use Ocart\Ecommerce\Models\ShippingRule;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShippingRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShippingRuleRepository;
use Ocart\Ecommerce\Repositories\Interfaces\StoreRepository;

class HandleShippingFeeService
{

    /**
     * @var ShippingRepository
     */
    protected $shippingRepository;

    /**
     * @var ShippingRuleRepository
     */
    protected $shippingRuleRepository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var StoreRepository
     */
    protected $storeLocatorRepository;

    /**
     * PublicController constructor.
     * @param ShippingRepository $shippingRepository
     * @param ShippingRuleRepository $shippingRuleRepository
     * @param ProductRepository $productRepository
     * @param StoreRepository $storeLocatorRepository
     */
    public function __construct(
        ShippingRepository $shippingRepository,
        ShippingRuleRepository $shippingRuleRepository,
        ProductRepository $productRepository,
        StoreRepository $storeLocatorRepository
    ) {
        $this->shippingRepository = $shippingRepository;
        $this->shippingRuleRepository = $shippingRuleRepository;
        $this->productRepository = $productRepository;
        $this->storeLocatorRepository = $storeLocatorRepository;
    }

    /**
     * @param array $data
     * @param null $method
     * @param null $option
     * @return array
     */
    public function execute(array $data, $method = null, $option = null)
    {
        $callback = 'getFeeShipping' . \Str::ucfirst($method);

        if (method_exists($this, $callback)) {
            return $this->{$callback}($data, $option);
        }

        return $this->getFeeShippingDefault($data, $option);
    }

    /**
     * @param array $data
     * @param null $option
     * @return array
     */
    public function getFeeShippingDefault(array $data, $option = null)
    {
        $orderTotal = Arr::get($data, 'order_total', 0);
        $weight = 0.1;

        $shipping = $this->shippingRepository
            ->findByField('country', Arr::get($data, 'country'))
            ->first();

        if (!empty($shipping)) {
             return $this->calculateDefaultFeeByAddress(
                $shipping,
                $weight,
                $orderTotal,
                Arr::get($data, 'city'),
                $option
            );
        }

        $default = $this->shippingRepository
            ->getModel()
            ->whereNull('country')
            ->first();

        return $this->calculateDefaultFeeByAddress(
            $default,
            $weight,
            $orderTotal,
            Arr::get($data, 'city'),
            $option
        );
    }

    /**
     * @param Shipping $address
     * @param int $weight
     * @param int $orderTotal
     * @param string $city
     * @param null $option
     * @return array
     */
    protected function calculateDefaultFeeByAddress($address, $weight, $orderTotal, $city, $option = null)
    {
//        $weight = ecommerce_convert_weight($weight);
        $result = [];

        if ($address) {
            $rules = $this->shippingRuleRepository
                ->getModel()
                ->where(function (Builder $query) use ($orderTotal, $address) {
                    $query
                        ->where('shipping_id', $address->id)
                        ->where('type', 'base_on_price')
                        ->where('from', '<=', $orderTotal)
                        ->where(function (Builder $sub) use ($orderTotal) {
                            $sub
                                ->whereNull('to')
                                ->orWhere('to', '<=', 0)
                                ->orWhere('to', '>=', $orderTotal);
                        });
                })
                ->orWhere(function (Builder $query) use ($weight, $address) {
                    $query
                        ->where('shipping_id', $address->id)
                        ->where('type', 'base_on_weight')
                        ->where('from', '<=', $weight)
                        ->where(function (Builder $sub) use ($weight) {
                            $sub
                                ->whereNull('to')
                                ->orWhere('to', '<=', 0)
                                ->orWhere('to', '>=', $weight);
                        });
                })
                ->get();

            foreach ($rules as $rule) {
                /**
                 * @var ShippingRule $rule
                 */
//                $ruleDetail = $rule
//                    ->items()
//                    ->where('city', $city)
//                    ->where('is_enabled', 1)
//                    ->first();
//                if ($ruleDetail) {
//                    $result[$rule->id] = [
//                        'name'  => $rule->name,
//                        'price' => $rule->price + $ruleDetail->adjustment_price,
//                    ];
//                } else {
//                    $result[$rule->id] = [
//                        'name'  => $rule->name,
//                        'price' => $rule->price,
//                    ];
//                }

                $result[] = [
                    'value' => $rule->id,
                    'name'  => $rule->name,
                    'price' => $rule->price,
                ];
            }
        }

        return $result;
    }
}
