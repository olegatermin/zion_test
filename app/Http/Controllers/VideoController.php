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
        return $user->videos->sum('size');
    }

    public function show(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        return $video;
    }

    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'size' => 'integer',
            'viewers' => 'integer'
        ]);

        $video = Video::findOrFail($id);
        $video->update($request->all());

        return $video;
    }
}
