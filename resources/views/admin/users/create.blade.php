@extends('admin.layouts.app')

@section('title', 'Tambah User')
@section('page_title', 'Tambah User')

@section('content')
    <div class="content-card p-4" style="max-width: 720px;">
        <h5 class="fw-bold mb-3">Buat Akun Baru</h5>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-12">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control rounded-3" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" class="form-control rounded-3" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Password</label>
                <input type="password" class="form-control rounded-3" name="password" required>
                <small class="text-secondary">Minimal 6 karakter.</small>
            </div>
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-brand rounded-3">Simpan User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-3">Kembali</a>
            </div>
        </form>
    </div>
@endsection
