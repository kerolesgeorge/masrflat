<?php

namespace App\Http\Controllers;

use App\Http\Resources\Neighbourhood as NeighbourhoodResource;
use App\Neighbourhood;
use Illuminate\Http\Request;
use App\City;
use App\Http\Resources\City as CityResource;

class NeighbourhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $neighbourhoods = Neighbourhood::all();
        return CityResource::collection($neighbourhoods);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $neighbourhood = Neighbourhood::create($this->validateRequest());
        return new NeighbourhoodResource($neighbourhood);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Neighbourhood $neighbourhood)
    {
        $neighbourhood->update($this->validateRequest());
        return new NeighbourhoodResource($neighbourhood);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Neighbourhood $neighbourhood)
    {
        $neighbourhood->delete();
    }

    /**
     * Display the specified resource.
     */
    public function showByCity(City $city)
    {
        $neighbourhoods = $city->neighbourhoods();
        return CityResource::collection($neighbourhoods);
    }

    /**
     * Validate request
     */
    public function validateRequest()
    {
        $request = [];

        if (request()->has('name'))
            $request['name'] = 'required | unique:neighbourhoods';


        if (request()->has('city_id'))
            $request['city_id'] = 'required';


        return request()->validate($request);
    }
}
