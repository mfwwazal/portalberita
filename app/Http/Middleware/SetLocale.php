<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App; // Pastikan ini diimpor
use Illuminate\Support\Facades\Session; // Pastikan ini diimpor
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor jika Anda menggunakan preferensi dari database

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): \Symfony\Component\HttpFoundation\Response
    {
        $locale = config('app.locale'); // Ambil default dari config/app.php

        // Prioritas 1: Ambil dari database pengguna jika sudah login dan ada preferensi
        if (Auth::check() && Auth::user()->language_preference) {
            $locale = Auth::user()->language_preference;
        }
        // Prioritas 2: Jika belum login atau tidak ada preferensi di database, cek session
        else if (Session::has('locale')) {
            $locale = Session::get('locale');
        }

        App::setLocale($locale); // Set bahasa aplikasi Laravel

        return $next($request);
    }
}