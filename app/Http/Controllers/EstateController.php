<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Http\Resources\Estate as EstateResource;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estates = Estate::select('id', 'title')->get();
        return EstateResource::collection($estates);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $estate = Estate::create($this->validateRequest());
        // Return last inserted id
        //$id = $estate->id;
        return new EstateResource($estate);
    }

    /**
     * Display the specified resource.
     */
    public function show(Estate $estate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estate $estate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estate $estate)
    {
        //
    }

    /**
     * Validate request
     */
    private function validateRequest()
    {
        $request = [
            'title' => 'required',
            'neighbourhood_id' => 'required',
            'type_id' => 'required',
            'contract_id' => 'required',
            'finish_type_id' => 'required',
            'view_id' => 'required',
            'area' => 'required | numeric',
        ];

        if (request()->has('floor_number'))
            $request['floor_number'] = 'numeric';

        if (request()->has('number_of_rooms'))
            $request['number_of_rooms'] = 'numeric';

        if (request()->has('number_of_bathrooms'))
            $request['number_of_bathrooms'] = 'numeric';

        if (request()->has('number_of_living_spaces'))
            $request['number_of_living_spaces'] = 'numeric';

        if (request()->has('number_of_balconies'))
            $request['number_of_balconies'] = 'numeric';

        if (request()->has('build_year'))
            $request['build_year'] = 'numeric';

        return request()->validate($request);
    }
}
