<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage\Featured;
use App\Models\Homepage\Accordion;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    public function update(Request $request, $id)
    {
        $featured = Featured::findOrFail($id);
        $data = $request->validate([
            'judul' => 'required|string',
            'sub_judul' => 'required|string',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('featureds', 'public');
        }

        $featured->update($data);
        return back()->with('success', 'Featured berhasil diupdate!');
    }

    // Accordion CRUD
    public function storeAccordion(Request $request)
    {
        $data = $request->validate([
            'featured_id' => 'required|exists:featureds,id',
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string'
        ]);

        Accordion::create($data);
        return back()->with('success', 'Accordion berhasil ditambahkan!');
    }

    public function updateAccordion(Request $request, Accordion $accordion)
    {
        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string'
        ]);

        $accordion->update($data);
        return back()->with('success', 'Accordion berhasil diupdate!');
    }

    public function destroyAccordion(Accordion $accordion)
    {
        $accordion->delete();
        return back()->with('success', 'Accordion berhasil dihapus!');
    }
}
