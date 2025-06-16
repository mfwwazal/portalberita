<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalBerita = Berita::count();
        $totalAdmin = User::where('role', 'admin')->count();

        return view('welcome', compact('totalBerita', 'totalAdmin'));
    }
}
