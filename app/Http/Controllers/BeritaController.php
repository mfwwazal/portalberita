<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\BeritaImage; // Ini tidak diperlukan jika Anda hanya menyimpan satu gambar, bisa dihapus.

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->take(6)->get();
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // opsional, validasi gambar
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar', 'public');
        }

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $gambarPath,
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
        // 1. Validasi Request
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // max:2048 = 2MB
        ]);

        // Temukan berita yang akan diupdate
        $berita = Berita::findOrFail($id);

        // 2. Cek apakah ada file 'gambar' baru yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            // Simpan gambar baru ke folder 'berita_images' di dalam 'storage/app/public'
            // Sesuaikan nama folder jika Anda ingin konsisten dengan 'gambar' di store method
            $path = $request->file('gambar')->store('berita_images', 'public'); // <-- Pertimbangkan untuk mengganti 'berita_images' ke 'gambar' agar konsisten dengan method store.

            // Update path gambar di database
            $berita->gambar = $path;
        }

        // 3. Update data berita lainnya
        $berita->judul = $request->input('judul');
        $berita->konten = $request->input('konten');

        // 4. Simpan perubahan ke database
        $berita->save();

        // 5. Redirect atau kembalikan response
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // PENTING: Method destroy dipindahkan ke DALAM class
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        // Hapus gambar terkait saat berita dihapus (disarankan)
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    // PENTING: Method show dipindahkan ke DALAM class
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }
}