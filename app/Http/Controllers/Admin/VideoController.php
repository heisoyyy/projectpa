<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string',
            'link' => 'required|url',
            'thumbnail' => 'nullable|image|max:10240',
            'background' => 'nullable|image|max:10240'
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('videos', 'public');
        }
        if ($request->hasFile('background')) {
            $data['background'] = $request->file('background')->store('videos', 'public');
        }

        Video::create($data);
        return back()->with('success', 'Video berhasil ditambahkan!');
    }

    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'judul' => 'required|string',
            'link' => 'required|url',
            'thumbnail' => 'nullable|image|max:10240',
            'background' => 'nullable|image|max:10240'
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('videos', 'public');
        }
        if ($request->hasFile('background')) {
            $data['background'] = $request->file('background')->store('videos', 'public');
        }

        $video->update($data);
        return back()->with('success', 'Video berhasil diupdate!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return back()->with('success', 'Video berhasil dihapus!');
    }
}
