<?php

namespace App\Http\Controllers;

use App\Models\BikeAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BikeAdController extends Controller
{
    public function index()
    {
        $bike_ads = BikeAd::where('user_id', Auth::id())->latest()->get();
        return view('bike-ads.index', compact('bike_ads'));
    }

    public function create()
    {
        return view('bike-ads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'city'             => 'required|string',
            'bike_info'        => 'required|string',
            'registered_in'    => 'required|string',
            'color'            => 'required|string',
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
                $data[$img] = $request->file($img)->store('ads/bikes', 'public');
            }
        }

        BikeAd::create($data);

        return redirect()->route('bike-ads.index')->with('success', 'Bike Ad posted successfully!');
    }

    public function show($id)
    {
        $bike = BikeAd::findOrFail($id);
        return view('bike-ads.show', compact('bike'));
    }

    public function edit($id)
    {
        $bike = BikeAd::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('bike-ads.edit', compact('bike'));
    }

    public function update(Request $request, $id)
    {
        $bike = BikeAd::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $data = $request->except(['image_1','image_2','image_3','image_4','image_5']);

        foreach(['image_1','image_2','image_3','image_4','image_5'] as $img) {
            if($request->hasFile($img)) {
                if($bike->$img) Storage::disk('public')->delete($bike->$img);
                $data[$img] = $request->file($img)->store('ads/bikes', 'public');
            }
        }

        $bike->update($data);

        return redirect()->route('bike-ads.index')->with('success', 'Bike Ad updated successfully!');
    }

    public function destroy($id)
    {
        $bike = BikeAd::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        foreach(['image_1','image_2','image_3','image_4','image_5'] as $img) {
            if($bike->$img) Storage::disk('public')->delete($bike->$img);
        }

        $bike->delete();

        return redirect()->route('bike-ads.index')->with('success', 'Bike Ad deleted successfully!');
    }
}