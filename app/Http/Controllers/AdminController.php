<?php

namespace App\Http\Controllers;

use App\Models\TaskHistory;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Foydalanuvchi roli yangilandi!');
    }

    public function history()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu sahifani ko‘rish huquqi yo‘q!');
        }


        $history = TaskHistory::with(['user', 'task'])
                    ->latest()
                    ->paginate(15);

        return view('admin.history', compact('history'));
    }
}
