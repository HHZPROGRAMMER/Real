@extends('Layout.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Foydalanuvchilar ro'yxati</h3>
            <p class="text-muted">Tizimdagi barcha foydalanuvchilarni boshqaring</p>
        </div>
        
        <div class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill shadow-sm">
            Jami: {{ $users->count() }} ta user
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow border-0 overflow-hidden" style="border-radius: 15px;">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small fw-bold">
                    <tr>
                        <th class="ps-4 py-3">FOYDALANUVCHI</th>
                        <th class="py-3">EMAIL MANZIL</th>
                        <th class="py-3">HOZIRGI ROL</th>
                        <th class="py-3 text-end pe-4">AMAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 38px; height: 38px; font-size: 0.8rem;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="fw-semibold text-dark">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="text-muted">{{ $user->email }}</td>
                        <td>
                            <span class="badge rounded-pill px-3 py-2 
                                {{ $user->role == 'super_admin' ? 'bg-danger-subtle text-danger' : '' }}
                                {{ $user->role == 'admin' ? 'bg-primary-subtle text-primary' : '' }}
                                {{ $user->role == 'manager' ? 'bg-warning-subtle text-warning' : '' }}
                                {{ $user->role == 'user' ? 'bg-secondary-subtle text-secondary' : '' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="pe-4">
                            <form action="{{ route('super_admin.updaterole', $user->id) }}" method="POST" class="d-flex justify-content-end gap-2">
                                @csrf
                                <select name="role" class="form-select form-select-sm w-auto border-light shadow-sm" style="border-radius: 8px;">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-success px-3 shadow-sm" style="border-radius: 8px;">Saqlash</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 m-4" style="z-index: 1050;">
    <div class="dropdown dropup">
        <button class="btn btn-primary rounded-circle shadow-lg p-0 d-flex align-items-center justify-content-center floating-bell" 
                type="button" data-bs-toggle="dropdown" style="width: 60px; height: 60px;">
            <i class="bi bi-bell-fill fs-4 text-white"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-white pulse-badge">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </button>

        <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 mb-3 p-0" 
             style="width: 350px; border-radius: 20px; overflow: hidden; transform: translateY(-10px);">
            
            <div class="p-3 bg-primary text-white d-flex justify-content-between align-items-center shadow-sm">
                <span class="fw-bold"><i class="bi bi-lightning-charge-fill me-2"></i>Bildirishnomalar</span>
                <span class="badge bg-white text-primary rounded-pill small">{{ auth()->user()->unreadNotifications->count() }} ta yangi</span>
            </div>

            <div class="list-group list-group-flush" style="max-height: 380px; overflow-y: auto; background-color: #f8f9fa;">
                @forelse(auth()->user()->unreadNotifications as $notification)
                    <div class="list-group-item border-0 p-3 mb-2 mx-2 mt-2 rounded-4 bg-white shadow-sm notification-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-primary-subtle p-2 rounded-circle me-3">
                                <i class="bi bi-person-plus-fill text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <small class="fw-bold text-dark">Yangi xodim qo'shildi</small>
                                    <small class="text-muted" style="font-size: 0.65rem;">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0 text-muted small mt-1">
                                    <strong>{{ $notification->data['user_name'] }}</strong> tizimda ro'yxatdan o'tdi.
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-5 text-center bg-white">
                        <div class="bg-light rounded-circle d-inline-block p-3 mb-3">
                            <i class="bi bi-bell-slash text-muted fs-2"></i>
                        </div>
                        <p class="text-muted small">Hozircha hamma narsa tinch. Yangi xabarlar yo'q!</p>
                    </div>
                @endforelse
            </div>

            @if(auth()->user()->unreadNotifications->count() > 0)
                <div class="p-3 bg-white border-top">
                    <a href="{{ route('super_admin.markAsRead') }}" class="btn btn-primary w-100 rounded-pill py-2 fw-bold small shadow-sm">
                        Hammasini o'qilgan deb belgilash
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Chiroyli animatsiyalar */
    .floating-bell {
        transition: all 0.3s ease;
        border: 4px solid #fff !important;
    }
    .floating-bell:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 15px 30px rgba(13, 110, 253, 0.4) !important;
    }
    .notification-item {
        transition: transform 0.2s;
    }
    .notification-item:hover {
        transform: translateX(5px);
        background-color: #f1f8ff !important;
    }
    .pulse-badge {
        animation: pulse 2s infinite;
        font-size: 0.75rem;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }
    /* Scrollbarni yashirish yoki chiroyli qilish */
    .list-group::-webkit-scrollbar { width: 4px; }
    .list-group::-webkit-scrollbar-thumb { background: #e0e0e0; border-radius: 10px; }
</style>

@endsection