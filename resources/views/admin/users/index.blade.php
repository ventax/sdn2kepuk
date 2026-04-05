@extends('admin.layouts.app')

@section('title', 'Manajemen User')
@section('page_title', 'Manajemen User')

@section('content')
    <div class="content-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-1 fw-bold">Daftar Pengguna</h5>
                <p class="text-secondary mb-0">Kelola akun admin dan operator website.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-brand rounded-3">
                <i class="bi bi-person-plus me-1"></i> Tambah User
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-primary rounded-3">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle table-hover mb-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Dibuat</th>
                        <th class="text-end" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-secondary">{{ $user->created_at?->format('d M Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="btn btn-sm btn-outline-primary rounded-3">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                                    onsubmit="event.preventDefault(); confirmDelete(this);">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">Belum ada user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
