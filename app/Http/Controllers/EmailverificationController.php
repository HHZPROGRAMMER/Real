<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailverificationRequest;
use App\Models\EmailVerification;
use App\Mail\OtpMail; // O'zingiz yaratgan Mailable klassi
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailverificationController extends Controller
{
    public function email() {
        return view('Emailverification.email');
    }

    public function authemail(EmailverificationRequest $request)
    {
        $email = $request->validated('email');
        $userExists = User::where('email', $email)->exists();

    if (!$userExists) {
        return back()->withErrors(['email' => 'Bu email manzili bizning bazamizda topilmadi. Iltimos, ro\'yxatdan o\'ting!']);
    }
        $code = rand(100000, 999999);

        EmailVerification::updateOrCreate(
            ['email' => $email],
            [
                'code' => $code, 
                'expires_at' => now()->addMinutes(5)
            ]
        );

        Mail::to($email)->send(new OtpMail($code));

        return redirect()->route('emailcheckcode')->with('email', $email);
    }
}