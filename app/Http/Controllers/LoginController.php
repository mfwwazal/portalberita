<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(Request $request){
        $credential = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // $password = bcrypt($credential['password']);
        // User::where('email', $credential['email'])->update(['password'=>$password]);
        // return Auth::attempt($credential);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            "email" => "Credential Failed"
        ])->onlyInput('email');
    }
}