@extends('layouts.app')

@section('title', 'Login Admin')

@push('styles')
    <style>
        .login-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .login-card {
            border: 0;
            border-radius: 1.15rem;
            overflow: hidden;
            box-shadow: 0 30px 55px -25px rgba(15, 23, 42, .35);
        }

        .login-brand {
            background:
                radial-gradient(circle at 85% 0%, rgba(255, 255, 255, .12), transparent 35%),
                linear-gradient(155deg, #10253f 0%, #0f6f67 58%, #0aa27d 100%);
            color: #fff;
            padding: 2rem;
        }

        .brand-mark {
            width: 52px;
            height: 52px;
            border-radius: .85rem;
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .28);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            letter-spacing: .04em;
        }

        .login-form-wrap {
            background: #ffffff;
            padding: 2rem;
        }

        .form-control-lg {
            border-width: 1px;
            padding-top: .8rem;
            padding-bottom: .8rem;
        }

        .form-control:focus {
            border-color: #14a38b;
            box-shadow: 0 0 0 .2rem rgba(20, 163, 139, .12);
        }

        .btn-login {
            background: linear-gradient(135deg, #0f9f87, #0b6a5a);
            border: 0;
            font-weight: 700;
            letter-spacing: .01em;
            padding-top: .85rem;
            padding-bottom: .85rem;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0b8c77, #09584c);
        }

        .login-note {
            color: #64748b;
            font-size: .9rem;
        }

        @media (max-width: 991.98px) {
            .login-brand {
                border-bottom: 1px solid rgba(255, 255, 255, .16);
                padding: 1.25rem 1.25rem 1rem;
            }

            .login-form-wrap {
                padding: 1.25rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container login-shell">
        <div class="row justify-content-center w-100">
            <div class="col-lg-10 col-xl-9">
                <div class="card login-card">
                    <div class="row g-0">
                        <div class="col-lg-5 login-brand d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <span class="brand-mark">CMS</span>
                                    <div>
                                        <div class="small text-white-50">Portal Manajemen</div>
                                        <h5 class="fw-bold mb-0">SD Negeri 2 Kepuk</h5>
                                    </div>
                                </div>
                                <p class="text-white-50 mb-0">Panel admin profesional untuk mengelola konten website sekolah
                                    dengan cepat, rapi, dan aman.</p>
                            </div>
                            <div class="mt-4 pt-3 border-top border-light border-opacity-25">
                                <p class="mb-2 fw-semibold">Fitur utama:</p>
                                <ul class="small mb-0 text-white-50 ps-3">
                                    <li>Manajemen user admin</li>
                                    <li>Update konten homepage real-time</li>
                                    <li>Kontrol media gambar dan berita</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-7 login-form-wrap">
                            <h3 class="fw-bold mb-1">Masuk ke Dashboard</h3>
                            <p class="text-secondary mb-4">Gunakan akun admin yang valid untuk melanjutkan.</p>

                            @if ($errors->any())
                                <div class="alert alert-danger rounded-3 py-2">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.login.submit') }}" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control form-control-lg rounded-3" id="email"
                                        name="email" value="{{ old('email') }}" required autofocus
                                        placeholder="admin@sekolah.sch.id">
                                </div>

                                <div class="col-12">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-3" id="password"
                                        name="password" required placeholder="Masukkan password">
                                </div>

                                <div class="col-12 d-grid mt-1">
                                    <button type="submit" class="btn btn-lg text-white rounded-3 btn-login">Login ke
                                        Admin</button>
                                </div>

                                <div class="col-12">
                                    <div class="login-note">Akses hanya untuk administrator terdaftar.</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
