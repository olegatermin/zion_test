<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Video;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->validate([
            'username' => 'required|exists:users,name'
        ]);
        
        $user = User::where('name', $input['username'])->first();

        return [
            'status' => 'success',
            'data' => [
                'total_size' => $user->videos->sum('size')
            ]
        ];
    }

    public function show(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        return [
            'status' => 'success',
            'data' => $video
        ];
    }

    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'size' => 'integer',
            'viewers' => 'integer'
        ]);

        $video = Video::findOrFail($id);
        $video->update($input);

        return [
            'status' => 'success',
            'data' => $video
        ];
    }
}
