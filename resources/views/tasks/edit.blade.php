@extends('Layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-dark">Vazifani tahrirlash</h3>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Orqaga qaytish
                </a>
            </div>

            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4">
                    {{-- Action update yo'nalishiga o'zgartirildi --}}
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Update uchun majburiy --}}

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Vazifa nomi</label>
                            {{-- value qo'shildi --}}
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Tavsif</label>
                            {{-- textarea ichiga qiymat qo'yildi --}}
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-semibold">Holati</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Kutilmoqda</option>
                                    <option value="progress" {{ $task->status == 'progress' ? 'selected' : '' }}>Jarayonda</option>
                                    <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Bajarildi</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label fw-semibold">Muddat</label>
                                {{-- sana formati to'g'rilandi --}}
                                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}">
                            </div>
                        </div>


                        @if(auth()->user()->isPrivileged())
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label fw-semibold text-primary">
                                    <i class="bi bi-person-check"></i> Bajaruvchi xodim
                                </label>
                                <select name="user_id" id="user_id" class="form-select">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="supervisor_id" class="form-label fw-semibold text-info">
                                    <i class="bi bi-eye"></i> Nazorat qiluvchi (Mas'ul)
                                </label>
                                <select name="supervisor_id" id="supervisor_id" class="form-select">
                                    <option value="">Mas'ulni tanlang (ixtiyoriy)</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $task->supervisor_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="d-grid mt-2 mb-4">
                            <button type="submit" class="btn btn-warning btn-lg fw-bold">O'zgarishlarni saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection