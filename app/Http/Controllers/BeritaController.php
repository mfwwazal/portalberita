<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gambar', 'public');
        }

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $gambar
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gambar', 'public');
            $berita->gambar = $gambar;
        }

        $berita->judul = $request->judul;
        $berita->konten = $request->konten;
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function show($id)
{
    $berita = Berita::findOrFail($id);
    return view('berita.show', compact('berita'));
}


}
