<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
@extends('admin.layouts.app')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <span class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width:48px;height:48px;font-size:1.5rem;">
                        <i class="bi bi-people"></i>
                    </span>
                </div>
                <div>
                    <h5 class="card-title mb-1">User</h5>
                    <a href="{{ route('admin.users.index') }}" class="stretched-link text-decoration-none">Manajemen User</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan card menu lain di sini -->
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h3 class="card-title mb-3">Selamat datang di Admin Panel</h3>
        <p class="mb-0">Gunakan menu di samping untuk mengelola data website Anda secara profesional.</p>
    </div>
</div>
@endsection
</html>
