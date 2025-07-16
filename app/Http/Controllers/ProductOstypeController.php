<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ostype;

class ProductOstypeController extends Controller
{
    public function index(Request $request)
    {
        $ostype = Ostype::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%')
                      ->orWhere('description', 'like', '%' . $request->q . '%');
            })
            ->orderBy('created_at', 'desc') // urut berdasarkan waktu terbaru
            ->paginate(10);

        return view('dashboard.ostype.index', [
            'ostype' => $ostype,
            'q' => $request->q,
        ]);
    }

    public function create()
    {
        return view('dashboard.ostype.create');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('errorMessage', 'Validasi Error, silakan lengkapi data terlebih dahulu');
        }

        $ostype = new Ostype();
        $ostype->name = $request->name;
        $ostype->image_url = $request->image;
        $ostype->save(); // otomatis mengisi created_at

        return redirect()->route('ostype.index')->with('successMessage', 'OS Type berhasil disimpan.');
    }

    public function show(string $id)
    {
        $ostype = Ostype::findOrFail($id);
        return view('dashboard.ostype.detail', ['ostype' => $ostype]);
    }

    public function edit(string $id)
    {
        $ostype = Ostype::findOrFail($id);
        return view('dashboard.ostype.edit', ['ostype' => $ostype]);
    }

    public function update(Request $request, string $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('errorMessage', 'Validasi Error, silakan lengkapi data terlebih dahulu');
        }

        $ostype = Ostype::findOrFail($id);
        $ostype->name = $request->name;
        $ostype->image_url = $request->image;
        $ostype->save(); // akan update updated_at otomatis

        return redirect()->route('ostype.index')
            ->with('successMessage', 'Data OS Type berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $ostype = Ostype::findOrFail($id);
        $ostype->delete();

        return redirect()->back()->with('successMessage', 'Data berhasil dihapus.');
    }
}
