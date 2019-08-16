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
        $finishType = FinishType::all();
        return FinishTypeResource::collection($finishType);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $finishType = FinishType::create($this->validateRequest());
        return new FinishTypeResource($finishType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinishType $finishType)
    {
        $finishType->update($this->validateRequest());
        return new FinishTypeResource($finishType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinishType $finishType)
    {
        $finishType->delete();
        return new FinishTypeResource($finishType);
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
