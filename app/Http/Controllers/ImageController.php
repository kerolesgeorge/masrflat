<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::all();
        return view('images', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $images = Collection::wrap(request()->file('file'));
        $images->each(function($image) {
            $path = $image->store('uploads', 'public');
            Image::create([
                'url' => $path,
                'estate_id' => 1,
            ]);

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        // Delete file (Illuminate\Support\Facades\File)
        File::delete([
            public_path("storage/{$image->url}"),
        ]);

        // Delete Record
        $deleted = $image->delete();
        return json_encode($deleted);

    }
}
