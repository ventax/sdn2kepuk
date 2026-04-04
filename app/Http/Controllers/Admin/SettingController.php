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

        return redirect()->route('admin.settings.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
