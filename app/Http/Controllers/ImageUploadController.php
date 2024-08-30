<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Image;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
 
        $image = $request->file('image');
        $imagePath = $this->processImage($image);
 
        // Сохранение в облако (например, AWS S3)
        Storage::disk('s3')->put($imagePath, file_get_contents($image));
 
        return response()->json(['url' => Storage::disk('s3')->url($imagePath)], 201);
    }
 
    private function processImage($image)
    {
        // Логика изменения размера изображения
        // Например, используем Intervention Image
        $img = Image::make($image)->resize(800, 600);
        $imagePath = 'images/' . time() . '.' . $image->getClientOriginalExtension();
        $img->save(public_path($imagePath));
 
        return $imagePath;
    }
}
