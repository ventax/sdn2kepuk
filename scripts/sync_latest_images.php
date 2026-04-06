<?php

declare(strict_types=1);

use App\Models\Setting;
use Illuminate\Contracts\Console\Kernel;

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$settingsDir = storage_path('app/public/settings');

if (!is_dir($settingsDir)) {
    fwrite(STDERR, "settings folder not found: {$settingsDir}" . PHP_EOL);
    exit(1);
}

$files = glob($settingsDir . '/*.{jpg,jpeg,png,webp,gif,JPG,JPEG,PNG,WEBP,GIF}', GLOB_BRACE) ?: [];
if (count($files) === 0) {
    fwrite(STDERR, "no image files found in {$settingsDir}" . PHP_EOL);
    exit(1);
}

usort($files, static function (string $a, string $b): int {
    $timeA = @filemtime($a) ?: 0;
    $timeB = @filemtime($b) ?: 0;

    if ($timeA === $timeB) {
        return strcmp(basename($b), basename($a));
    }

    return $timeB <=> $timeA;
});

$relativePool = array_values(array_map(static fn(string $path): string => 'settings/' . basename($path), $files));
$cursor = 0;

$take = static function (int $count) use (&$cursor, $relativePool): array {
    $slice = array_slice($relativePool, $cursor, $count);
    $cursor += count($slice);

    return $slice;
};

$assignOne = static function (string $key, ?string $value): void {
    if ($value === null || $value === '') {
        return;
    }

    Setting::updateOrCreate(['key' => $key], ['value' => $value]);
};

$logo = $take(1)[0] ?? null;
$hero = $take(3);

$teachers = json_decode((string) Setting::where('key', 'teachers_data')->value('value'), true);
$gallery = json_decode((string) Setting::where('key', 'gallery_data')->value('value'), true);
$news = json_decode((string) Setting::where('key', 'news_data')->value('value'), true);
$achievements = json_decode((string) Setting::where('key', 'achievements_data')->value('value'), true);
$ppdb = json_decode((string) Setting::where('key', 'ppdb_data')->value('value'), true);

$teachers = is_array($teachers) ? $teachers : [];
$gallery = is_array($gallery) ? $gallery : [];
$news = is_array($news) ? $news : [];
$achievements = is_array($achievements) ? $achievements : [];
$ppdb = is_array($ppdb) ? $ppdb : [];

$teacherImages = $take(count($teachers));
foreach ($teachers as $idx => $item) {
    $teachers[$idx]['photo_path'] = $teacherImages[$idx] ?? ($item['photo_path'] ?? '');
}

$galleryImages = $take(count($gallery));
foreach ($gallery as $idx => $item) {
    $gallery[$idx]['image_path'] = $galleryImages[$idx] ?? ($item['image_path'] ?? '');
}

$newsImages = $take(count($news));
foreach ($news as $idx => $item) {
    $news[$idx]['image_path'] = $newsImages[$idx] ?? ($item['image_path'] ?? '');
}

$achievementImages = $take(count($achievements));
foreach ($achievements as $idx => $item) {
    $achievements[$idx]['image_path'] = $achievementImages[$idx] ?? ($item['image_path'] ?? '');
}

$ppdbImage = $take(1)[0] ?? ($ppdb['flyer_image'] ?? '');
$ppdb['flyer_image'] = $ppdbImage;

$assignOne('logo_image', $logo);
$assignOne('hero_background_1', $hero[0] ?? null);
$assignOne('hero_background_2', $hero[1] ?? null);
$assignOne('hero_background_3', $hero[2] ?? null);
$assignOne('teachers_data', json_encode($teachers));
$assignOne('gallery_data', json_encode($gallery));
$assignOne('news_data', json_encode($news));
$assignOne('achievements_data', json_encode($achievements));
$assignOne('ppdb_data', json_encode($ppdb));

$result = [
    'pool_total' => count($relativePool),
    'pool_used' => $cursor,
    'assigned' => [
        'logo_image' => $logo,
        'hero_background_1' => $hero[0] ?? null,
        'hero_background_2' => $hero[1] ?? null,
        'hero_background_3' => $hero[2] ?? null,
        'teachers_count' => count($teacherImages),
        'gallery_count' => count($galleryImages),
        'news_count' => count($newsImages),
        'achievements_count' => count($achievementImages),
        'ppdb_flyer' => $ppdbImage,
    ],
];

echo json_encode($result, JSON_PRETTY_PRINT) . PHP_EOL;
