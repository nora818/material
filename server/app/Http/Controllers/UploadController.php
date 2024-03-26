<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class UploadController extends BaseController
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $file = $request->file('file');
        // $hashedName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $md5Name = md5_file($file->getPathname()) . '.' . $file->getClientOriginalExtension();

        // if (Storage::disk('public')->exists("uploads/$md5Name")) {
        if (Storage::exists("uploads/$md5Name")) {
            $path = Storage::url("uploads/$md5Name");
            return response()->json(['path' => $path]);
        }

        $path = $file->storeAs('uploads', $md5Name, 'public');
        return response()->json(['path' => $path]);
    }
}