<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage\Accordion;
use Illuminate\Http\Request;

class AccordionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'featured_id' => 'required|exists:featureds,id',
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        Accordion::create($request->all());

        return back()->with('success', 'Accordion berhasil ditambahkan.');
    }

    public function update(Request $request, Accordion $accordion)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        $accordion->update($request->all());

        return back()->with('success', 'Accordion berhasil diperbarui.');
    }

    public function destroy(Accordion $accordion)
    {
        $accordion->delete();
        return back()->with('success', 'Accordion berhasil dihapus.');
    }
}
