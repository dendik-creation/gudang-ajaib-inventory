<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login', ['title' => 'Login']);
    }

    public function login(Request $request){
        // $credentials = $request->validate([
        //     'nis' => 'required',
        //     'password' => 'required',
        // ]);
        if(Auth::attempt(['nis' => $request->nis, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }else{
            return back()->with('failed', 'Login Gagal, Kredensial Tidak Valid');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout Sukses');
    }
}
