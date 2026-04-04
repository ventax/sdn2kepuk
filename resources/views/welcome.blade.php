<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SD Negeri 2 Kepuk - Lembaga Pendidikan Berkarakter & Berprestasi</title>
    <meta name="description"
        content="SD Negeri 2 Kepuk - Sekolah Dasar terkemuka dengan tenaga pendidik profesional dan fasilitas modern">
    @php
        use App\Helpers\SettingHelper;
        $backgroundImage = SettingHelper::get('background_image');
        $mainImage = SettingHelper::get('main_image');
        $logoImage = SettingHelper::get('logo_image');
        // Hero slides
        $heroSlides = [];
        for ($i = 1; $i <= 3; $i++) {
            $heroSlides[] = [
                'background' => SettingHelper::get('hero_background_' . $i),
                'title' => SettingHelper::get('hero_title_' . $i),
                'subtitle' => SettingHelper::get('hero_subtitle_' . $i),
            ];
        }
        // Statistik
        $statSiswa = SettingHelper::get('stat_siswa', '70+');
        $statGuru = SettingHelper::get('stat_guru', '7');
        $statPengalaman = SettingHelper::get('stat_pengalaman', '15+');
        $statAkreditasi = SettingHelper::get('stat_akreditasi', 'B');

        // CMS homepage data
        $teachersCms = json_decode(SettingHelper::get('teachers_data', '[]'), true);
        $galleryCms = json_decode(SettingHelper::get('gallery_data', '[]'), true);
        $newsCms = json_decode(SettingHelper::get('news_data', '[]'), true);
        $contactCms = json_decode(SettingHelper::get('contact_data', '{}'), true);
        $ppdbCms = json_decode(SettingHelper::get('ppdb_data', '{}'), true);

        $teachersCms = is_array($teachersCms) ? $teachersCms : [];
        $galleryCms = is_array($galleryCms) ? $galleryCms : [];
        $newsCms = is_array($newsCms) ? $newsCms : [];
        $contactCms = is_array($contactCms) ? $contactCms : [];
        $ppdbCms = is_array($ppdbCms) ? $ppdbCms : [];

        $contactAddress = $contactCms['address'] ?? 'Jl. Raya Kepuk - Plajan, Jepara';
        $contactEmail = $contactCms['email'] ?? 'sdn2kepukbangsri@gmail.com';
        $contactHours = $contactCms['hours'] ?? 'Sen-Jum: 07.00-14.00 • Sab: 07.00-12.00';
        $mapEmbedUrl =
            $contactCms['map_embed_url'] ??
            'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.6798204148004!2d110.77667867355963!3d-6.562038664145062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e712127041066b5%3A0xfa8486692f96fd11!2sSD%20Negeri%202%20Kepuk!5e0!3m2!1sid!2sid!4v1770814606089!5m2!1sid!2sid';
        $ppdbWa1 = $contactCms['ppdb_whatsapp_1'] ?? '6281229657204';
        $ppdbWa2 = $contactCms['ppdb_whatsapp_2'] ?? '6282131607875';
        $ppdbLabel1 = $contactCms['ppdb_label_1'] ?? 'Bu Zuli';
        $ppdbLabel2 = $contactCms['ppdb_label_2'] ?? 'Pak Fina';
        $tiktokUrl = $contactCms['tiktok_url'] ?? 'https://www.tiktok.com/@sdn2kepuk';

        $baseUrl = rtrim(request()->getBaseUrl(), '/');
        $storageBaseUrl = ($baseUrl !== '' ? $baseUrl : '') . '/storage';
        $mediaBaseUrl = ($baseUrl !== '' ? $baseUrl : '') . '/media';

        $resolveCmsMediaUrl = function (?string $path) use ($mediaBaseUrl) {
            $normalized = str_replace('\\', '/', (string) $path);

            if ($normalized === '') {
                return '';
            }

            if (str_starts_with($normalized, 'http://') || str_starts_with($normalized, 'https://')) {
                return $normalized;
            }

            if (str_starts_with($normalized, '/storage/')) {
                return $mediaBaseUrl . '/' . ltrim(str_replace('/storage/', '', $normalized), '/');
            }

            if (str_starts_with($normalized, 'storage/')) {
                return $mediaBaseUrl . '/' . ltrim(str_replace('storage/', '', $normalized), '/');
            }

            if (str_starts_with($normalized, 'public/')) {
                return $mediaBaseUrl . '/' . ltrim(str_replace('public/', '', $normalized), '/');
            }

            return $mediaBaseUrl . '/' . ltrim($normalized, '/');
        };

        $headmaster = null;
        foreach ($teachersCms as $teacherItem) {
            if (($teacherItem['category'] ?? '') === 'kepala') {
                $headmaster = $teacherItem;
                break;
            }
        }
        if ($headmaster === null && !empty($teachersCms)) {
            $headmaster = $teachersCms[0];
        }

        $headmasterName = $headmaster['name'] ?? 'Sri Nuraini, S.Pd.SD';
        $headmasterPosition = $headmaster['position'] ?? 'Kepala SD Negeri 2 Kepuk';
        $headmasterPhoto = $resolveCmsMediaUrl($headmaster['photo_path'] ?? '');

        $ppdbBadgeText = $ppdbCms['badge_text'] ?? 'Penerimaan Peserta Didik Baru';
        $ppdbTitle = $ppdbCms['title'] ?? 'PPDB';
        $ppdbSubtitle = $ppdbCms['subtitle'] ?? 'SD Negeri 2 Kepuk - Pendaftaran Terbuka!';
        $ppdbDescription =
            $ppdbCms['description'] ??
            'Bergabunglah bersama kami dan wujudkan generasi penerus bangsa yang cerdas, berkarakter, dan berakhlak mulia.';
        $ppdbRequirementsRaw =
            $ppdbCms['requirements'] ??
            "FC Akte Kelahiran (1 lembar)\nFC KK & KTP Orang Tua (1 lembar)\nFC Ijazah TK\nMengisi formulir pendaftaran";
        $ppdbFreeItemsRaw =
            $ppdbCms['free_items'] ?? "Biaya pendaftaran\nSeragam Merah Putih\nSeragam Pramuka\nAtribut Sekolah";
        $ppdbFlyerUrl = $resolveCmsMediaUrl($ppdbCms['flyer_image'] ?? '');

        $ppdbRequirements = array_values(
            array_filter(
                array_map('trim', preg_split('/\r?\n/', (string) $ppdbRequirementsRaw) ?: []),
                fn($value) => $value !== '',
            ),
        );
        $ppdbFreeItems = array_values(
            array_filter(
                array_map('trim', preg_split('/\r?\n/', (string) $ppdbFreeItemsRaw) ?: []),
                fn($value) => $value !== '',
            ),
        );
    @endphp
    <link rel="icon" type="image/jpeg"
        href="{{ $logoImage ? asset('storage/' . $logoImage) : asset('images/logo-sdn2-kepuk.jpeg') }}">
    <link rel="shortcut icon" type="image/jpeg"
        href="{{ $logoImage ? asset('storage/' . $logoImage) : asset('images/logo-sdn2-kepuk.jpeg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Crimson+Pro:wght@600;700&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Crimson Pro', 'serif']
                    }
                }
            }
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .nav-blur {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.95);
        }

        .slider-container {
            position: relative;
            height: 420px;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.8s ease;
            display: flex;
            align-items: center;
        }

        .slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.25);
            z-index: 1;
        }

        .slide>div {
            position: relative;
            z-index: 2;
        }

        .slide.active {
            opacity: 1;
            z-index: 1;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            padding: 0;
        }

        .dot.active {
            width: 36px;
            border-radius: 6px;
            background: white;
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.15);
        }

        .teacher-card {
            position: relative;
            overflow: hidden;
            transition: all 0.5s;
            background: white;
        }

        .teacher-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
            transition: left 0.6s;
        }

        .teacher-card:hover::before {
            left: 100%;
        }

        .teacher-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .teacher-photo-wrapper {
            position: relative;
            width: 160px;
            margin: 0 auto 1.5rem;
        }

        .teacher-photo {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 4px solid #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            transition: all 0.4s;
            overflow: hidden;
        }

        .teacher-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
        }

        .teacher-card:hover .teacher-photo {
            transform: scale(1.05);
            border-color: #3b82f6;
        }

        .teacher-card-item {
            width: calc(25% - 1.5rem);
            min-width: 220px;
        }

        .filter-btn {
            position: relative;
            transition: all 0.3s;
            font-weight: 500;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .filter-btn:not(.active):hover {
            background: #f3f4f6;
            color: #1d4ed8;
        }

        .gallery-category-btn {
            transition: all 0.3s;
            font-weight: 500;
        }

        .gallery-category-btn.active {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .gallery-category-btn:not(.active):hover {
            background: #f3f4f6;
            color: #1d4ed8;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(8px);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 700px;
            width: 92%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: slideUp 0.4s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-15px)
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0
            }

            to {
                transform: scale(1);
                opacity: 1
            }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8125rem;
            font-weight: 600;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 280px;
        }

        .gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.25);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* Compact gallery */
        .gallery-item-sm {
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem;
            cursor: pointer;
            aspect-ratio: 1/1;
            transition: all 0.3s ease;
        }

        .gallery-item-sm img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
            display: block;
        }

        .gallery-item-sm:hover img {
            transform: scale(1.08);
        }

        .gallery-item-sm.gallery-hidden {
            display: none !important;
        }

        .lightbox {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
        }

        .lightbox.active {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .lightbox-content {
            position: relative;
            width: 800px;
            max-width: 90vw;
            animation: zoomIn 0.4s ease;
        }

        .lightbox-content img {
            width: 100%;
            height: 520px;
            object-fit: cover;
            border-radius: 0.75rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
            display: block;
        }

        .lightbox-close {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            font-size: 1.25rem;
            color: white;
            cursor: pointer;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        .lightbox-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            font-size: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lightbox-nav:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .lightbox-prev {
            left: 2rem;
        }

        .lightbox-next {
            right: 2rem;
        }

        @media (max-width:1024px) {
            .teacher-card-item {
                width: calc(33.333% - 1rem);
                min-width: 180px;
            }
        }

        @media (max-width:768px) {
            .slider-container {
                height: 320px;
            }

            #teacherFilterWrap {
                flex-wrap: nowrap;
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: .35rem;
                margin-bottom: 1.25rem;
            }

            #teacherFilterWrap .filter-btn {
                white-space: nowrap;
                padding: .55rem .9rem;
                font-size: .85rem;
                flex: 0 0 auto;
            }

            #teachersGrid {
                gap: .85rem !important;
                margin-bottom: 0 !important;
            }

            .teacher-card-item {
                width: calc(50% - .45rem);
                min-width: 0;
                padding: 1rem !important;
                border-radius: 1rem;
            }

            .teacher-photo-wrapper {
                width: 92px;
                margin: 0 auto .75rem;
            }

            .teacher-photo {
                width: 92px;
                height: 92px;
                font-size: 2rem;
                border-width: 3px;
            }

            .teacher-card-item h3 {
                font-size: 1rem;
                line-height: 1.35;
            }

            .teacher-card-item p {
                font-size: .92rem;
            }
        }

        /* Hide scrollbar globally but keep scroll functionality */
        *:not(.misi-list) {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        *:not(.misi-list)::-webkit-scrollbar {
            display: none;
        }

        /* Misi list scrollbar */
        .misi-list {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .misi-list::-webkit-scrollbar {
            display: block;
            width: 4px;
        }

        .misi-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .misi-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }

        /* Ticker */
        .ticker-wrapper {
            max-width: 280px;
        }

        @keyframes tickerScroll {
            0% {
                transform: translateX(100%)
            }

            100% {
                transform: translateX(-100%)
            }
        }

        .ticker-text {
            display: inline-block;
            animation: tickerScroll 20s linear infinite;
        }
    </style>
</head>

<body class="bg-white font-sans">



    <!-- Navigation -->
    <nav class="nav-blur sticky top-0 z-50 border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-14">
                <div class="flex items-center space-x-3">
                    <img src="{{ $logoImage ? asset('storage/' . $logoImage) : asset('images/logo-sdn2-kepuk.jpeg') }}"
                        alt="Logo SD Negeri 2 Kepuk" class="w-9 h-9 object-contain">
                    <div>
                        <h1 class="text-base font-bold text-gray-900 leading-tight">SD Negeri 2 Kepuk</h1>
                        <p class="text-xs text-gray-500">Unggul dalam Prestasi &amp; Karakter</p>
                    </div>
                </div>
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="#beranda"
                        class="px-3 py-1.5 text-sm text-gray-600 hover:text-blue-600 font-medium transition rounded-lg hover:bg-blue-50">Beranda</a>
                    <a href="#profil"
                        class="px-3 py-1.5 text-sm text-gray-600 hover:text-blue-600 font-medium transition rounded-lg hover:bg-blue-50">Profil</a>
                    <a href="#berita"
                        class="px-3 py-1.5 text-sm text-gray-600 hover:text-blue-600 font-medium transition rounded-lg hover:bg-blue-50">Berita</a>
                    <a href="#guru"
                        class="px-3 py-1.5 text-sm text-gray-600 hover:text-blue-600 font-medium transition rounded-lg hover:bg-blue-50">Tenaga
                        Pendidik</a>
                    <a href="#galeri"
                        class="px-3 py-1.5 text-sm text-gray-600 hover:text-blue-600 font-medium transition rounded-lg hover:bg-blue-50">Galeri</a>

                    <a href="#ppdb"
                        class="px-3 py-1.5 text-sm text-white bg-yellow-500 hover:bg-yellow-600 font-bold transition rounded-lg shadow-sm">PPDB</a>
                    <a href="#kontak"
                        class="ml-2 px-4 py-1.5 text-sm bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">Hubungi
                        Kami</a>
                </div>
                <button class="lg:hidden text-gray-600 p-2" onclick="toggleMenu()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="mobileMenu" class="hidden lg:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-1">
                <a href="#beranda"
                    class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 rounded-lg font-medium">Beranda</a>
                <a href="#profil"
                    class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 rounded-lg font-medium">Profil</a>
                <a href="#berita"
                    class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 rounded-lg font-medium">Berita &
                    Pengumuman</a>
                <a href="#guru"
                    class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 rounded-lg font-medium">Tenaga
                    Pendidik</a>
                <a href="#galeri"
                    class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 rounded-lg font-medium">Galeri</a>

                <a href="#ppdb" class="block px-3 py-2 text-sm text-white bg-yellow-500 rounded-lg font-bold">PPDB
                    2025–2026</a>
                <a href="#kontak"
                    class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 rounded-lg font-medium">Hubungi
                    Kami</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section id="beranda" class="relative overflow-hidden">
        <div class="slider-container">
            @foreach ($heroSlides as $idx => $slide)
                <div class="slide{{ $idx === 0 ? ' active' : '' }}"
                    style="background:url('{{ $slide['background'] ? asset('storage/' . $slide['background']) : 'slide_' . ($idx + 1) . '.jpg' }}') center/cover no-repeat;">
                    <div class="max-w-7xl mx-auto px-4 w-full">
                        <div class="max-w-3xl mx-auto text-white text-center">
                            <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold mb-4 leading-tight">
                                {{ $slide['title'] ?? '' }}</h1>
                            <p class="text-base md:text-lg mb-6 text-blue-100 leading-relaxed">
                                {{ $slide['subtitle'] ?? '' }}</p>
                            @if ($idx === 0)
                                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                    <a href="#ppdb"
                                        class="inline-flex items-center justify-center px-5 py-2.5 text-sm bg-white text-blue-700 font-bold rounded-lg hover:bg-gray-50 transition shadow-lg">Daftar
                                        Sekarang <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg></a>
                                    <a href="#profil"
                                        class="inline-flex items-center justify-center px-5 py-2.5 text-sm border-2 border-white text-white font-bold rounded-lg hover:bg-white hover:text-blue-700 transition">Pelajari
                                        Lebih Lanjut</a>
                                </div>
                            @elseif($idx === 1)
                                <a href="#guru"
                                    class="inline-flex items-center justify-center px-5 py-2.5 text-sm bg-white text-blue-700 font-bold rounded-lg hover:bg-gray-50 transition shadow-lg">Lihat
                                    Profil Guru</a>
                            @elseif($idx === 2)
                                <a href="#berita"
                                    class="inline-flex items-center justify-center px-5 py-2.5 text-sm bg-white text-blue-700 font-bold rounded-lg hover:bg-gray-50 transition shadow-lg">Baca
                                    Berita</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <button onclick="previousSlide()"
                class="absolute left-6 top-1/2 -translate-y-1/2 w-14 h-14 bg-white bg-opacity-20 backdrop-blur-md hover:bg-opacity-30 text-white rounded-full z-10 flex items-center justify-center text-3xl font-bold">&#8249;</button>
            <button onclick="nextSlide()"
                class="absolute right-6 top-1/2 -translate-y-1/2 w-14 h-14 bg-white bg-opacity-20 backdrop-blur-md hover:bg-opacity-30 text-white rounded-full z-10 flex items-center justify-center text-3xl font-bold">&#8250;</button>
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3 z-10">
                @foreach ($heroSlides as $idx => $slide)
                    <button class="dot{{ $idx === 0 ? ' active' : '' }}"
                        onclick="goToSlide({{ $idx }})"></button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-8 bg-gradient-to-br from-blue-700 to-blue-900">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center reveal">
                    <div class="text-3xl lg:text-4xl font-bold text-white mb-1">{{ $statSiswa }}</div>
                    <p class="text-blue-200 text-sm font-medium">Siswa Aktif</p>
                </div>
                <div class="text-center reveal">
                    <div class="text-3xl lg:text-4xl font-bold text-white mb-1">{{ $statGuru }}</div>
                    <p class="text-blue-200 text-sm font-medium">Tenaga Pendidik</p>
                </div>
                <div class="text-center reveal">
                    <div class="text-3xl lg:text-4xl font-bold text-white mb-1">{{ $statPengalaman }}</div>
                    <p class="text-blue-200 text-sm font-medium">Tahun Berpengalaman</p>
                </div>
                <div class="text-center reveal">
                    <div class="text-3xl lg:text-4xl font-bold text-white mb-1">{{ $statAkreditasi }}</div>
                    <p class="text-blue-200 text-sm font-medium">Akreditasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil -->


    <!-- Profil Sekolah (Visi, Misi, Nilai Utama) -->
    <section id="profil" class="pt-48 pb-24 bg-gray-50">
        @php
            $visi = App\Helpers\SettingHelper::get('visi');
            $misi = App\Helpers\SettingHelper::get('misi');
            $nilaiUtama = App\Helpers\SettingHelper::get('nilai_utama');
            $misiList = $misi ? preg_split('/\r?\n/', $misi) : [];
            $nilaiUtamaList = $nilaiUtama ? array_map('trim', explode(',', $nilaiUtama)) : [];
        @endphp
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16 reveal">
                <h2 class="text-3xl lg:text-4xl font-serif font-bold text-gray-900 mb-2">Profil Sekolah</h2>
                <p class="text-base text-gray-500 max-w-3xl mx-auto">Membangun fondasi pendidikan yang kuat untuk masa
                    depan generasi penerus bangsa</p>
            </div>
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="card-hover bg-white p-8 rounded-2xl shadow-md border reveal">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $visi }}</p>
                </div>
                <div class="card-hover bg-white p-8 rounded-2xl shadow-md border reveal">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                    <ol class="misi-list text-gray-600 space-y-2 text-sm leading-relaxed list-decimal list-inside overflow-y-auto"
                        style="max-height:160px;">
                        @foreach ($misiList as $item)
                            @if (trim($item) !== '')
                                <li>{{ $item }}</li>
                            @endif
                        @endforeach
                    </ol>
                </div>
                <div class="card-hover bg-white p-8 rounded-2xl shadow-md border reveal">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Nilai Utama</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($nilaiUtamaList as $nilai)
                            @if (trim($nilai) !== '')
                                <span class="badge bg-blue-100 text-blue-800">{{ $nilai }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sambutan -->
    <section id="sambutan" class="pt-48 pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-36 reveal">
                <h2 class="text-3xl lg:text-4xl font-serif font-bold text-gray-900 mb-3">Sambutan Kepala Sekolah</h2>
                <div class="w-16 h-1 bg-blue-600 mx-auto rounded-full"></div>
            </div>
            <div class="flex justify-center reveal">
                <div class="relative max-w-3xl w-full border border-gray-200 rounded-2xl p-8 bg-white"
                    style="box-shadow: 0 8px 30px rgba(59,130,246,0.2);">
                    <div class="absolute -top-24 left-1/2 -translate-x-1/2">
                        <div class="w-44 h-44 rounded-full overflow-hidden border-4 border-white"
                            style="box-shadow: 0 4px 15px rgba(59,130,246,0.3);">
                            <img src="{{ $headmasterPhoto ?: 'bg7.png' }}" alt="Kepala Sekolah"
                                class="w-full h-full object-cover" style="object-position: center center;">
                        </div>
                    </div>
                    <div class="mt-24 text-gray-800 leading-relaxed space-y-3 text-base">
                        <p>Assalamu'alaikum Wr. Wb.</p>
                        <p>Di masa sekarang penyampaian informasi tidak terbatas hanya pada surat, namun juga media
                            sosial sangat berpengaruh. Untuk itu SD Negeri 2 Kepuk telah merilis website resmi ini.
                            Dengan adanya website ini semoga informasi-informasi dapat dengan mudah diakses.
                            Kegiatan-kegiatan yang dilaksanakan di SD Negeri 2 Kepuk juga dapat diketahui oleh publik
                            yang lebih luas lagi.</p>
                        <p>Wassalamu'alaikum Wr. Wb.</p>
                    </div>
                    <div class="mt-6 pt-5 border-t border-gray-100">
                        <p class="font-bold text-gray-900 text-base">{{ $headmasterName }}</p>
                        <p class="text-gray-500 text-sm">{{ $headmasterPosition }}</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Guru -->
    <section id="guru" class="py-24 bg-gradient-to-br from-blue-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16 reveal">

                <h2 class="text-3xl lg:text-4xl font-serif font-bold text-gray-900 mb-2">Guru &amp; Staf
                    Profesional</h2>
                <p class="text-base text-gray-500 max-w-3xl mx-auto">Didukung oleh tenaga pendidik bersertifikat
                    dan berpengalaman</p>
            </div>
            <div id="teacherFilterWrap" class="flex flex-wrap justify-center gap-3 mb-12 reveal">
                <button class="filter-btn active px-6 py-3 bg-white rounded-xl shadow-md font-semibold"
                    onclick="filterTeachers(event,'all')">Semua Tim</button>
                <button class="filter-btn px-6 py-3 bg-white rounded-xl shadow-md font-semibold"
                    onclick="filterTeachers(event,'kepala')">Kepala Sekolah</button>
                <button class="filter-btn px-6 py-3 bg-white rounded-xl shadow-md font-semibold"
                    onclick="filterTeachers(event,'guru')">Guru Kelas</button>
                <button class="filter-btn px-6 py-3 bg-white rounded-xl shadow-md font-semibold"
                    onclick="filterTeachers(event,'mapel')">Guru Mapel</button>

            </div>
            <div id="teachersGrid" class="flex flex-wrap justify-center gap-8 mb-16">
                <div class="teacher-card teacher-card-item rounded-2xl shadow-lg p-8 reveal" data-category="kepala"
                    data-id="1">
                    <div class="teacher-photo-wrapper">
                        <div class="teacher-photo"><img src="bg7.png" alt="Kepala Sekolah"
                                style="width:100%;height:100%;object-fit:cover;object-position:center center;">
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Sri Nuraini, S.Pd.SD</h3>
                        <p class="text-blue-600 font-semibold">Kepala Sekolah</p>
                    </div>
                </div>
                <div class="teacher-card teacher-card-item rounded-2xl shadow-lg p-8 reveal" data-category="guru"
                    data-id="2">
                    <div class="teacher-photo-wrapper">
                        <div class="teacher-photo"><img src="bg1.png" alt="Siti Maryam"
                                style="object-position:44% 45%;"></div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Miftahul Umam, S.Pd</h3>
                        <p class="text-blue-600 font-semibold">Guru Kelas 4</p>
                    </div>
                </div>
                <div class="teacher-card teacher-card-item rounded-2xl shadow-lg p-8 reveal" data-category="guru"
                    data-id="3">
                    <div class="teacher-photo-wrapper">
                        <div class="teacher-photo"><img src="bg2.png" alt="Budi Wijaya"
                                style="object-position:46% 38%;"></div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Nanik Prasetyoningsih, S.Pd.SD</h3>
                        <p class="text-blue-600 font-semibold">Guru Kelas 6</p>
                    </div>
                </div>
                <div class="teacher-card teacher-card-item rounded-2xl shadow-lg p-8 reveal" data-category="guru"
                    data-id="4">
                    <div class="teacher-photo-wrapper">
                        <div class="teacher-photo"><img src="bg3.png" alt="Rina Anggraini"
                                style="object-position:47% 32%;"></div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Titin Efelin Dwi Susanti, S.Pd.SD</h3>
                        <p class="text-blue-600 font-semibold">Guru Kelas 2</p>
                    </div>
                </div>
                <div class="teacher-card teacher-card-item rounded-2xl shadow-lg p-8 reveal" data-category="guru"
                    data-id="5">
                    <div class="teacher-photo-wrapper">
                        <div class="teacher-photo"><img src="bg4.png" alt="Ahmad Hidayat"
                                style="object-position:45% 36%;"></div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Zuliyati, S.Pd.SD</h3>
                        <p class="text-blue-600 font-semibold">Guru Kelas 1</p>
                    </div>
                </div>
                <div class="teacher-card teacher-card-item rounded-2xl shadow-lg p-8 reveal" data-category="guru"
                    data-id="6">
                    <div class="teacher-photo-wrapper">
                        <div class="teacher-photo"><img src="bg5.png" alt="Dewi Lestari"
                                style="object-position:42% 43%;"></div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Fina Hermawan, S.Pd.SD</h3>
                        <p class="text-blue-600 font-semibold">Guru Kelas 5</p>
                    </div>
                </div>
                <div class="teacher-card teacher-card-item rounded-2xl shadow-lg p-8 reveal" data-category="mapel"
                    data-id="7">
                    <div class="teacher-photo-wrapper">
                        <div class="teacher-photo"><img src="bg6.png" alt="Nur Aini"
                                style="object-position:50% 39%;"></div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Nur Chamnah, S.Pd</h3>
                        <p class="text-blue-600 font-semibold">Guru Mapel</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- Modal -->
    <div id="modal" class="modal" onclick="handleModalClick(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="sticky top-0 bg-white border-b p-6 flex justify-between items-center z-10">
                <h3 class="text-2xl font-bold" id="modalName">Profil Guru</h3>
                <button onclick="closeModal()"
                    class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="p-6"></div>
        </div>
    </div>

    <!-- Galeri -->
    <section id="galeri" class="py-14 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-8 reveal">
                <h2 class="text-3xl lg:text-4xl font-serif font-bold text-gray-900 mb-2">Dokumentasi Kegiatan</h2>
                <p class="text-base text-gray-500 max-w-xl mx-auto mb-6">Momen berharga kegiatan dan prestasi siswa
                    SD Negeri 2 Kepuk</p>
                <div class="flex flex-wrap justify-center gap-2">
                    <button onclick="filterGallery(event,'all')"
                        class="gallery-category-btn active px-4 py-1.5 text-sm rounded-full border border-gray-300 bg-white">Semua</button>
                    <button onclick="filterGallery(event,'pembelajaran')"
                        class="gallery-category-btn px-4 py-1.5 text-sm rounded-full border border-gray-300 bg-white">Pembelajaran</button>
                    <button onclick="filterGallery(event,'prestasi')"
                        class="gallery-category-btn px-4 py-1.5 text-sm rounded-full border border-gray-300 bg-white">Prestasi</button>
                    <button onclick="filterGallery(event,'kegiatan')"
                        class="gallery-category-btn px-4 py-1.5 text-sm rounded-full border border-gray-300 bg-white">Kegiatan</button>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2" id="galleryGrid">
                <div class="gallery-item-sm reveal" data-category="kegiatan" onclick="openLightbox(0)"><img
                        src="g1.webp" alt="Pemberian Hadiah Siswa"></div>
                <div class="gallery-item-sm reveal" data-category="prestasi" onclick="openLightbox(1)"><img
                        src="g2.webp" alt="Festival Tunas Bahasa Ibu"></div>
                <div class="gallery-item-sm reveal" data-category="prestasi" onclick="openLightbox(2)"><img
                        src="g3.webp" alt="Juara Pramuka"></div>
                <div class="gallery-item-sm reveal" data-category="prestasi" onclick="openLightbox(3)"><img
                        src="g4.webp" alt="POPDA Kabupaten Jepara"></div>
                <div class="gallery-item-sm reveal" data-category="prestasi" onclick="openLightbox(4)"><img
                        src="g5.webp" alt="Medali Olahraga"></div>
                <div class="gallery-item-sm reveal" data-category="prestasi" onclick="openLightbox(5)"><img
                        src="g6.webp" alt="POPDA 2023"></div>
                <div class="gallery-item-sm reveal" data-category="prestasi" onclick="openLightbox(6)"><img
                        src="g7.webp" alt="Olimpiade Sains Nasional 2024"></div>
                <div class="gallery-item-sm reveal" data-category="kegiatan" onclick="openLightbox(7)"><img
                        src="g8.webp" alt="Vaksinasi Siswa SDN 2 Kepuk"></div>
                <div class="gallery-item-sm reveal" data-category="kegiatan" onclick="openLightbox(8)"><img
                        src="g9.webp" alt="Penampilan Tari Tradisional"></div>
                <div class="gallery-item-sm reveal" data-category="kegiatan" onclick="openLightbox(9)"><img
                        src="g10.webp" alt="Latihan Baris Berbaris"></div>
                <div class="gallery-item-sm reveal" data-category="kegiatan" onclick="openLightbox(10)"><img
                        src="g11.webp" alt="Vaksinasi Siswa"></div>
                <div class="gallery-item-sm reveal" data-category="kegiatan" onclick="openLightbox(11)"><img
                        src="g12.webp" alt="Outing Class Saloka"></div>
                <div class="gallery-item-sm reveal" data-category="kegiatan" onclick="openLightbox(12)"><img
                        src="g13.webp" alt="Gelar Karya P5"></div>
                <div class="gallery-item-sm reveal" data-category="pembelajaran" onclick="openLightbox(13)"><img
                        src="g14.webp" alt="Sholat Berjamaah di Kelas"></div>
            </div>
        </div>
    </section>

    <!-- Berita -->
    <section id="berita" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16 reveal">
                <h2 class="text-3xl lg:text-4xl font-serif font-bold text-gray-900 mb-2">Berita</h2>
                <p class="text-base text-gray-500 max-w-3xl mx-auto">Informasi terbaru seputar kegiatan SD Negeri 2
                    Kepuk</p>
            </div>
            <!-- Slider Berita -->
            <div class="relative reveal">
                <!-- Tombol Prev -->
                <button onclick="prevBeritaSlide()"
                    class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-5 z-10 w-11 h-11 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center hover:bg-blue-600 hover:text-white hover:border-blue-600 transition group">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <!-- Tombol Next -->
                <button onclick="nextBeritaSlide()"
                    class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-5 z-10 w-11 h-11 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center hover:bg-blue-600 hover:text-white hover:border-blue-600 transition group">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <!-- Track -->
                <div class="overflow-hidden">
                    <div id="beritaTrack" class="flex transition-transform duration-500 ease-in-out gap-5">
                        <article
                            class="bg-white rounded-xl shadow-sm border overflow-hidden card-hover flex flex-col cursor-pointer flex-shrink-0"
                            style="width: calc((100% - 3*1.25rem) / 4)" onclick="openBerita(0)">
                            <img src="b1.jpg" alt="Imam Hadi Nugroho Juara 2 OSN 2024"
                                class="w-full h-56 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span
                                        class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">Prestasi</span>
                                    <span class="text-xs text-gray-400">Februari 2024</span>
                                </div>
                                <h4 class="text-sm font-bold text-gray-900 mb-1.5 leading-snug line-clamp-2">Imam
                                    Hadi Nugroho Raih Juara 2 Olimpiade Sains Nasional 2024</h4>
                                <p class="text-xs text-gray-500 leading-relaxed flex-1 line-clamp-2">Siswa SDN 2
                                    Kepuk berhasil meraih medali perak dalam ajang Olimpiade Sains Nasional 2024
                                    tingkat Kecamatan Bangsri, Jepara.</p>
                                <button onclick="event.stopPropagation();openBerita(0)"
                                    class="text-xs text-blue-600 font-semibold mt-2 inline-flex items-center hover:text-blue-800 transition">Baca
                                    Selengkapnya <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg></button>
                            </div>
                        </article>
                        <article
                            class="bg-white rounded-xl shadow-sm border overflow-hidden card-hover flex flex-col cursor-pointer flex-shrink-0"
                            style="width: calc((100% - 3*1.25rem) / 4)" onclick="openBerita(1)">
                            <img src="b2.jpg" style="object-position:top" alt="Berita"
                                class="w-full h-56 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span
                                        class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">Prestasi</span>
                                    <span class="text-xs text-gray-400">Oktober 2023</span>
                                </div>
                                <h4 class="text-sm font-bold text-gray-900 mb-1.5 leading-snug line-clamp-2">SDN 2
                                    Kepuk Raih Medali Perak di POPDA Kabupaten Jepara 2023</h4>
                                <p class="text-xs text-gray-500 leading-relaxed flex-1 line-clamp-2">Atlet SDN 2
                                    Kepuk berhasil meraih Juara 2 dan membawa pulang medali perak dalam ajang POPDA
                                    Kabupaten Jepara Tahun 2023.</p>
                                <button onclick="event.stopPropagation();openBerita(1)"
                                    class="text-xs text-blue-600 font-semibold mt-2 inline-flex items-center hover:text-blue-800 transition">Baca
                                    Selengkapnya <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg></button>
                            </div>
                        </article>
                        <article
                            class="bg-white rounded-xl shadow-sm border overflow-hidden card-hover flex flex-col cursor-pointer flex-shrink-0"
                            style="width: calc((100% - 3*1.25rem) / 4)" onclick="openBerita(2)">
                            <img src="b3.jpg" style="object-position:top" alt="Berita"
                                class="w-full h-56 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span
                                        class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">Pramuka</span>
                                    <span class="text-xs text-gray-400">2024</span>
                                </div>
                                <h4 class="text-sm font-bold text-gray-900 mb-1.5 leading-snug line-clamp-2">SDN 2
                                    Kepuk Raih Juara 3 Lomba Pesta Siaga Kecamatan Bangsri</h4>
                                <p class="text-xs text-gray-500 leading-relaxed flex-1 line-clamp-2">Kontingen
                                    Siaga SDN 2 Kepuk berhasil meraih Juara 3 dalam Lomba Pesta Siaga tingkat
                                    Kecamatan Bangsri dengan penampilan kompak dan membanggakan.</p>
                                <button onclick="event.stopPropagation();openBerita(2)"
                                    class="text-xs text-blue-600 font-semibold mt-2 inline-flex items-center hover:text-blue-800 transition">Baca
                                    Selengkapnya <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg></button>
                            </div>
                        </article>
                        <article
                            class="bg-white rounded-xl shadow-sm border overflow-hidden card-hover flex flex-col cursor-pointer flex-shrink-0"
                            style="width: calc((100% - 3*1.25rem) / 4)" onclick="openBerita(3)">
                            <img src="b4.jpg" style="object-position:center" alt="Berita"
                                class="w-full h-56 object-cover">
                            <div class="p-4 flex flex-col flex-1">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span
                                        class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">Seni
                                        & Budaya</span>
                                    <span class="text-xs text-gray-400">15 Feb 2026</span>
                                </div>
                                <h4 class="text-sm font-bold text-gray-900 mb-1.5 leading-snug line-clamp-2">SDN 2
                                    Kepuk Raih Juara Harapan 1 Festival Tunas Bahasa Ibu Kecamatan Bangsri</h4>
                                <p class="text-xs text-gray-500 leading-relaxed flex-1 line-clamp-2">Siswa SDN 2
                                    Kepuk tampil memukau dalam Festival Tunas Bahasa Ibu Saedikcam Bangsri dan
                                    berhasil meraih Juara Harapan 1.</p>
                                <button onclick="event.stopPropagation();openBerita(3)"
                                    class="text-xs text-blue-600 font-semibold mt-2 inline-flex items-center hover:text-blue-800 transition">Baca
                                    Selengkapnya <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg></button>
                            </div>
                        </article>
                    </div>
                </div>
                <!-- Dot Indicators -->
                <div class="flex justify-center gap-2 mt-6">
                    <button class="berita-dot w-3 h-3 rounded-full bg-blue-600 transition-all"
                        onclick="goToBeritaSlide(0)"></button>
                    <button class="berita-dot w-3 h-3 rounded-full bg-gray-300 transition-all"
                        onclick="goToBeritaSlide(1)"></button>
                    <button class="berita-dot w-3 h-3 rounded-full bg-gray-300 transition-all"
                        onclick="goToBeritaSlide(2)"></button>
                    <button class="berita-dot w-3 h-3 rounded-full bg-gray-300 transition-all"
                        onclick="goToBeritaSlide(3)"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Berita -->
    <div id="beritaModal" class="modal" onclick="handleBeritaModalClick(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div id="beritaModalImg" class="w-full h-64 overflow-hidden rounded-t-2xl"><img id="beritaModalImgSrc"
                    src="" alt="" class="w-full h-full object-cover">
            </div>
            <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center z-10">
                <div class="flex items-center gap-2">
                    <span id="beritaModalTag" class="text-xs font-semibold px-2 py-0.5 rounded-full"></span>
                    <span id="beritaModalDate" class="text-xs text-gray-400"></span>
                </div>
                <button onclick="closeBerita()"
                    class="w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <h3 id="beritaModalTitle" class="text-2xl font-bold text-gray-900 mb-4 leading-snug"></h3>
                <div id="beritaModalBody" class="text-gray-600 leading-relaxed space-y-4 text-sm"></div>
            </div>
        </div>
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox" onclick="handleLightboxClick(event)">
        <div class="lightbox-content">
            <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
            <button class="lightbox-nav lightbox-prev"
                onclick="changeImage(-1);event.stopPropagation();">&#10094;</button>
            <img id="lightboxImage" src="" alt="">
            <button class="lightbox-nav lightbox-next"
                onclick="changeImage(1);event.stopPropagation();">&#10095;</button>
        </div>
    </div>

    <!-- PPDB -->
    <section id="ppdb"
        class="py-16 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-32 h-32 bg-yellow-400 opacity-20 rounded-br-full"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 bg-yellow-400 opacity-10 rounded-tl-full"></div>
        <div class="absolute top-10 right-10 w-6 h-6 bg-yellow-400 opacity-60 rotate-45"></div>
        <div class="absolute bottom-10 left-16 w-4 h-4 bg-white opacity-30 rotate-45"></div>

        <div class="max-w-6xl mx-auto px-4 relative z-10">
            <!-- Header + Flyer -->
            <div class="flex flex-col lg:flex-row items-center gap-10 mb-10 reveal">
                <!-- Flyer Image -->
                <div class="lg:w-72 flex-shrink-0">
                    <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-yellow-400"
                        style="transform: rotate(-2deg);">
                        <img src="{{ $ppdbFlyerUrl ?: 'ppdb-flyer.png' }}" alt="Flyer PPDB"
                            class="w-full h-auto object-cover">
                    </div>
                </div>
                <!-- Title -->
                <div class="flex-1 text-center lg:text-left">
                    <div
                        class="inline-block bg-yellow-400 text-blue-900 font-black text-xs px-4 py-1.5 rounded-full mb-4 uppercase tracking-widest">
                        {{ $ppdbBadgeText }}</div>
                    <div class="flex items-center justify-center lg:justify-start gap-4 mb-3">
                        <h2 class="text-6xl lg:text-8xl font-black text-white drop-shadow-lg">{{ $ppdbTitle }}
                        </h2>
                    </div>
                    <p class="text-blue-200 text-sm font-medium">{{ $ppdbSubtitle }}</p>
                    <p class="text-white text-sm mt-3 leading-relaxed opacity-80">{{ $ppdbDescription }}</p>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid md:grid-cols-2 gap-6 mb-8 reveal">
                <!-- Syarat Pendaftaran -->
                <div
                    class="bg-white bg-opacity-10 backdrop-blur-sm border border-white border-opacity-20 rounded-2xl p-6">
                    <div
                        class="inline-flex items-center gap-2 bg-blue-600 text-white font-bold text-sm px-4 py-2 rounded-lg mb-5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Syarat Pendaftaran
                    </div>
                    <ul class="space-y-3">
                        @foreach ($ppdbRequirements as $requirement)
                            <li class="flex items-start gap-3 text-white">
                                <span
                                    class="w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg
                                        class="w-3 h-3 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg></span>
                                <span class="text-sm font-medium">{{ $requirement }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Gratis -->
                <div class="bg-yellow-400 rounded-2xl p-6">
                    <div
                        class="inline-flex items-center gap-2 bg-blue-800 text-white font-bold text-sm px-4 py-2 rounded-lg mb-5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                        GRATIS
                    </div>
                    <ul class="space-y-3">
                        @foreach ($ppdbFreeItems as $freeItem)
                            <li class="flex items-start gap-3 text-blue-900">
                                <span
                                    class="w-5 h-5 bg-blue-800 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg
                                        class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg></span>
                                <span class="text-sm font-bold">{{ $freeItem }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Info Pendaftaran -->
            <div class="bg-white bg-opacity-10 border border-white border-opacity-20 rounded-2xl p-6 reveal">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-white font-bold text-lg">Info Pendaftaran</h3>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <a href="https://wa.me/{{ $ppdbWa1 }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-3 bg-white bg-opacity-10 hover:bg-opacity-20 transition rounded-xl px-4 py-3 group">
                        <div class="w-9 h-9 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm group-hover:text-yellow-300 transition">
                                {{ $ppdbWa1 }}</p>
                            <p class="text-blue-200 text-xs">{{ $ppdbLabel1 }}</p>
                        </div>
                    </a>
                    <a href="https://wa.me/{{ $ppdbWa2 }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-3 bg-white bg-opacity-10 hover:bg-opacity-20 transition rounded-xl px-4 py-3 group">
                        <div class="w-9 h-9 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm group-hover:text-yellow-300 transition">
                                {{ $ppdbWa2 }}</p>
                            <p class="text-blue-200 text-xs">{{ $ppdbLabel2 }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-12 bg-white">
        <div class="max-w-5xl mx-auto px-4">
            <div class="text-center mb-8 reveal">
                <h2 class="text-3xl lg:text-4xl font-serif font-bold text-gray-900 mb-2">Kontak &amp; Lokasi</h2>
                <p class="text-gray-500 text-sm">Silakan hubungi kami untuk informasi lebih lanjut</p>
            </div>
            <div class="grid lg:grid-cols-5 gap-6 reveal">
                <!-- Info Kontak -->
                <div class="lg:col-span-2 space-y-2">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Alamat</p>
                            <p class="text-sm text-gray-700 font-medium leading-snug">{{ $contactAddress }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Email</p>
                            <p class="text-sm text-gray-700 font-medium"><a href="mailto:{{ $contactEmail }}"
                                    class="hover:text-blue-600 transition">{{ $contactEmail }}</a></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Jam Operasional</p>
                            <p class="text-sm text-gray-700 font-medium">{{ $contactHours }}</p>
                        </div>
                    </div>
                </div>
                <!-- Peta -->
                <div class="lg:col-span-3">
                    <div class="rounded-xl overflow-hidden shadow border border-gray-200">
                        <iframe src="{{ $mapEmbedUrl }}" width="100%" height="260" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p class="text-xs text-blue-700 mt-2 text-center">🗺️ Klik peta untuk membuka di Google Maps
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ $logoImage ? asset('storage/' . $logoImage) : asset('images/logo-sdn2-kepuk.jpeg') }}"
                            alt="Logo" class="w-12 h-12 object-contain">
                        <h3 class="text-xl font-bold">SD Negeri 2 Kepuk</h3>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-4">Lembaga pendidikan yang berkomitmen membentuk
                        generasi penerus bangsa yang cerdas, berkarakter, dan berakhlak mulia.</p>
                    <div class="flex space-x-3">
                        <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 bg-gray-800 border border-gray-600 rounded-full flex items-center justify-center hover:bg-black transition"
                            title="TikTok SDN 2 Kepuk">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"
                                class="w-5 h-5">
                                <path
                                    d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.85 4.85 0 0 1-1.01-.06z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Link Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#profil" class="text-gray-400 hover:text-white transition">Profil Sekolah</a>
                        </li>
                        <li><a href="#berita" class="text-gray-400 hover:text-white transition">Berita &
                                Pengumuman</a></li>
                        <li><a href="#guru" class="text-gray-400 hover:text-white transition">Tenaga
                                Pendidik</a></li>

                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="mailto:{{ $contactEmail }}"
                                class="hover:text-white transition">{{ $contactEmail }}</a></li>
                        <li>{{ $contactAddress }}</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm">&copy; 2025 SD Negeri 2 Kepuk. Hak Cipta Dilindungi.</p>
                <p class="text-gray-500 text-xs">{{ $contactAddress }}</p>
            </div>
        </div>
    </footer>

    <script>
        window.cmsTeachersData = @json($teachersCms);
        window.cmsGalleryData = @json($galleryCms);
        window.cmsNewsData = @json($newsCms);
        window.cmsStorageBaseUrl = @json($storageBaseUrl);
        window.cmsMediaBaseUrl = @json($mediaBaseUrl);
    </script>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
