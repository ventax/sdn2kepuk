@extends('admin.layouts.app')

@section('title', 'CMS Homepage')
@section('page_title', 'CMS Homepage Lengkap')

@section('content')
    <style>
        .cms-hero {
            background: linear-gradient(135deg, #0f9f87, #1d4ed8);
            color: #fff;
            border-radius: .85rem;
            padding: 1rem 1.1rem;
            margin-bottom: 1rem;
        }

        .cms-nav .nav-link {
            color: #334155;
            border: 1px solid #e2e8f0;
            border-radius: .65rem;
            padding: .5rem .8rem;
            font-weight: 600;
            background: #fff;
        }

        .cms-nav .nav-link.active {
            color: #fff;
            border-color: transparent;
            background: linear-gradient(135deg, #0f9f87, #0b6a5a);
        }

        .cms-item {
            border: 1px solid #e2e8f0;
            border-radius: .75rem;
            padding: .85rem;
            background: #fff;
        }
    </style>

    <div class="cms-hero d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1 fw-bold">Kelola Semua Konten Website</h5>
            <small class="opacity-75">Pilih tab sesuai bagian website yang ingin diedit.</small>
        </div>
        <span class="badge text-bg-light">CMS Homepage</span>
    </div>

    <form action="{{ route('admin.home-content.update') }}" method="POST" enctype="multipart/form-data"
        class="content-card p-4">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-end align-items-center mb-3">
            <button type="submit" class="btn btn-brand rounded-3">Simpan Semua</button>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3">{{ $errors->first() }}</div>
        @endif

        <div class="alert alert-light border rounded-3 mb-4">
            <strong>Panduan singkat:</strong> isi data seperlunya saja. Fokus di field utama seperti nama, judul, dan
            gambar.
            Field lain boleh dikosongkan.
        </div>

        <ul class="nav nav-pills cms-nav gap-2 mb-4" role="tablist">
            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="pill"
                    data-bs-target="#tabTeachers" type="button">1. Guru</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                    data-bs-target="#tabGallery" type="button">2. Galeri</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                    data-bs-target="#tabNews" type="button">3. Berita</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                    data-bs-target="#tabPpdb" type="button">4. PPDB</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                    data-bs-target="#tabContact" type="button">5. Kontak</button></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tabTeachers">
                <p class="text-secondary small mb-3">Isi nama, jabatan, kategori, dan foto. Data ini tampil di section Guru.
                </p>
                <div id="teachersRepeater" class="row g-3">
                    @foreach ($teachers as $index => $teacher)
                        <div class="col-12 teacher-item cms-item">
                            <input type="hidden" name="teachers[{{ $index }}][photo_path]"
                                value="{{ $teacher['photo_path'] ?? '' }}">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>Guru {{ $index + 1 }}</strong>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="removeItem(this)">Hapus</button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-4"><input class="form-control" name="teachers[{{ $index }}][name]"
                                        value="{{ $teacher['name'] ?? '' }}" placeholder="Nama"></div>
                                <div class="col-md-4"><input class="form-control"
                                        name="teachers[{{ $index }}][position]"
                                        value="{{ $teacher['position'] ?? '' }}" placeholder="Jabatan"></div>
                                <div class="col-md-4"><input class="form-control"
                                        name="teachers[{{ $index }}][category]"
                                        value="{{ $teacher['category'] ?? '' }}"
                                        placeholder="Kategori (kepala/guru/mapel)"></div>
                                <div class="col-md-4"><input type="file" class="form-control"
                                        name="teacher_photos[{{ $index }}]" accept="image/*"></div>
                                <div class="col-md-4"><input class="form-control"
                                        name="teachers[{{ $index }}][email]" value="{{ $teacher['email'] ?? '' }}"
                                        placeholder="Email"></div>
                                <div class="col-md-4"><input class="form-control"
                                        name="teachers[{{ $index }}][phone]" value="{{ $teacher['phone'] ?? '' }}"
                                        placeholder="Telepon"></div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="2" name="teachers[{{ $index }}][bio]" placeholder="Bio singkat">{{ $teacher['bio'] ?? '' }}</textarea>
                                </div>
                                <div class="col-12">
                                    <details>
                                        <summary class="small text-secondary">Field lanjutan (opsional)</summary>
                                        <div class="row g-2 mt-1">
                                            <div class="col-md-6"><input class="form-control"
                                                    name="teachers[{{ $index }}][education]"
                                                    value="{{ $teacher['education'] ?? '' }}" placeholder="Pendidikan">
                                            </div>
                                            <div class="col-md-6"><input class="form-control"
                                                    name="teachers[{{ $index }}][experience]"
                                                    value="{{ $teacher['experience'] ?? '' }}" placeholder="Pengalaman">
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" rows="2" name="teachers[{{ $index }}][achievements]"
                                                    placeholder="Prestasi (pisahkan dengan ;)">{{ $teacher['achievements'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </details>
                                </div>
                            </div>
                            @if (!empty($teacher['photo_path']))
                                <small class="text-secondary d-block mt-2">Foto saat ini:
                                    {{ $teacher['photo_path'] }}</small>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-light mt-3" onclick="addTeacherRow()">+ Tambah Guru</button>
            </div>

            <div class="tab-pane fade" id="tabGallery">
                <p class="text-secondary small mb-3">Isi judul, kategori, deskripsi, dan gambar.</p>
                <div id="galleryRepeater" class="row g-3">
                    @foreach ($gallery as $index => $item)
                        <div class="col-12 gallery-item-row cms-item">
                            <input type="hidden" name="gallery[{{ $index }}][image_path]"
                                value="{{ $item['image_path'] ?? '' }}">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>Galeri {{ $index + 1 }}</strong>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="removeItem(this)">Hapus</button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-4"><input class="form-control"
                                        name="gallery[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}"
                                        placeholder="Judul"></div>
                                <div class="col-md-4"><input class="form-control"
                                        name="gallery[{{ $index }}][category]"
                                        value="{{ $item['category'] ?? '' }}" placeholder="Kategori"></div>
                                <div class="col-md-4"><input type="file" class="form-control"
                                        name="gallery_images[{{ $index }}]" accept="image/*"></div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="2" name="gallery[{{ $index }}][description]"
                                        placeholder="Deskripsi">{{ $item['description'] ?? '' }}</textarea>
                                </div>
                            </div>
                            @if (!empty($item['image_path']))
                                <small class="text-secondary d-block mt-2">Gambar saat ini:
                                    {{ $item['image_path'] }}</small>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-light mt-3" onclick="addGalleryRow()">+ Tambah Galeri</button>
            </div>

            <div class="tab-pane fade" id="tabNews">
                <p class="text-secondary small mb-3">Isi judul, ringkasan, isi berita, dan gambar.</p>
                <div id="newsRepeater" class="row g-3">
                    @foreach ($news as $index => $item)
                        <div class="col-12 news-item-row cms-item">
                            <input type="hidden" name="news[{{ $index }}][image_path]"
                                value="{{ $item['image_path'] ?? '' }}">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>Berita {{ $index + 1 }}</strong>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="removeItem(this)">Hapus</button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6"><input class="form-control"
                                        name="news[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}"
                                        placeholder="Judul berita"></div>
                                <div class="col-md-3"><input class="form-control" name="news[{{ $index }}][tag]"
                                        value="{{ $item['tag'] ?? '' }}" placeholder="Tag"></div>
                                <div class="col-md-3"><input class="form-control" name="news[{{ $index }}][date]"
                                        value="{{ $item['date'] ?? '' }}" placeholder="Tanggal"></div>
                                <div class="col-md-12"><input class="form-control"
                                        name="news[{{ $index }}][summary]" value="{{ $item['summary'] ?? '' }}"
                                        placeholder="Ringkasan"></div>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="4" name="news[{{ $index }}][body]" placeholder="Isi berita">{{ $item['body'] ?? '' }}</textarea>
                                </div>
                                <div class="col-md-12"><input type="file" class="form-control"
                                        name="news_images[{{ $index }}]" accept="image/*"></div>
                            </div>
                            @if (!empty($item['image_path']))
                                <small class="text-secondary d-block mt-2">Gambar saat ini:
                                    {{ $item['image_path'] }}</small>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-light mt-3" onclick="addNewsRow()">+ Tambah Berita</button>
            </div>

            <div class="tab-pane fade" id="tabPpdb">
                <p class="text-secondary small mb-3">Atur tampilan section PPDB di halaman utama.</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Badge Text</label>
                        <input class="form-control" name="ppdb[badge_text]" value="{{ $ppdb['badge_text'] ?? '' }}"
                            placeholder="Contoh: Penerimaan Peserta Didik Baru">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Judul Utama</label>
                        <input class="form-control" name="ppdb[title]" value="{{ $ppdb['title'] ?? '' }}"
                            placeholder="Contoh: PPDB">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Sub Judul</label>
                        <input class="form-control" name="ppdb[subtitle]" value="{{ $ppdb['subtitle'] ?? '' }}"
                            placeholder="Contoh: SD Negeri 2 Kepuk - Pendaftaran Terbuka!">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Flyer PPDB</label>
                        <input type="hidden" name="ppdb[flyer_image]" value="{{ $ppdb['flyer_image'] ?? '' }}">
                        <input type="file" class="form-control" name="ppdb_flyer" accept="image/*">
                        @if (!empty($ppdb['flyer_image']))
                            <small class="text-secondary d-block mt-2">Flyer saat ini: {{ $ppdb['flyer_image'] }}</small>
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" rows="3" name="ppdb[description]" placeholder="Deskripsi singkat PPDB">{{ $ppdb['description'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Syarat Pendaftaran (1 baris = 1 item)</label>
                        <textarea class="form-control" rows="6" name="ppdb[requirements]"
                            placeholder="FC Akte Kelahiran&#10;FC KK &amp; KTP Orang Tua">{{ $ppdb['requirements'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Daftar GRATIS (1 baris = 1 item)</label>
                        <textarea class="form-control" rows="6" name="ppdb[free_items]"
                            placeholder="Biaya pendaftaran&#10;Seragam Merah Putih">{{ $ppdb['free_items'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tabContact">
                <p class="text-secondary small mb-3">Data ini tampil di bagian kontak, PPDB, dan footer website.</p>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Alamat</label><input class="form-control"
                            name="contact[address]" value="{{ $contact['address'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">Email</label><input class="form-control"
                            name="contact[email]" value="{{ $contact['email'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">Jam Operasional</label><input class="form-control"
                            name="contact[hours]" value="{{ $contact['hours'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">TikTok URL</label><input class="form-control"
                            name="contact[tiktok_url]" value="{{ $contact['tiktok_url'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">WA PPDB 1 (format 628xxx)</label><input
                            class="form-control" name="contact[ppdb_whatsapp_1]"
                            value="{{ $contact['ppdb_whatsapp_1'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">Label WA 1</label><input class="form-control"
                            name="contact[ppdb_label_1]" value="{{ $contact['ppdb_label_1'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">WA PPDB 2 (format 628xxx)</label><input
                            class="form-control" name="contact[ppdb_whatsapp_2]"
                            value="{{ $contact['ppdb_whatsapp_2'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">Label WA 2</label><input class="form-control"
                            name="contact[ppdb_label_2]" value="{{ $contact['ppdb_label_2'] ?? '' }}"></div>
                    <div class="col-12"><label class="form-label">Google Maps Embed URL</label>
                        <textarea class="form-control" rows="3" name="contact[map_embed_url]">{{ $contact['map_embed_url'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-brand rounded-3">Simpan Semua</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        let teacherIndex = {{ count($teachers) }};
        let galleryIndex = {{ count($gallery) }};
        let newsIndex = {{ count($news) }};

        function removeItem(button) {
            const item = button.closest('.teacher-item, .gallery-item-row, .news-item-row');
            if (item) item.remove();
        }

        function addTeacherRow() {
            const wrap = document.getElementById('teachersRepeater');
            wrap.insertAdjacentHTML('beforeend', `
            <div class="col-12 teacher-item cms-item">
                <input type="hidden" name="teachers[${teacherIndex}][photo_path]" value="">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong>Guru ${teacherIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeItem(this)">Hapus</button>
                </div>
                <div class="row g-2">
                    <div class="col-md-4"><input class="form-control" name="teachers[${teacherIndex}][name]" placeholder="Nama"></div>
                    <div class="col-md-4"><input class="form-control" name="teachers[${teacherIndex}][position]" placeholder="Jabatan"></div>
                    <div class="col-md-4"><input class="form-control" name="teachers[${teacherIndex}][category]" placeholder="Kategori (kepala/guru/mapel)"></div>
                    <div class="col-md-4"><input type="file" class="form-control" name="teacher_photos[${teacherIndex}]" accept="image/*"></div>
                    <div class="col-md-6"><input class="form-control" name="teachers[${teacherIndex}][email]" placeholder="Email"></div>
                    <div class="col-md-6"><input class="form-control" name="teachers[${teacherIndex}][phone]" placeholder="Telepon"></div>
                    <div class="col-12"><textarea class="form-control" rows="2" name="teachers[${teacherIndex}][bio]" placeholder="Bio singkat"></textarea></div>
                    <div class="col-12">
                        <details>
                            <summary class="small text-secondary">Field lanjutan (opsional)</summary>
                            <div class="row g-2 mt-1">
                                <div class="col-md-6"><input class="form-control" name="teachers[${teacherIndex}][education]" placeholder="Pendidikan"></div>
                                <div class="col-md-6"><input class="form-control" name="teachers[${teacherIndex}][experience]" placeholder="Pengalaman"></div>
                                <div class="col-12"><textarea class="form-control" rows="2" name="teachers[${teacherIndex}][achievements]" placeholder="Prestasi (pisahkan dengan ;)"></textarea></div>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        `);
            teacherIndex++;
        }

        function addGalleryRow() {
            const wrap = document.getElementById('galleryRepeater');
            wrap.insertAdjacentHTML('beforeend', `
            <div class="col-12 gallery-item-row cms-item">
                <input type="hidden" name="gallery[${galleryIndex}][image_path]" value="">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong>Galeri ${galleryIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeItem(this)">Hapus</button>
                </div>
                <div class="row g-2">
                    <div class="col-md-4"><input class="form-control" name="gallery[${galleryIndex}][title]" placeholder="Judul"></div>
                    <div class="col-md-4"><input class="form-control" name="gallery[${galleryIndex}][category]" placeholder="Kategori"></div>
                    <div class="col-md-4"><input type="file" class="form-control" name="gallery_images[${galleryIndex}]" accept="image/*"></div>
                    <div class="col-12"><textarea class="form-control" rows="2" name="gallery[${galleryIndex}][description]" placeholder="Deskripsi"></textarea></div>
                </div>
            </div>
        `);
            galleryIndex++;
        }

        function addNewsRow() {
            const wrap = document.getElementById('newsRepeater');
            wrap.insertAdjacentHTML('beforeend', `
            <div class="col-12 news-item-row cms-item">
                <input type="hidden" name="news[${newsIndex}][image_path]" value="">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong>Berita ${newsIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeItem(this)">Hapus</button>
                </div>
                <div class="row g-2">
                    <div class="col-md-6"><input class="form-control" name="news[${newsIndex}][title]" placeholder="Judul berita"></div>
                    <div class="col-md-3"><input class="form-control" name="news[${newsIndex}][tag]" placeholder="Tag"></div>
                    <div class="col-md-3"><input class="form-control" name="news[${newsIndex}][date]" placeholder="Tanggal"></div>
                    <div class="col-md-12"><input class="form-control" name="news[${newsIndex}][summary]" placeholder="Ringkasan"></div>
                    <div class="col-md-12"><textarea class="form-control" rows="4" name="news[${newsIndex}][body]" placeholder="Isi berita"></textarea></div>
                    <div class="col-md-12"><input type="file" class="form-control" name="news_images[${newsIndex}]" accept="image/*"></div>
                </div>
            </div>
        `);
            newsIndex++;
        }
    </script>
@endpush
