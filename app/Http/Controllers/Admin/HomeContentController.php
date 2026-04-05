<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeContentController extends Controller
{
    public function edit()
    {
        $teachers = $this->decodeSetting('teachers_data', [
            ['name' => 'Sri Nuraini, S.Pd.SD', 'position' => 'Kepala Sekolah', 'category' => 'kepala', 'education' => 'S1 Pendidikan', 'experience' => '20 Tahun', 'bio' => 'Memimpin SD Negeri 2 Kepuk dengan fokus karakter dan prestasi.', 'email' => 'sdn2kepukbangsri@gmail.com', 'phone' => '-', 'achievements' => "Kepala sekolah berpengalaman", 'photo_path' => 'bg7.png'],
            ['name' => 'Miftahul Umam, S.Pd', 'position' => 'Guru Kelas 4', 'category' => 'guru', 'education' => 'S1 PGSD', 'experience' => '12 Tahun', 'bio' => 'Guru kelas dengan pendekatan pembelajaran aktif dan kreatif.', 'email' => '-', 'phone' => '-', 'achievements' => "Guru teladan", 'photo_path' => 'bg1.png'],
        ]);

        $gallery = $this->decodeSetting('gallery_data', [
            ['title' => 'Pemberian Hadiah Siswa', 'description' => 'Dokumentasi kegiatan sekolah.', 'category' => 'kegiatan', 'image_path' => 'g1.webp'],
            ['title' => 'Festival Tunas Bahasa Ibu', 'description' => 'Prestasi siswa SDN 2 Kepuk.', 'category' => 'prestasi', 'image_path' => 'g2.webp'],
        ]);

        $news = $this->decodeSetting('news_data', [
            ['title' => 'Prestasi Siswa SDN 2 Kepuk', 'tag' => 'Prestasi', 'date' => 'Februari 2024', 'summary' => 'Siswa menorehkan prestasi membanggakan.', 'body' => 'Detail berita dapat ditulis di sini.', 'image_path' => 'b1.jpg'],
            ['title' => 'Kegiatan Sekolah Tahun Ajaran Baru', 'tag' => 'Kegiatan', 'date' => 'Juli 2024', 'summary' => 'Rangkaian kegiatan awal tahun ajaran.', 'body' => 'Detail kegiatan ditulis di sini.', 'image_path' => 'b2.jpg'],
        ]);

        $achievements = $this->decodeSetting('achievements_data', [
            ['title' => 'Juara 2 Olimpiade Sains Nasional Tingkat Kecamatan', 'level' => 'Akademik', 'date' => 'Februari 2024', 'description' => 'Siswa SDN 2 Kepuk meraih medali perak pada ajang OSN tingkat kecamatan.', 'image_path' => 'b1.jpg'],
            ['title' => 'Juara 3 Pesta Siaga Kecamatan Bangsri', 'level' => 'Pramuka', 'date' => 'Maret 2024', 'description' => 'Kontingen siaga tampil kompak dan berhasil membawa pulang juara 3.', 'image_path' => 'b3.jpg'],
        ]);

        $contact = $this->decodeSetting('contact_data', [
            'address' => 'Jl. Raya Kepuk - Plajan, Jepara',
            'email' => 'sdn2kepukbangsri@gmail.com',
            'hours' => 'Sen-Jum: 07.00-14.00; Sab: 07.00-12.00',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.6798204148004!2d110.77667867355963!3d-6.562038664145062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e712127041066b5%3A0xfa8486692f96fd11!2sSD%20Negeri%202%20Kepuk!5e0!3m2!1sid!2sid!4v1770814606089!5m2!1sid!2sid',
            'ppdb_whatsapp_1' => '6281229657204',
            'ppdb_label_1' => 'Bu Zuli',
            'ppdb_whatsapp_2' => '6282131607875',
            'ppdb_label_2' => 'Pak Fina',
            'tiktok_url' => 'https://www.tiktok.com/@sdn2kepuk',
            'instagram_url' => '',
            'facebook_url' => '',
            'youtube_url' => '',
        ]);

        $ppdb = $this->decodeSetting('ppdb_data', [
            'badge_text' => 'Penerimaan Peserta Didik Baru',
            'title' => 'PPDB',
            'subtitle' => 'SD Negeri 2 Kepuk - Pendaftaran Terbuka!',
            'description' => 'Bergabunglah bersama kami dan wujudkan generasi penerus bangsa yang cerdas, berkarakter, dan berakhlak mulia.',
            'requirements' => "FC Akte Kelahiran (1 lembar)\nFC KK & KTP Orang Tua (1 lembar)\nFC Ijazah TK\nMengisi formulir pendaftaran",
            'free_items' => "Biaya pendaftaran\nSeragam Merah Putih\nSeragam Pramuka\nAtribut Sekolah",
            'flyer_image' => '',
        ]);

        return view('admin.home-content.edit', compact('teachers', 'gallery', 'news', 'achievements', 'contact', 'ppdb'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'teachers' => ['nullable', 'array'],
            'teachers.*.name' => ['nullable', 'string'],
            'teachers.*.position' => ['nullable', 'string'],
            'teachers.*.category' => ['nullable', 'string'],
            'teachers.*.education' => ['nullable', 'string'],
            'teachers.*.experience' => ['nullable', 'string'],
            'teachers.*.bio' => ['nullable', 'string'],
            'teachers.*.email' => ['nullable', 'string'],
            'teachers.*.phone' => ['nullable', 'string'],
            'teachers.*.achievements' => ['nullable', 'string'],
            'teachers.*.photo_path' => ['nullable', 'string'],
            'teacher_photos.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],

            'gallery' => ['nullable', 'array'],
            'gallery.*.title' => ['nullable', 'string'],
            'gallery.*.description' => ['nullable', 'string'],
            'gallery.*.category' => ['nullable', 'string'],
            'gallery.*.image_path' => ['nullable', 'string'],
            'gallery_images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],

            'news' => ['nullable', 'array'],
            'news.*.title' => ['nullable', 'string'],
            'news.*.tag' => ['nullable', 'string'],
            'news.*.date' => ['nullable', 'string'],
            'news.*.summary' => ['nullable', 'string'],
            'news.*.body' => ['nullable', 'string'],
            'news.*.image_path' => ['nullable', 'string'],
            'news_images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],

            'achievements' => ['nullable', 'array'],
            'achievements.*.title' => ['nullable', 'string'],
            'achievements.*.level' => ['nullable', 'string'],
            'achievements.*.date' => ['nullable', 'string'],
            'achievements.*.description' => ['nullable', 'string'],
            'achievements.*.image_path' => ['nullable', 'string'],
            'achievements_images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],

            'contact.address' => ['nullable', 'string'],
            'contact.email' => ['nullable', 'string'],
            'contact.hours' => ['nullable', 'string'],
            'contact.map_embed_url' => ['nullable', 'string'],
            'contact.ppdb_whatsapp_1' => ['nullable', 'string'],
            'contact.ppdb_label_1' => ['nullable', 'string'],
            'contact.ppdb_whatsapp_2' => ['nullable', 'string'],
            'contact.ppdb_label_2' => ['nullable', 'string'],
            'contact.tiktok_url' => ['nullable', 'string'],
            'contact.instagram_url' => ['nullable', 'string'],
            'contact.facebook_url' => ['nullable', 'string'],
            'contact.youtube_url' => ['nullable', 'string'],

            'ppdb.badge_text' => ['nullable', 'string'],
            'ppdb.title' => ['nullable', 'string'],
            'ppdb.subtitle' => ['nullable', 'string'],
            'ppdb.description' => ['nullable', 'string'],
            'ppdb.requirements' => ['nullable', 'string'],
            'ppdb.free_items' => ['nullable', 'string'],
            'ppdb.flyer_image' => ['nullable', 'string'],
            'ppdb_flyer' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
        ]);

        $teachersInput = $data['teachers'] ?? [];
        $teachers = [];
        foreach ($teachersInput as $index => $teacher) {
            $teacher['name'] = trim((string) ($teacher['name'] ?? ''));
            if ($teacher['name'] === '') {
                continue;
            }

            if ($request->hasFile("teacher_photos.$index")) {
                $teacher['photo_path'] = $request->file("teacher_photos.$index")->store('settings', 'public');
            }

            $teacher['achievements'] = trim((string) ($teacher['achievements'] ?? ''));
            $teachers[] = $teacher;
        }

        $galleryInput = $data['gallery'] ?? [];
        $gallery = [];
        foreach ($galleryInput as $index => $item) {
            $item['title'] = trim((string) ($item['title'] ?? ''));
            if ($item['title'] === '') {
                continue;
            }

            if ($request->hasFile("gallery_images.$index")) {
                $item['image_path'] = $request->file("gallery_images.$index")->store('settings', 'public');
            }
            $gallery[] = $item;
        }

        $newsInput = $data['news'] ?? [];
        $news = [];
        foreach ($newsInput as $index => $item) {
            $item['title'] = trim((string) ($item['title'] ?? ''));
            if ($item['title'] === '') {
                continue;
            }

            if ($request->hasFile("news_images.$index")) {
                $item['image_path'] = $request->file("news_images.$index")->store('settings', 'public');
            }
            $news[] = $item;
        }

        $achievementsInput = $data['achievements'] ?? [];
        $achievements = [];
        foreach ($achievementsInput as $index => $item) {
            $item['title'] = trim((string) ($item['title'] ?? ''));
            if ($item['title'] === '') {
                continue;
            }

            if ($request->hasFile("achievements_images.$index")) {
                $item['image_path'] = $request->file("achievements_images.$index")->store('settings', 'public');
            }
            $achievements[] = $item;
        }

        Setting::updateOrCreate(['key' => 'teachers_data'], ['value' => json_encode($teachers)]);
        Setting::updateOrCreate(['key' => 'gallery_data'], ['value' => json_encode($gallery)]);
        Setting::updateOrCreate(['key' => 'news_data'], ['value' => json_encode($news)]);
        Setting::updateOrCreate(['key' => 'achievements_data'], ['value' => json_encode($achievements)]);
        Setting::updateOrCreate(['key' => 'contact_data'], ['value' => json_encode($data['contact'] ?? [])]);

        $ppdb = $data['ppdb'] ?? [];
        if ($request->hasFile('ppdb_flyer')) {
            $ppdb['flyer_image'] = $request->file('ppdb_flyer')->store('settings', 'public');
        }
        Setting::updateOrCreate(['key' => 'ppdb_data'], ['value' => json_encode($ppdb)]);

        return redirect()->route('admin.home-content.edit')->with('success', 'Konten homepage berhasil diperbarui.');
    }

    private function decodeSetting(string $key, array $default): array
    {
        $value = Setting::where('key', $key)->value('value');

        if (! is_string($value) || $value === '') {
            return $default;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : $default;
    }
}
