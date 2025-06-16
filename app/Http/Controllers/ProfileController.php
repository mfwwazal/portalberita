<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Untuk aturan validasi unique yang lebih baik
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Menampilkan form untuk mengedit profil pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Mengupdate data profil pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Email harus unik kecuali untuk user ini sendiri
            ],
            'profile_picture' => ['nullable', 'image', 'max:2048'], // Max 2MB
            // Tambahkan validasi untuk field lain jika ada (misal: address, phone_number)
            // 'address' => ['nullable', 'string', 'max:255'],
            // 'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        // Tangani upload foto profil (jika ada)
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                \Storage::delete('public/' . $user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->address = $request->address; // Aktifkan jika Anda memiliki field ini
        // $user->phone_number = $request->phone_number; // Aktifkan jika Anda memiliki field ini

        $user->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}