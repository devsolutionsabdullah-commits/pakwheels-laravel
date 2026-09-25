<?php

namespace App\Http\Controllers;

use App\Models\CarAd;
use App\Models\BikeAd;

class HomeController extends Controller
{
    public function index()
    {
        $new_bikes = BikeAd::where('vehicle_condition', 'new')
                    ->latest()->take(4)->get();

        $used_bikes = BikeAd::where('vehicle_condition', 'used')
                    ->latest()->take(4)->get();

        $new_cars = CarAd::where('vehicle_condition', 'new')
                    ->latest()->take(4)->get();

        $used_cars = CarAd::where('vehicle_condition', 'used')
                    ->latest()->take(4)->get();

        $total_cars = CarAd::count();
        $total_bikes = BikeAd::count();

        return view('home', compact(
            'new_bikes', 'used_bikes',
            'new_cars', 'used_cars',
            'total_cars', 'total_bikes'
        ));
    }
}
