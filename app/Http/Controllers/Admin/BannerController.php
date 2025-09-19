<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string',
            'sub_judul' => 'required|string',
            'kategori' => 'required|string',
            'gambar' => 'required|image|max:10240'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('banners', 'public');
        }

        Banner::create($data);
        return back()->with('success', 'Banner berhasil ditambahkan!');
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'judul' => 'required|string',
            'sub_judul' => 'required|string',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|max:10240'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('banners', 'public');
        }

        $banner->update($data);
        return back()->with('success', 'Banner berhasil diupdate!');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return back()->with('success', 'Banner berhasil dihapus!');
    }
}
