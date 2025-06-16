<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Untuk hash password
use Illuminate\Support\Facades\Auth; // Untuk mengakses user yang login
use Illuminate\Validation\ValidationException; // Untuk menangani error validasi
use Illuminate\Support\Facades\Session; // Untuk mengelola session bahasa
use Illuminate\Support\Facades\Storage; // Untuk menghapus akun jika ada file terkait
use Illuminate\Validation\Rule; // <<< PASTIKAN INI ADA UNTUK VALIDASI RULE::IN

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Kata sandi lama tidak cocok.'],
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Kata sandi berhasil diperbarui!');
    }

    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language' => ['required', 'string', Rule::in(['id', 'en'])], // Tambahkan bahasa lain di sini
        ]);

        Session::put('locale', $request->language);

        // Simpan juga di database pengguna agar persisten antar sesi/perangkat
        $user = Auth::user();
        $user->language_preference = $request->language;
        $user->save();

        return redirect()->back()->with('success', 'Preferensi bahasa berhasil diperbarui!');
    }

    public function updateTheme(Request $request)
    {
        $request->validate([
            'theme' => ['required', 'string', Rule::in(['light', 'dark'])], // Sesuaikan tema yang didukung
        ]);

        Session::put('theme', $request->theme);

        // Simpan juga di database pengguna agar persisten antar sesi/perangkat
        $user = Auth::user();
        $user->theme_preference = $request->theme;
        $user->save();

        return redirect()->back()->with('success', 'Preferensi tema berhasil diperbarui!');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => ['required', 'string'],
        ]);

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Kata sandi yang Anda masukkan salah.'],
            ]);
        }

        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Akun Anda berhasil dihapus.',
            'redirect' => route('welcome') ?? '/'
        ]);
    }
}
