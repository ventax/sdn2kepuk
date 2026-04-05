<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $rules = [
            'logo_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ];
        // Tambahkan rules untuk 3 slide
        for ($i = 1; $i <= 3; $i++) {
            $rules['hero_background_' . $i] = 'nullable|image|mimes:jpg,jpeg,png,webp';
            $rules['hero_title_' . $i] = 'nullable|string';
            $rules['hero_subtitle_' . $i] = 'nullable|string';
        }
        // Statistik
        $rules['stat_siswa'] = 'nullable|string';
        $rules['stat_guru'] = 'nullable|string';
        $rules['stat_pengalaman'] = 'nullable|string';
        $rules['stat_akreditasi'] = 'nullable|string';

        // Visi, misi, nilai utama
        $rules['visi'] = 'nullable|string';
        $rules['misi'] = 'nullable|string';
        $rules['nilai_utama'] = 'nullable|string';

        // Profil sekolah ringkas
        $rules['school_name'] = 'nullable|string';
        $rules['principal_name'] = 'nullable|string';
        $rules['city'] = 'nullable|string';
        $rules['school_accreditation'] = 'nullable|string';
        $rules['school_address'] = 'nullable|string';
        $rules['school_phone'] = 'nullable|string';
        $rules['school_email'] = 'nullable|string';

        // Media sosial dan maps
        $rules['facebook_url'] = 'nullable|string';
        $rules['instagram_url'] = 'nullable|string';
        $rules['tiktok_url'] = 'nullable|string';
        $rules['twitter_url'] = 'nullable|string';
        $rules['youtube_url'] = 'nullable|string';
        $rules['map_embed_url'] = 'nullable|string';

        $data = $request->validate($rules);

        // Logo
        if ($request->hasFile('logo_image')) {
            $logoPath = $request->file('logo_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'logo_image'], ['value' => $logoPath]);
        }

        // 3 slide
        for ($i = 1; $i <= 3; $i++) {
            if ($request->hasFile('hero_background_' . $i)) {
                $bgPath = $request->file('hero_background_' . $i)->store('settings', 'public');
                Setting::updateOrCreate(['key' => 'hero_background_' . $i], ['value' => $bgPath]);
            }
            Setting::updateOrCreate(['key' => 'hero_title_' . $i], ['value' => $data['hero_title_' . $i] ?? '']);
            Setting::updateOrCreate(['key' => 'hero_subtitle_' . $i], ['value' => $data['hero_subtitle_' . $i] ?? '']);
        }

        // Statistik

        Setting::updateOrCreate(['key' => 'stat_siswa'], ['value' => $data['stat_siswa'] ?? '']);
        Setting::updateOrCreate(['key' => 'stat_guru'], ['value' => $data['stat_guru'] ?? '']);
        Setting::updateOrCreate(['key' => 'stat_pengalaman'], ['value' => $data['stat_pengalaman'] ?? '']);
        Setting::updateOrCreate(['key' => 'stat_akreditasi'], ['value' => $data['stat_akreditasi'] ?? '']);

        // Simpan visi, misi, nilai utama
        Setting::updateOrCreate(['key' => 'visi'], ['value' => $data['visi'] ?? '']);
        Setting::updateOrCreate(['key' => 'misi'], ['value' => $data['misi'] ?? '']);
        Setting::updateOrCreate(['key' => 'nilai_utama'], ['value' => $data['nilai_utama'] ?? '']);

        // Simpan profil sekolah ringkas
        Setting::updateOrCreate(['key' => 'school_name'], ['value' => $data['school_name'] ?? '']);
        Setting::updateOrCreate(['key' => 'principal_name'], ['value' => $data['principal_name'] ?? '']);
        Setting::updateOrCreate(['key' => 'city'], ['value' => $data['city'] ?? '']);
        Setting::updateOrCreate(['key' => 'school_accreditation'], ['value' => $data['school_accreditation'] ?? '']);
        Setting::updateOrCreate(['key' => 'school_address'], ['value' => $data['school_address'] ?? '']);
        Setting::updateOrCreate(['key' => 'school_phone'], ['value' => $data['school_phone'] ?? '']);
        Setting::updateOrCreate(['key' => 'school_email'], ['value' => $data['school_email'] ?? '']);

        // Simpan media sosial dan maps
        Setting::updateOrCreate(['key' => 'facebook_url'], ['value' => $data['facebook_url'] ?? '']);
        Setting::updateOrCreate(['key' => 'instagram_url'], ['value' => $data['instagram_url'] ?? '']);
        Setting::updateOrCreate(['key' => 'tiktok_url'], ['value' => $data['tiktok_url'] ?? '']);
        Setting::updateOrCreate(['key' => 'twitter_url'], ['value' => $data['twitter_url'] ?? '']);
        Setting::updateOrCreate(['key' => 'youtube_url'], ['value' => $data['youtube_url'] ?? '']);
        Setting::updateOrCreate(['key' => 'map_embed_url'], ['value' => $data['map_embed_url'] ?? '']);

        return redirect()->route('admin.settings.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
