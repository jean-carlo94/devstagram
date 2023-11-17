<?php

namespace App\Http\Controllers\Providers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request){

        $image = $request->file('file');

        $name = Str::uuid() . "." . $image->extension();

        $imageServer = Image::make($image);
        $imageServer->fit(1000, 1000);

        $imagePath = public_path('uploads') . '/' . $name;
        $imageServer->save($imagePath);

        return response()->json($name);
    }
}
