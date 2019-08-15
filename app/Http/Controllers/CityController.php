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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return CityResource::collection($cities);
        /* return view('admin/cities.index', [
            'cities' => $cities
        ]); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $city = City::create($this->validateCity());
        return new CityResource($city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(City $city)
    {
        $city->update($this->validateCity());
        return new CityResource($city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        //return redirect('/admin/cities');
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
    private function validateCity()
    {
        return request()->validate([
            'name' => 'required | unique:cities',
        ]);
    }
}
