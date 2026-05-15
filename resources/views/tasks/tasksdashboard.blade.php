@extends('Layout.app')

@section('content')
<style>
    .task-item { transition: all 0.3s ease; border-radius: 10px; }
    .task-item:hover { background-color: #f8f9fa; transform: translateX(5px); box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .stat-card { transition: all 0.3s ease; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px rgba(0,0,0,0.1) !important; }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark">Vazifalar boshqaruvi</h3>
            <p class="text-muted mb-0">Bugungi rejalaringiz va vazifalaringiz</p>
        </div>
        @if(auth()->user()->isAdmin() || auth()->user()->isManager())
        <div class="d-flex justify-content-end mb-4 gap-2">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Yangi vazifa qo'shish
            </a>
        </div>
        @endif
    </div>

    {{-- Stat kartalari --}}
    <div class="row g-3 mb-5">
        <div class="col-md-3">
            <div class="card p-4 shadow-sm border-0 stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-secondary mb-0">Barchasi</h6>
                    <i class="bi bi-card-list text-secondary"></i>
                </div>
                <h2 class="fw-bold mt-2 mb-0">{{ $tasks->count() }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 shadow-sm border-0 stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-warning mb-0">Kutilmoqda</h6>
                    <i class="bi bi-hourglass-split text-warning"></i>
                </div>
                <h2 class="fw-bold mt-2 mb-0">{{ $tasks->where('status', 'pending')->count() }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 shadow-sm border-0 stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-primary mb-0">Jarayonda</h6>
                    <i class="bi bi-activity text-primary"></i>
                </div>
                <h2 class="fw-bold mt-2 mb-0">{{ $tasks->where('status', 'progress')->count() }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 shadow-sm border-0 stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-success mb-0">Bajarildi</h6>
                    <i class="bi bi-check2-circle text-success"></i>
                </div>
                <h2 class="fw-bold mt-2 mb-0">{{ $tasks->where('status', 'done')->count() }}</h2>
            </div>
        </div>
    </div>

    {{-- Vazifalar ro'yxati --}}
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h5 class="mb-4 fw-bold">So'nggi vazifalar</h5>
        
        @forelse($tasks as $task)
        <div class="task-item d-flex align-items-center justify-content-between p-3 mb-2 border">
            <div class="d-flex align-items-center gap-3">
                <div class="task-description">
                    <h6 class="fw-bold mb-1">{{ $task->title }}</h6>
                    
                    {{-- Tavsif qismi --}}
                    <span class="short-desc text-muted small">
                        {{ Str::limit($task->description, 50) }}
                    </span>
                    
                    @if(strlen($task->description) > 50)
                        <span class="full-desc d-none text-muted small">
                            {{ $task->description }}
                        </span>
                        <button type="button" class="btn btn-link btn-sm p-0 ms-1 toggle-btn" style="text-decoration: none; font-size: 0.8rem;">
                            Ko'proq
                        </button>
                    @endif


                    {{-- <a href="" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    
                    <!-- Delete tugmasi -->
                    <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">
                        <i class="bi bi-trash"></i> Delete
                    </button> --}}


                    <div class="mt-1 d-flex align-items-center gap-2">

                        

                        {{-- Yaratuvchi shaxsni chiqarish --}}
                        <small class="text-secondary">
                            <i class="bi bi-person-fill me-1"></i> {{ $task->user->name ?? 'Noma\'lum' }}
                        </small>
                        <span class="text-secondary">|</span>
                                    <small class="text-secondary d-flex align-items-center">
                                        <i class="bi bi-person-badge me-2"></i> 

                                        <span class="mx-1">Yaratdi: </span>
                                        
                                        <span>{{ $task->creator->name ?? 'Noma\'lum' }}</span>
    
                                        <span class="mx-1"> </span>
                                        
                                        <span class="font-bold text-blue-600">
                                            {{ $task->creator->role ?? 'Rol aniqlanmagan' }}
                                        </span>
                                        
                                    </small>
                                <span class="text-secondary"> -</span>
                        <small class="text-secondary"><i class="bi bi-calendar3 me-1"></i> {{ $task->created_at->format('d M, Y') }}</small>

                        <span class="text-secondary">|</span>

                                                @if($task->due_date)
                                <small class="fw-bold {{ \Carbon\Carbon::parse($task->due_date)->isPast() && $task->status != 'done' ? 'text-danger' : 'text-warning' }}">
                                    <i class="bi bi-alarm-fill me-1"></i> 
                                    Muddat: {{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}
                                </small>
                                @endif

                                <span class="text-secondary">|</span>
                                @if($task->supervisor)
                                        <small class="text-dark fw-semibold">
                                            <i class="bi bi-eye-fill text-info"></i> 
                                            Mas'ul: {{ $task->supervisor->name }}
                                        </small>
                                    @endif

                                    

                    </div>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-3">

                {{-- Edit va Delete tugmalari --}}

                <div class="ms-auto d-flex gap-2">
                        @if(auth()->user()->isAdmin() || auth()->user()->isManager())
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                        
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm bg-red-100" onclick="return confirm('Ochirishga aminmisiz?')">Delete</button>
                        </form>
                    @endif
                </div>

                {{-- Edit va Delete tugmalari --}}



                <span class="badge rounded-pill px-3 py-2 
                    {{ $task->status == 'pending' ? 'bg-warning-subtle text-warning-emphasis' : '' }}
                    {{ $task->status == 'progress' ? 'bg-primary-subtle text-primary-emphasis' : '' }}
                    {{ $task->status == 'done' ? 'bg-success-subtle text-success-emphasis' : '' }}">
                    {{ ucfirst($task->status) }}
                </span>

                @if($task->status == 'pending')
                    <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="progress">
                        <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill">Boshlash</button>
                    </form>
                @elseif($task->status == 'progress')
                    <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="done">
                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3">Bajarildi</button>
                    </form>
                @endif
            </div>
        </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-clipboard-x fs-1 text-muted"></i>
                <p class="text-muted mt-2">Hozircha vazifalar mavjud emas.</p>
            </div>
        @endforelse
    </div>
</div>

{{-- JavaScript qismi --}}
<script>
    document.querySelectorAll('.toggle-btn').forEach(button => {
        button.addEventListener('click', function() {
            const container = this.closest('.task-description');
            const short = container.querySelector('.short-desc');
            const full = container.querySelector('.full-desc');

            if (full.classList.contains('d-none')) {
                full.classList.remove('d-none');
                short.classList.add('d-none');
                this.innerText = 'Yashirish';
            } else {
                full.classList.add('d-none');
                short.classList.remove('d-none');
                this.innerText = 'Ko\'proq';
            }
        });
    });
</script>
@endsection