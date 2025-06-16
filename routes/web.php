<?php

use App\Mail\KirimEmail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return 2;
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Halaman form login
// Route::get('/login', function () {
//     return view('login');
// })->name('login');

// Proses login
// Route::post('/login', function (Request $request) {
//     $credentials = $request->only('email', 'password');

//     if (Auth::attempt($credentials)) {
//         $request->session()->regenerate();
//         return redirect()->intended('/dashboard'); // arahkan ke halaman dashboard setelah login
//     }

//     return back()->with('error', 'Email atau password salah!');
// });


Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login.index');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'store'])->name('login.store');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/welcome', function(){
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->controller(BeritaController::class)->prefix("admin")->group(function(){
    Route::get('berita', 'index')->name('berita.index');
});

Route::get('/', [App\Http\Controllers\UserBeritaController::class, 'index'])
->name('UserBerita.index');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update-password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');

    Route::post('/settings/update-language', [SettingsController::class, 'updateLanguage'])->name('settings.updateLanguage');
    Route::post('/settings/update-theme', [SettingsController::class, 'updateTheme'])->name('settings.updateTheme');
    Route::delete('/settings/delete-account', [SettingsController::class, 'deleteAccount'])->name('settings.deleteAccount');
});

Route::post('/settings/update-password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword')->middleware('auth');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');




// Route::get('/', function () {
//     $berita = Berita::latest()->take(6)->get(); // ambil 6 berita terbaru
//     return view('home', compact('berita'));
// })->name('berita.index');



// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');