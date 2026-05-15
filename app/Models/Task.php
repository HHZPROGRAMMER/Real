<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title', 
        'description',
        'due_date', 
        'status', 
        'max_score', 
        'earned_score', 
        'user_id',
        'created_by',
        'supervisor_id',
    ];

    // Ushbu vazifa kimga tegishli ekanligini bog'lash
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function scopeForUser($query, $user)
    {
        if ($user->isPrivileged()) {
            return $query;
        }
        return $query->where('user_id', $user->id);
    }

        public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

        public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }


            protected static function booted()
            {
                static::deleting(function ($task) {
                    self::logActivity($task, 'deleted', "Vazifa o'chirildi: " . $task->title);
                });
            
                static::created(function ($task) {
                    self::logActivity($task, 'created', "Yangi vazifa yaratildi: " . $task->title);
                });
            
                static::updated(function ($task) {
                    self::logActivity($task, 'updated', "Vazifa tahrirlandi: " . $task->title);
                });
            }

        protected static function logActivity($task, $action, $description)
        {
            \App\Models\TaskHistory::create([
                'task_id'     => $task->id,
                'user_id'     => auth()->id() ?? $task->user_id,
                'action'      => $action,
                'description' => $description,
            ]);
        }

}
