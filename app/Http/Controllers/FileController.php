<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileController extends Controller
{
    public function index()
    {
        return File::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        $path = Storage::disk('s3')->put('uploads', $request->file('file'));

        $file = File::create([
            'filename' => $request->file('file')->getClientOriginalName(),
            'path' => $path
        ]);

        return response()->json($file, 201);
    }

    public function show(File $file)
    {
        return response()->json([
            'url' => Storage::disk('s3')->url($file->path)
        ]);
    }

    public function destroy(File $file)
    {
        Storage::disk('s3')->delete($file->path);
        $file->delete();

        return response()->noContent();
    }
}
