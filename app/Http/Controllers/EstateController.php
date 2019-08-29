<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Http\Resources\Estate as EstateResource;
use App\Image;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        if (Cache::get('attached')) {
            $images = Cache::get('attached');
            if (count($images)) {
                foreach ($images as $image) {
                    Image::create([
                        'estate_id' => $this->estate_id,
                        'url' => $image['url'],
                    ]);
                }
            }
        }

        // Remove attached items from cache
        Cache::forget('attached');

        return new EstateResource($estate);
    }

    /**
     * Upload images function
     */
    public function uploadAttached()
    {
        // Get cached attached items or set empty array as default
        $this->attached = Cache::get('attached', []);

        $images = Collection::wrap(request('images'));
        $images->each(function($image) {
            $path = $image->store('uploads', 'public');

            // Push new image url to array
            $images = [
                "url" => $path,
            ];
            $this->attached[] = $images;
            //$this->images_array[] = $images;

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


        Cache::put('attached', $this->attached, now()->addMinutes(20));
        return json_encode($this->attached);
    }

    /**
     * Delete attached images
     */
    public function deleteAttached($index)
    {
        // Get array stored in cache
        $this->attached = Cache::get('attached');
        $delete_index = $this->attached[$index];

        // Delete files from storage
        File::delete([
            'storage/' . $delete_index['url']
        ]);

        // Update array and re-cache it
        array_splice($this->attached, $index, 1);
        Cache::put('attached', $this->attached, now()->addMinutes(20));
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
        // Get images to delete first
        $images = $estate->images;

        // Delete images from storage
        foreach ($images as $image) {
            File::delete([
                'storage/' . $image['url']
            ]);
        }

        // Delete record
        $estate->delete();
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
