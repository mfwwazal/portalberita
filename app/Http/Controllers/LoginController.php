<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function store(Request $request){
        $credential = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $credential["password"] = bcrypt($credential["password"]);

        return User::where('email', $credential['email'])
        ->where('password', $credential['password'])->first();

        if (Auth::attempt($credential)) {
            // $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            "email" => "Credential Failed"
        ])->onlyInput('email');
    }
}