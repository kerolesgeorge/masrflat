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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::get();
        return CityResource::collection($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $neighbourhood = Neighbourhood::create($this->validateNeighbourhood());
        return new NeighbourhoodResource($neighbourhood);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function showByCity(City $city)
    {
        $neighbourhoods = $city->neighbourhoods();
        return CityResource::collection($neighbourhoods);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function update(Neighbourhood $neighbourhood)
    {
        $neighbourhood->update($this->validateNeighbourhood());
        return new NeighbourhoodResource($neighbourhood);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function destroy(Neighbourhood $neighbourhood)
    {
        $neighbourhood->delete();
    }

    public function validateNeighbourhood()
    {
        return request()->validate([
            'name' => 'required',
            'city_id' => 'required',
        ]);
    }
}
