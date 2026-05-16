<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Notifications\NewUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Notification;

class RegisterController extends Controller
{
    public function register(){
        return view('Register.register');
    }

    public function authregister(RegisterRequest $request)
    {

        $newUser=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'created_by' => null,
        ]);

        $superAdmins=User::where('role', 'super_admin')->get();

        if($superAdmins){
            Notification::send($superAdmins, new NewUserRegistered($newUser->name));
        }
    
        return redirect()->route('login');
    }
}
