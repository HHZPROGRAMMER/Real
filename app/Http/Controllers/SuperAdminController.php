<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuperAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function super() {
        $users = User::all();
        return view('super_admin.super', compact('users'));
    }

    public function updaterole(SuperAdminRequest $request, User $user) {
        $user->update(['role'=>$request->role]);
        return back()->with('success', 'Foydalanuvchi roli yangilandi!');
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Barcha bildirishnomalar o\'qildi!');
    }
}
