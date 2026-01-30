<?php

namespace App\Services;

class ShippingCostService {

    public static function getShippingCost($province_id, $load){
        $provinceCosts = config('shipping_costs.provinceCosts');
        $categoryCosts = config('shipping_costs.categoryCosts');

        $total = $provinceCosts[$province_id];

        foreach($load as $item)
            $total += $categoryCosts[$item['category_id']]*$item['quantity'];

        return $total;
    }
}