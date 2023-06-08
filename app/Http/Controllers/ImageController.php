<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            var_dump($extension);

            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images_post_body'), $fileName);

            $url = asset('images_post_body/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }

        return response()->json(['uploaded' => 0, 'error' => 'No file uploaded']);
    }
}
