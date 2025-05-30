<?php

use App\Mail\KirimEmail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::middleware('auth')->resource('berita', BeritaController::class)->except(['show']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes(['register' => false]);
// Auth::routes();

Route::get('/sendemail', function(){
    Mail::to("mfwwazal@gmail.com")->send(new KirimEmail());
    return "Successs";
});

Route::get('test', function(){
    return 1;
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Halaman form login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Proses login
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard'); // arahkan ke halaman dashboard setelah login
    }

    return back()->with('error', 'Email atau password salah!');
});

// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');