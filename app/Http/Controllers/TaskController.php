<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   // app/Http/Controllers/TaskController.php

   public function index()
   {
       $user = auth()->user();

            if ($user->isAdmin()) {
                $tasks = Task::with(['creator', 'user'])->latest()->get(); 
            } 
            elseif ($user->isManager()) {
                $tasks = Task::with(['creator', 'user'])
                    ->where('status', '!=', 'done')
                    ->latest()
                    ->get();
            } 
            else {
                $tasks = $user->tasks()->with('creator')->latest()->get();
            }

       return view('tasks.tasksdashboard', compact('tasks'));
   }

   public function create()
   {
       if (!auth()->user()->isAdmin() && !auth()->user()->isManager()) {
           return redirect()->route('dashboard')->with('error', 'Sizda vazifa yaratish huquqi yo‘q!');
       }

       $users = User::all();
       return view('tasks.create', compact('users'));
   }

   public function store(TaskRequest $request)
   {
       $data = $request->validated();

       if (auth()->user()->isPrivileged() && $request->filled('user_id')) {
           $data['user_id'] = $request->user_id;
       } else {
           $data['user_id'] = auth()->id();
       }
       $data['created_by'] = auth()->id();
       $data['supervisor_id'] = $request->supervisor_id;

       Task::create($data);

       return redirect()->route('dashboard')->with('success', 'Vazifa muvaffaqiyatli saqlandi!');
   }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isManager()) {
            return redirect()->route('dashboard')->with('error', 'Sizda vazifa tahrirlash huquqi yo‘q!');
        }

        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

            public function updateStatus(Request $request, Task $task)
        {
            $request->validate(['status' => 'required|in:pending,progress,done']);
            $task->update(['status' => $request->status]);
            return back()->with('success', 'Vazifa holati yangilandi!');
        }
}
