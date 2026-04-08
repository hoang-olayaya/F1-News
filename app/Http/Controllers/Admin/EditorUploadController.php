<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EditorUploadController extends Controller
{
    public function upload(\Illuminate\Http\Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            // Generate unique filename
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Store file in public/uploads folder
            $file->storeAs('uploads', $fileName, 'public');

            // EXACT JSON FORMAT REQUIRED BY CKEDITOR
            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => asset('storage/uploads/' . $fileName)
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'Upload failed']
        ]);
    }
}
