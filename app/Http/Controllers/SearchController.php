<?php

namespace App\Http\Controllers;

use App\Models\CarAd;
use App\Models\BikeAd;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query', '');
        $type  = $request->input('type', 'all');

        $car_results  = collect();
        $bike_results = collect();

        if($type == 'all' || $type == 'car') {
            $car_results = CarAd::where('car_info', 'LIKE', "%$query%")
                ->orWhere('city', 'LIKE', "%$query%")
                ->orWhere('vehicle_condition', 'LIKE', "%$query%")
                ->latest()->get();
        }

        if($type == 'all' || $type == 'bike') {
            $bike_results = BikeAd::where('bike_info', 'LIKE', "%$query%")
                ->orWhere('city', 'LIKE', "%$query%")
                ->orWhere('vehicle_condition', 'LIKE', "%$query%")
                ->latest()->get();
        }

        return view('search', compact('car_results', 'bike_results', 'query', 'type'));
    }
}