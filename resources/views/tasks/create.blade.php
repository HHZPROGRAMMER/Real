@extends('Layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-dark">Yangi vazifa yaratish</h3>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Orqaga qaytish
                </a>
            </div>

            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Vazifa nomi</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Tavsif</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-semibold">Holati</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending">Kutilmoqda</option>
                                    <option value="progress">Jarayonda</option>
                                    <option value="done">Bajarildi</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label fw-semibold">Muddat</label>
                                <input type="date" name="due_date" id="due_date" class="form-control">
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
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                        </div>

                        <div class="d-grid mt-2 mb-4">
                            <button type="submit" class="btn btn-primary btn-lg">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection