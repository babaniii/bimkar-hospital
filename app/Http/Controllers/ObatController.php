<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('dokter.obat', compact('obats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        Obat::create($validated);
        return redirect()->back()->with('success', 'Obat berhasil ditambahkan.');
    }

    public function update(Request $request, Obat $obat)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $obat->update($validated);
        return redirect()->back()->with('success', 'Obat berhasil diupdate.');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->back()->with('success', 'Obat berhasil dihapus.');
    }
}
