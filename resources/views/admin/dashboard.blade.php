@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard CMS')

@section('content')
    <div class="row g-3 mb-3">
        <div class="col-md-6 col-xl-4">
            <div class="content-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <small class="text-secondary">Total User</small>
                    <span class="badge text-bg-light"><i class="bi bi-people"></i></span>
                </div>
                <h3 class="mb-0 fw-bold">{{ $stats['users'] }}</h3>
                <a href="{{ route('admin.users.index') }}" class="small text-decoration-none">Kelola pengguna <i
                        class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="content-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <small class="text-secondary">Konten Tersimpan</small>
                    <span class="badge text-bg-light"><i class="bi bi-sliders2"></i></span>
                </div>
                <h3 class="mb-0 fw-bold">{{ $stats['settings'] }}</h3>
                <a href="{{ route('admin.settings.edit') }}" class="small text-decoration-none">Atur konten situs <i
                        class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="content-card p-4 h-100">
                <small class="text-secondary">Quick Actions</small>
                <div class="d-grid gap-2 mt-3">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-brand rounded-3"><i
                            class="bi bi-person-plus me-1"></i> Tambah User</a>
                    <a href="{{ route('admin.settings.edit') }}" class="btn btn-outline-secondary rounded-3"><i
                            class="bi bi-pencil-square me-1"></i> Edit Profil Website</a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 fw-bold">User Terbaru</h6>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['latest_users'] as $user)
                        <tr>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-secondary">{{ $user->created_at?->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-secondary py-4">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
