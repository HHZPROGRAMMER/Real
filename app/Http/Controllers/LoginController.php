<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('Login.login');
    }

    public function authlogin(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            
            if ($user->isSuperAdmin()) {
                return redirect()->route('super_admin.super');
            }
    
            return redirect()->route('dashboard');
        }
    
        return back()->withErrors([
            'email' => 'Email yoki parol noto\'g\'ri!',
        ])->onlyInput('email'); 
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
