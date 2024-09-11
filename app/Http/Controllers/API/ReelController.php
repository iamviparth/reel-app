<?php

namespace App\Http\Controllers\API;

use App\Models\Reel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReelController extends Controller
{
    // Upload a reel
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:20000', // Limit to 20MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $videoPath = $request->file('video')->store('reels', 'public');

        $reel = Reel::create([
            'title' => $request->title,
            'video_path' => $videoPath,
        ]);

        return response()->json(['message' => 'Reel uploaded successfully', 'reel' => $reel], 201);
    }

    // List all reels
    public function index()
    {
        $reels = Reel::all();
        return response()->json($reels);
    }

    // Show a specific reel
    public function show($id)
    {
        $reel = Reel::find($id);
        if (!$reel) {
            return response()->json(['message' => 'Reel not found'], 404);
        }

        return response()->json($reel);
    }
}
