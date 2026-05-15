@extends('Layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark m-0">Tizim Amallar Tarixi</h2>
                    <p class="text-muted">Barcha o'chirish, tahrirlash va yaratish amallari nazorati</p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Dashboardga qaytish
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase fs-xs fw-bold text-secondary">Vaqt</th>
                                    <th class="py-3 text-uppercase fs-xs fw-bold text-secondary">Foydalanuvchi</th>
                                    <th class="py-3 text-uppercase fs-xs fw-bold text-secondary">Amal</th>
                                    <th class="py-3 text-uppercase fs-xs fw-bold text-secondary">Vazifa (ID)</th>
                                    <th class="py-3 text-uppercase fs-xs fw-bold text-secondary">Tavsif</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($history as $log)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">{{ $log->created_at->format('H:i:s') }}</span>
                                            <small class="text-muted">{{ $log->created_at->format('d.m.Y') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2 bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                {{ strtoupper(substr($log->user->name ?? 'T', 0, 1)) }}
                                            </div>
                                            <span class="fw-medium">{{ $log->user->name ?? 'Tizim' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'created' => 'bg-success-subtle text-success border-success',
                                                'updated' => 'bg-primary-subtle text-primary border-primary',
                                                'deleted' => 'bg-danger-subtle text-danger border-danger',
                                            ][$log->action] ?? 'bg-secondary-subtle text-secondary';
                                        @endphp
                                        <span class="badge border px-3 py-2 {{ $badgeClass }}">
                                            {{ strtoupper($log->action) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">#{{ $log->task_id ?? '---' }}</span>
                                    </td>
                                    <td class="text-dark fw-normal">
                                        {{ $log->description }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-info-circle fs-2 d-block mb-2"></i>
                                        Hozircha hech qanday amal yozib olinmagan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $history->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>

<style>
    .fs-xs { font-size: 0.75rem; }
    .bg-success-subtle { background-color: #d1e7dd; }
    .bg-primary-subtle { background-color: #cfe2ff; }
    .bg-danger-subtle { background-color: #f8d7da; }
    .rounded-4 { border-radius: 1rem !important; }
    .table thead th { border-top: none; }
</style>
@endsection