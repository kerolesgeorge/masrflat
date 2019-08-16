<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use App\Http\Resources\City as CityResource;
use App\Http\Resources\Neighbourhood as NeighbourhoodResource;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();
        return CityResource::collection($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $city = City::create($this->validateRequest());
        return new CityResource($city);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(City $city)
    {
        $city->update($this->validateRequest());
        return new CityResource($city);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
    }

    /**
     * Show Neighbourhoods by city
     */
    public function showNeighbourhoods(City $city)
    {
        $neighbourhoods = $city->neighbourhoods;
        return NeighbourhoodResource::collection($neighbourhoods);
    }

    /**
     * Validate city request
     */
    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required | unique:cities',
        ]);
    }
}
