@extends('admin.layouts.app')

@section('title', 'Konten Website')
@section('page_title', 'Konten Website')

@section('content')
    <style>
        .settings-hero {
            background: linear-gradient(135deg, #0f9f87, #1d4ed8);
            color: #fff;
            border-radius: .85rem;
            padding: 1rem 1.1rem;
            margin-bottom: 1rem;
        }

        .settings-nav .nav-link {
            color: #334155;
            border: 1px solid #e2e8f0;
            border-radius: .65rem;
            padding: .5rem .8rem;
            font-weight: 600;
            background: #fff;
        }

        .settings-nav .nav-link.active {
            color: #fff;
            border-color: transparent;
            background: linear-gradient(135deg, #0f9f87, #0b6a5a);
        }

        .settings-card {
            border: 1px solid #e2e8f0;
            border-radius: .75rem;
            padding: .9rem;
            background: #fff;
        }
    </style>

    <div class="settings-hero d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1 fw-bold">Profil & Konten Beranda</h5>
            <small class="opacity-75">Pilih tab agar pengisian lebih cepat dan tidak menumpuk.</small>
        </div>
        <span class="badge text-bg-light">Konten Website</span>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="content-card p-4">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-end align-items-center mb-3">
            <button type="submit" class="btn btn-brand rounded-3">Simpan Perubahan</button>
        </div>

        @if (session('success'))
            <div class="alert alert-success rounded-3">{{ session('success') }}</div>
        @endif

        <div class="alert alert-light border rounded-3 mb-4">
            <strong>Panduan singkat:</strong> isi bagian inti dulu (logo, judul slide, statistik), lalu lengkapi profil
            sekolah jika diperlukan.
        </div>

        <ul class="nav nav-pills settings-nav gap-2 mb-4" role="tablist">
            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="pill"
                    data-bs-target="#tabGeneral" type="button">1. Umum</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                    data-bs-target="#tabHero" type="button">2. Hero</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                    data-bs-target="#tabStats" type="button">3. Statistik</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                    data-bs-target="#tabProfile" type="button">4. Profil Sekolah</button></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tabGeneral">
                <div class="settings-card col-lg-5">
                    <label for="logo_image" class="form-label fw-semibold">Logo Website</label>
                    @if (!empty($settings['logo_image']))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings['logo_image']) }}" alt="Logo"
                                class="img-thumbnail" style="max-width:140px;">
                        </div>
                    @endif
                    <input class="form-control rounded-3" type="file" id="logo_image" name="logo_image" accept="image/*">
                    <small class="text-secondary d-block mt-2">Biarkan kosong jika tidak ingin mengganti logo.</small>
                </div>
            </div>

            <div class="tab-pane fade" id="tabHero">
                <p class="text-secondary small mb-3">Atur 3 slide utama beranda.</p>
                <div class="row g-3">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="col-lg-4">
                            <div class="settings-card h-100">
                                <div class="fw-semibold mb-2">Slide {{ $i }}</div>
                                <label for="hero_background_{{ $i }}" class="form-label">Background</label>
                                @if (!empty($settings['hero_background_' . $i]))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $settings['hero_background_' . $i]) }}"
                                            alt="Hero Background {{ $i }}" class="img-fluid rounded-3">
                                    </div>
                                @endif
                                <input class="form-control rounded-3 mb-2" type="file"
                                    id="hero_background_{{ $i }}" name="hero_background_{{ $i }}"
                                    accept="image/*">

                                <label for="hero_title_{{ $i }}" class="form-label">Judul</label>
                                <input type="text" class="form-control rounded-3 mb-2"
                                    id="hero_title_{{ $i }}" name="hero_title_{{ $i }}"
                                    value="{{ $settings['hero_title_' . $i] ?? '' }}">

                                <label for="hero_subtitle_{{ $i }}" class="form-label">Sub Judul</label>
                                <input type="text" class="form-control rounded-3" id="hero_subtitle_{{ $i }}"
                                    name="hero_subtitle_{{ $i }}"
                                    value="{{ $settings['hero_subtitle_' . $i] ?? '' }}">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="tab-pane fade" id="tabStats">
                <p class="text-secondary small mb-3">Data ringkas yang tampil di section statistik beranda.</p>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Siswa Aktif</label>
                        <input type="text" class="form-control rounded-3" name="stat_siswa"
                            value="{{ $settings['stat_siswa'] ?? '' }}" placeholder="Contoh: 70+">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tenaga Pendidik</label>
                        <input type="text" class="form-control rounded-3" name="stat_guru"
                            value="{{ $settings['stat_guru'] ?? '' }}" placeholder="Contoh: 7">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tahun Pengalaman</label>
                        <input type="text" class="form-control rounded-3" name="stat_pengalaman"
                            value="{{ $settings['stat_pengalaman'] ?? '' }}" placeholder="Contoh: 15+">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Akreditasi</label>
                        <input type="text" class="form-control rounded-3" name="stat_akreditasi"
                            value="{{ $settings['stat_akreditasi'] ?? '' }}" placeholder="Contoh: B">
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tabProfile">
                <p class="text-secondary small mb-3">Konten profil sekolah untuk section visi, misi, dan nilai utama.</p>
                <div class="row g-3">
                    <div class="col-12">
                        <label for="visi" class="form-label">Visi</label>
                        <textarea class="form-control rounded-3" id="visi" name="visi" rows="3">{{ $settings['visi'] ?? '' }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="misi" class="form-label">Misi (pisahkan dengan baris baru)</label>
                        <textarea class="form-control rounded-3" id="misi" name="misi" rows="5"
                            placeholder="Setiap misi di baris baru">{{ $settings['misi'] ?? '' }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="nilai_utama" class="form-label">Nilai Utama (pisahkan dengan koma)</label>
                        <input type="text" class="form-control rounded-3" id="nilai_utama" name="nilai_utama"
                            value="{{ $settings['nilai_utama'] ?? '' }}"
                            placeholder="Contoh: Religius, Nasionalis, Mandiri, Gotong Royong, Integritas">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-brand rounded-3">Simpan Perubahan</button>
        </div>
    </form>
@endsection
