<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Models\images;

class uploadImage extends Controller
{
    public static function store(Request $request)
    {
        $image = helper::base64_image($request->image,'images');
        $record= images::create([
            'image'=>$image
        ]);
        return response()->json(['image'=>$record]);
    }
    public static function destroy(images $image)
    {
        helper::deleteFile($image->path);
        $image->delete();
    }
    public function update(Request $request, images $image)
    {
        helper::deleteFile($image->path);
        $img = helper::base64_image($request->image,'images');
        $image->image = $img;$image->save();
        return response()->json(['image'=>$image]);
    }

}
