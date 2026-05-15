<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailcheckcodeController extends Controller
{
    
    public function showVerifyForm()
    {
        $email = session('email');
        if (!$email) {
            return redirect()->route('email')->with('error', 'Iltimos, avval emailingizni kiriting!');
        }
        return view('Emailverification.checkemailcode', ['email' => $email]);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric'
        ]);
    
        $verification = EmailVerification::where('code', $request->code)->first();

        if (!$verification) {
            return back()->withErrors(['code' => 'Kod noto\'g\'ri!']);
        }

        $email = $verification->email; 

        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Foydalanuvchi topilmadi.']);
        }
    
        Auth::login($user);

        $verification->delete(); 
        
        return redirect()->route('dashboard')->with('success', 'Xush kelibsiz!');
    }
}