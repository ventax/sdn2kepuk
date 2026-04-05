@extends('admin.layouts.app')

@section('title', 'Pengaturan Sekolah')
@section('page_title', 'Pengaturan Sekolah')

@section('content')
    <style>
        .settings-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .settings-hero {
            border: 1px solid #e2e8f0;
            background: linear-gradient(145deg, #eff6ff, #e0e7ff);
            border-radius: .9rem;
            padding: 1rem 1.1rem;
            margin-bottom: 1rem;
        }

        .settings-hero h5 {
            margin: 0;
            font-weight: 800;
            color: #0f172a;
        }

        .settings-hero p {
            margin: .35rem 0 0;
            color: #475569;
            font-size: .92rem;
        }

        .settings-card {
            border: 1px solid #e2e8f0;
            border-radius: .9rem;
            background: #ffffff;
            overflow: hidden;
        }

        .settings-card-head {
            padding: .95rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: .55rem;
            font-size: 1.1rem;
        }

        .settings-card-body {
            padding: 1rem;
        }

        .settings-label {
            font-weight: 700;
            color: #334155;
            margin-bottom: .35rem;
        }

        .settings-note {
            color: #64748b;
            font-size: .85rem;
            margin-top: .3rem;
        }

        .settings-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 1rem 0;
        }

        .advanced-card .accordion-button {
            font-weight: 700;
        }

        @media (min-width: 992px) {
            .settings-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <div class="settings-hero d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-2">
        <div>
            <h5>Pengaturan Sekolah</h5>
            <p>Buat data sekolah lebih lengkap agar admin tidak bingung saat update website.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary rounded-3">
                <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Website
            </a>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
        class="content-card p-3 p-lg-4">
        @csrf
        @method('PUT')

        <div class="settings-grid mb-3">
            <div class="settings-card">
                <div class="settings-card-head">
                    <i class="bi bi-buildings text-primary"></i> Informasi Sekolah
                </div>
                <div class="settings-card-body">
                    <div class="mb-3">
                        <label class="form-label settings-label">Nama Sekolah</label>
                        <input type="text" class="form-control" name="school_name"
                            value="{{ $settings['school_name'] ?? 'SD Negeri 2 Kepuk' }}"
                            placeholder="Contoh: SD Negeri 1 Tengguli">
                    </div>

                    <div class="mb-3">
                        <label class="form-label settings-label">Nama Kepala Sekolah</label>
                        <input type="text" class="form-control" name="principal_name"
                            value="{{ $settings['principal_name'] ?? '' }}" placeholder="Contoh: Ibu Dra. Soemitro, M.Si">
                    </div>

                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label settings-label">Kota / Kabupaten</label>
                            <input type="text" class="form-control" name="city" value="{{ $settings['city'] ?? '' }}"
                                placeholder="Contoh: Kab. Jepara, Jawa Tengah">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label settings-label">Akreditasi</label>
                            <input type="text" class="form-control" name="school_accreditation"
                                value="{{ $settings['school_accreditation'] ?? ($settings['stat_akreditasi'] ?? '') }}"
                                placeholder="Contoh: A">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label settings-label">Alamat</label>
                        <textarea class="form-control" rows="3" name="school_address" placeholder="Alamat lengkap sekolah">{{ $settings['school_address'] ?? '' }}</textarea>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label settings-label">Telepon</label>
                            <input type="text" class="form-control" name="school_phone"
                                value="{{ $settings['school_phone'] ?? '' }}" placeholder="Contoh: (0353) 23456">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label settings-label">Email</label>
                            <input type="text" class="form-control" name="school_email"
                                value="{{ $settings['school_email'] ?? '' }}" placeholder="Contoh: info@sdn.sch.id">
                        </div>
                    </div>

                    <div class="settings-divider"></div>

                    <label for="logo_image" class="form-label settings-label">Logo Sekolah</label>
                    <div class="d-flex align-items-center gap-3 flex-wrap mb-2">
                        @if (!empty($settings['logo_image']))
                            <img src="{{ asset('storage/' . $settings['logo_image']) }}" alt="Logo"
                                class="img-thumbnail" style="max-width:90px;">
                        @endif
                        <input class="form-control" type="file" id="logo_image" name="logo_image" accept="image/*">
                    </div>
                    <div class="settings-note">Biarkan kosong jika tidak ingin mengganti logo.</div>
                </div>
            </div>

            <div class="d-flex flex-column gap-3">
                <div class="settings-card">
                    <div class="settings-card-head">
                        <i class="bi bi-share-fill text-primary"></i> Media Sosial
                    </div>
                    <div class="settings-card-body">
                        <div class="mb-3">
                            <label class="form-label settings-label"><i
                                    class="bi bi-facebook text-primary me-1"></i>Facebook</label>
                            <input type="text" class="form-control" name="facebook_url"
                                value="{{ $settings['facebook_url'] ?? '' }}" placeholder="https://facebook.com/...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label settings-label"><i
                                    class="bi bi-instagram text-primary me-1"></i>Instagram</label>
                            <input type="text" class="form-control" name="instagram_url"
                                value="{{ $settings['instagram_url'] ?? '' }}" placeholder="https://instagram.com/...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label settings-label"><i
                                    class="bi bi-tiktok text-primary me-1"></i>TikTok</label>
                            <input type="text" class="form-control" name="tiktok_url"
                                value="{{ $settings['tiktok_url'] ?? '' }}" placeholder="https://www.tiktok.com/@...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label settings-label"><i
                                    class="bi bi-twitter-x text-primary me-1"></i>Twitter /
                                X</label>
                            <input type="text" class="form-control" name="twitter_url"
                                value="{{ $settings['twitter_url'] ?? '' }}" placeholder="https://twitter.com/...">
                        </div>

                        <div>
                            <label class="form-label settings-label"><i
                                    class="bi bi-youtube text-primary me-1"></i>YouTube</label>
                            <input type="text" class="form-control" name="youtube_url"
                                value="{{ $settings['youtube_url'] ?? '' }}" placeholder="https://youtube.com/...">
                        </div>
                    </div>
                </div>

                <div class="settings-card">
                    <div class="settings-card-head">
                        <i class="bi bi-geo-alt-fill text-primary"></i> Lokasi & Maps
                    </div>
                    <div class="settings-card-body">
                        <label class="form-label settings-label">Embed Google Maps URL</label>
                        <textarea class="form-control" rows="5" name="map_embed_url" placeholder="Tempel URL embed dari Google Maps">{{ $settings['map_embed_url'] ?? '' }}</textarea>
                        <div class="settings-note">Gunakan URL embed saja, bukan link Maps biasa.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="settings-card advanced-card mt-3">
            <div class="settings-card-head">
                <i class="bi bi-sliders text-primary"></i> Pengaturan Beranda Lanjutan
            </div>
            <div class="settings-card-body">
                <div class="accordion" id="advancedSettingsAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#advancedHero" aria-expanded="true" aria-controls="advancedHero">
                                Hero Slide (3 Slide)
                            </button>
                        </h2>
                        <div id="advancedHero" class="accordion-collapse collapse show"
                            data-bs-parent="#advancedSettingsAccordion">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="col-lg-4">
                                            <div class="border rounded-3 p-3 h-100">
                                                <div class="fw-semibold mb-2">Slide {{ $i }}</div>

                                                <label for="hero_background_{{ $i }}"
                                                    class="form-label">Background</label>
                                                @if (!empty($settings['hero_background_' . $i]))
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $settings['hero_background_' . $i]) }}"
                                                            alt="Hero Background {{ $i }}"
                                                            class="img-fluid rounded-3">
                                                    </div>
                                                @endif
                                                <input class="form-control mb-2" type="file"
                                                    id="hero_background_{{ $i }}"
                                                    name="hero_background_{{ $i }}" accept="image/*">

                                                <label for="hero_title_{{ $i }}"
                                                    class="form-label">Judul</label>
                                                <input type="text" class="form-control mb-2"
                                                    id="hero_title_{{ $i }}"
                                                    name="hero_title_{{ $i }}"
                                                    value="{{ $settings['hero_title_' . $i] ?? '' }}">

                                                <label for="hero_subtitle_{{ $i }}" class="form-label">Sub
                                                    Judul</label>
                                                <input type="text" class="form-control"
                                                    id="hero_subtitle_{{ $i }}"
                                                    name="hero_subtitle_{{ $i }}"
                                                    value="{{ $settings['hero_subtitle_' . $i] ?? '' }}">
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#advancedStats" aria-expanded="false" aria-controls="advancedStats">
                                Statistik Beranda
                            </button>
                        </h2>
                        <div id="advancedStats" class="accordion-collapse collapse"
                            data-bs-parent="#advancedSettingsAccordion">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Siswa Aktif</label>
                                        <input type="text" class="form-control" name="stat_siswa"
                                            value="{{ $settings['stat_siswa'] ?? '' }}" placeholder="Contoh: 70+">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Tenaga Pendidik</label>
                                        <input type="text" class="form-control" name="stat_guru"
                                            value="{{ $settings['stat_guru'] ?? '' }}" placeholder="Contoh: 7">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Tahun Pengalaman</label>
                                        <input type="text" class="form-control" name="stat_pengalaman"
                                            value="{{ $settings['stat_pengalaman'] ?? '' }}" placeholder="Contoh: 15+">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Akreditasi Ringkas</label>
                                        <input type="text" class="form-control" name="stat_akreditasi"
                                            value="{{ $settings['stat_akreditasi'] ?? '' }}" placeholder="Contoh: B">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#advancedProfile" aria-expanded="false" aria-controls="advancedProfile">
                                Profil Sekolah
                            </button>
                        </h2>
                        <div id="advancedProfile" class="accordion-collapse collapse"
                            data-bs-parent="#advancedSettingsAccordion">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="visi" class="form-label">Visi</label>
                                        <textarea class="form-control" id="visi" name="visi" rows="3">{{ $settings['visi'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="misi" class="form-label">Misi (pisahkan dengan baris baru)</label>
                                        <textarea class="form-control" id="misi" name="misi" rows="5"
                                            placeholder="Setiap misi di baris baru">{{ $settings['misi'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="nilai_utama" class="form-label">Nilai Utama (pisahkan dengan
                                            koma)</label>
                                        <input type="text" class="form-control" id="nilai_utama" name="nilai_utama"
                                            value="{{ $settings['nilai_utama'] ?? '' }}"
                                            placeholder="Contoh: Religius, Nasionalis, Mandiri, Gotong Royong, Integritas">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-brand rounded-3">
                <i class="bi bi-check2-circle me-1"></i> Simpan Pengaturan
            </button>
        </div>
    </form>
@endsection
