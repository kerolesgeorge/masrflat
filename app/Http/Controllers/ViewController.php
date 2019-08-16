<?php

namespace App\Http\Controllers;

use App\View;
use Illuminate\Http\Request;
use App\Http\Resources\View as ViewResource;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $views = View::all();
        return ViewResource::collection($views);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $view = View::create($this->validateRequest());
        return new ViewResource($view);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( View $view)
    {
        $view->update($this->validateRequest());
        return new ViewResource($view);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        $view->delete();
        return new ViewResource($view);
    }

    /**
     * Validate request
     */
    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required | unique:views',
        ]);
    }
}
