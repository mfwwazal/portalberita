<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Pastikan ini diimpor
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor jika Anda menggunakan preferensi dari database

class SetTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): \Symfony\Component\HttpFoundation\Response
    {
        $theme = 'light'; // Default tema jika tidak ada preferensi

        // Prioritas 1: Ambil dari database pengguna jika sudah login dan ada preferensi
        if (Auth::check() && Auth::user()->theme_preference) {
            $theme = Auth::user()->theme_preference;
        }
        // Prioritas 2: Jika belum login atau tidak ada preferensi di database, cek session
        else { // Menggunakan 'else' karena kita sudah menetapkan default atau mengambil dari database di atas
            $theme = Session::get('theme', 'light'); // Ambil dari session, dengan default 'light' jika tidak ada
        }

        // Bagikan variabel tema ke semua view, agar bisa diakses di Blade
        view()->share('theme_preference', $theme);

        return $next($request);
    }
}