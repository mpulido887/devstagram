<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');
        $nombreImage = Str::uuid(). '.'. $image->extension();
        $serverImage = Image::make($image);
        $serverImage->fit(1000, 1000); 
        $serverImage->save(public_path('uploads').'/'.$nombreImage);

        return response()->json(['image' => $nombreImage]);
        
        $request->validate([
            'image' => ['image']
        ]);
    }
}
