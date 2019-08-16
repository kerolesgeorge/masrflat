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
        $finish_type = FinishType::all();
        return FinishTypeResource::collection($finish_type);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $finish_type = FinishType::create($this->validateRequest());
        return new FinishTypeResource($finish_type);
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
        $finish_type = $finishType->delete();
        return new FinishTypeResource($finish_type);
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
