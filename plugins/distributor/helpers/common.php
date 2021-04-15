<?php
use Illuminate\Support\Arr;
use Ocart\Distributor\Models\DistributorLocation;

if (!function_exists('get_distributor_location')) {
    function get_distributor_location(){
        $data = DistributorLocation::all()->pluck('name', 'code')->toArray();
        return $data;
    }
}
if (!function_exists('get_distributor')) {
    function get_distributor($location = 'hanoi'){
        /** @var \Ocart\Distributor\Repositories\Interfaces\DistributorRepository $repo */
        $repo = app(\Ocart\Distributor\Repositories\Interfaces\DistributorRepository::class)->findByField(['location' => $location]);
        return $repo;
    }
}