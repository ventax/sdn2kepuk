@extends('admin.layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4">Profil Website</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <label for="logo_image" class="form-label">Logo Website</label>
                @if(!empty($settings['logo_image']))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $settings['logo_image']) }}" alt="Logo" style="max-width:120px;">
                    </div>
                @endif
                <input class="form-control" type="file" id="logo_image" name="logo_image" accept="image/*">
            </div>
            <h5 class="mb-3">Hero Slider Beranda</h5>
            @for($i = 1; $i <= 3; $i++)
            <div class="border rounded p-3 mb-3 bg-light">
                <div class="mb-2"><strong>Slide {{ $i }}</strong></div>
                <div class="mb-2">
                    <label for="hero_background_{{ $i }}" class="form-label">Background Slide {{ $i }}</label>
                    @if(!empty($settings['hero_background_' . $i]))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings['hero_background_' . $i]) }}" alt="Hero Background {{ $i }}" style="max-width:200px;">
                        </div>
                    @endif
                    <input class="form-control" type="file" id="hero_background_{{ $i }}" name="hero_background_{{ $i }}" accept="image/*">
                </div>
                <div class="mb-2">
                    <label for="hero_title_{{ $i }}" class="form-label">Judul Slide {{ $i }}</label>
                    <input type="text" class="form-control" id="hero_title_{{ $i }}" name="hero_title_{{ $i }}" value="{{ $settings['hero_title_' . $i] ?? '' }}">
                </div>
                <div class="mb-2">
                    <label for="hero_subtitle_{{ $i }}" class="form-label">Sub Judul Slide {{ $i }}</label>
                    <input type="text" class="form-control" id="hero_subtitle_{{ $i }}" name="hero_subtitle_{{ $i }}" value="{{ $settings['hero_subtitle_' . $i] ?? '' }}">
                </div>
            </div>
            @endfor
            <div class="mb-3">
                <label class="form-label">Statistik Beranda</label>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control" name="stat_siswa" value="{{ $settings['stat_siswa'] ?? '' }}" placeholder="Contoh: 70+">
                        <small class="text-muted">Siswa Aktif</small>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control" name="stat_guru" value="{{ $settings['stat_guru'] ?? '' }}" placeholder="Contoh: 7">
                        <small class="text-muted">Tenaga Pendidik</small>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control" name="stat_pengalaman" value="{{ $settings['stat_pengalaman'] ?? '' }}" placeholder="Contoh: 15+">
                        <small class="text-muted">Tahun Berpengalaman</small>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control" name="stat_akreditasi" value="{{ $settings['stat_akreditasi'] ?? '' }}" placeholder="Contoh: B">
                        <small class="text-muted">Akreditasi</small>
                    </div>
                </div>
            </div>
            <div class="mb-3 mt-4">
                <label for="visi" class="form-label">Visi</label>
                <textarea class="form-control" id="visi" name="visi" rows="3">{{ $settings['visi'] ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label for="misi" class="form-label">Misi (pisahkan dengan baris baru)</label>
                <textarea class="form-control" id="misi" name="misi" rows="5" placeholder="Setiap misi di baris baru">{{ $settings['misi'] ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label for="nilai_utama" class="form-label">Nilai Utama (pisahkan dengan koma)</label>
                <input type="text" class="form-control" id="nilai_utama" name="nilai_utama" value="{{ $settings['nilai_utama'] ?? '' }}" placeholder="Contoh: Religius, Nasionalis, Mandiri, Gotong Royong, Integritas">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Profil</button>
        </form>
    </div>
</div>
@endsection
