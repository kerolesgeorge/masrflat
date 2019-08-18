<?php

namespace App\Http\Controllers;

use App\FinishType;
use Illuminate\Http\Request;
use App\Http\Resources\FinishType as FinishTypeResource;

class FinishTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finishtype = FinishType::all();
        return FinishTypeResource::collection($finishtype);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $finishtype = FinishType::create($this->validateRequest());
        return new FinishTypeResource($finishtype);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinishType $finishtype)
    {
        $finishtype->update($this->validateRequest());
        return new FinishTypeResource($finishtype);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinishType $finishtype)
    {
        $finishtype->delete();
        return new FinishTypeResource($finishtype);
    }

    /**
     * Validate request
     */
    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required | unique:finish_types',
        ]);
    }
}
