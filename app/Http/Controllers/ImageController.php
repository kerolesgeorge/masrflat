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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

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
