<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Http\Resources\Estate as EstateResource;
use App\Image;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    protected $estate_id;
    protected $attached = [];

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
        $this->estate_id = $estate->id;

        // Upload images
        if (request()->hasFile('images')) {
            Image::create([
                'estate_id' => $this->estate_id,
                'url' => '',
            ]);

        }

        return new EstateResource($estate);
    }

    /**
     * Upload images function
     */
    public function uploadImages()
    {
        $images = Collection::wrap(request('images'));
        $images->each(function($image) {
            $path = $image->store('uploads', 'public');

            // Push new image url to array
            $images = [
                "url" => $path,
            ];
            //$this->attached = array_merge($images, $this->attached);
            $this->attached[] = $images;

            // Get image width and height and resize
            $height = InterventionImage::make($image)->height();
            $width = InterventionImage::make($image)->width();

            // Check for image orientation
            if ($width > $height) {
                InterventionImage::make($image)
                ->resize(1000, 700)
                ->save(public_path("storage/{$path}"));
            } else {
                InterventionImage::make($image)
                ->resize(700, 1000)
                ->save(public_path("storage/{$path}"));
            }

        });

        return json_encode($this->attached);

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

    /**
     * Validate images
     */
    private function validateImage()
    {
        return request()->validate([
            'images' => 'required',
            'images.*' => 'image'
        ]);
    }
}
