<?php

namespace App\Http\Controllers;

use App\Models\CarAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarAdController extends Controller
{
    public function index()
    {
        $car_ads = CarAd::where('user_id', Auth::id())->latest()->get();
        return view('car-ads.index', compact('car_ads'));
    }

    public function create()
    {
        return view('car-ads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'city'             => 'required|string',
            'car_info'         => 'required|string',
            'registered_in'    => 'required|string',
            'exterior_color'   => 'required|string',
            'mileage'          => 'required|integer',
            'engine_type'      => 'required|string',
            'vehicle_condition'=> 'required|string',
            'description'      => 'required|string',
            'price'            => 'required|numeric',
            'mobile_number'    => 'required|string',
            'image_1'          => 'nullable|image|max:5120',
            'image_2'          => 'nullable|image|max:5120',
            'image_3'          => 'nullable|image|max:5120',
            'image_4'          => 'nullable|image|max:5120',
            'image_5'          => 'nullable|image|max:5120',
        ]);

        $data = $request->except(['image_1','image_2','image_3','image_4','image_5']);
        $data['user_id'] = Auth::id();

        foreach(['image_1','image_2','image_3','image_4','image_5'] as $img) {
            if($request->hasFile($img)) {
                $data[$img] = $request->file($img)->store('ads/cars', 'public');
            }
        }

        CarAd::create($data);

        return redirect()->route('car-ads.index')->with('success', 'Car Ad posted successfully!');
    }

    public function show($id)
    {
        $car = CarAd::findOrFail($id);
        return view('car-ads.show', compact('car'));
    }

    public function edit($id)
    {
        $car = CarAd::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('car-ads.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $car = CarAd::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $data = $request->except(['image_1','image_2','image_3','image_4','image_5']);

        foreach(['image_1','image_2','image_3','image_4','image_5'] as $img) {
            if($request->hasFile($img)) {
                if($car->$img) Storage::disk('public')->delete($car->$img);
                $data[$img] = $request->file($img)->store('ads/cars', 'public');
            }
        }

        $car->update($data);

        return redirect()->route('car-ads.index')->with('success', 'Car Ad updated successfully!');
    }

    public function destroy($id)
    {
        $car = CarAd::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        foreach(['image_1','image_2','image_3','image_4','image_5'] as $img) {
            if($car->$img) Storage::disk('public')->delete($car->$img);
        }

        $car->delete();

        return redirect()->route('car-ads.index')->with('success', 'Car Ad deleted successfully!');
    }
}