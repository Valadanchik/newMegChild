<?php

namespace App\Services\Frontend;


use App\Models\Country;

use App\Models\Region;


class OrderService
{

    public function getRegions()
    {
        return Region::where('status', true)->orderBy('order')->get();
    }

    public function getCountries()
    {
        return Country::where('status', true)->orderBy('order')->get();
    }


}
