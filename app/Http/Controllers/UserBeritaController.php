<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class UserBeritaController extends Controller
{
    public function index()
{
    $beritas = Berita::latest()->get();
    return view('UserBerita.index', compact('beritas'));
}
}
