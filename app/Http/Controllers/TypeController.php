<?php

namespace App\Http\Controllers;

use App\Http\Resources\Type as TypeResource;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return TypeResource::collection($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $type = Type::create($this->validateType());
        return new TypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Type $type)
    {
        $type->update($this->validateType());
        return new TypeResource($type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
    }

    public function validateType() {
        return request()->validate([
            'name' => 'required | unique:types',
        ]);
    }
}
