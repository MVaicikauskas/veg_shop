<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageUploadController extends Controller
{
    public function index()
    {
        $images = Image::all();

        return view('image.index', compact('images'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg, png, img, jpeg|max:2048'
        ]);

        $name = $request->file('image')->getClientOriginalName();

        // $path = $request->file('image')->store('public');
        $request->image->move(public_path('images'), $name);
        $path = 'images/'.$name;

        $image = new Image;
        $image->name = $name;
        $image->path = $path;
        $image->save();

        return redirect()->route('image.index');
    }
}
