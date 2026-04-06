// =====================
// SLIDER FUNCTIONALITY
// =====================
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
let autoSlideInterval;

function showSlide(index) {
    slides.forEach(s => s.classList.remove('active'));
    dots.forEach(d => d.classList.remove('active'));
    if (index >= slides.length) currentSlide = 0;
    if (index < 0) currentSlide = slides.length - 1;
    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');
}

function nextSlide() {
    currentSlide++;
    showSlide(currentSlide);
    resetAutoSlide();
}

function previousSlide() {
    currentSlide--;
    showSlide(currentSlide);
    resetAutoSlide();
}

function goToSlide(index) {
    currentSlide = index;
    showSlide(currentSlide);
    resetAutoSlide();
}

function startAutoSlide() {
    autoSlideInterval = setInterval(nextSlide, 6000);
}

function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
}

startAutoSlide();

// =====================
// MOBILE MENU
// =====================
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('hidden');
}

// =====================
// SMOOTH SCROLL
// =====================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            document.getElementById('mobileMenu').classList.add('hidden');
        }
    });
});

// =====================
// SCROLL REVEAL
// =====================
const revealElements = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
        }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

revealElements.forEach(el => revealObserver.observe(el));

function observeNewRevealElements(container) {
    if (!container || !revealObserver) return;
    container.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
}

// =====================
// TEACHER FILTER
// =====================
function filterTeachers(event, category) {
    const cards = document.querySelectorAll('.teacher-card');
    const btns = document.querySelectorAll('.filter-btn');

    btns.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    cards.forEach((card, i) => {
        if (category === 'all' || card.dataset.category === category) {
            card.style.display = 'block';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, i * 50);
        } else {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => card.style.display = 'none', 300);
        }
    });
}

// =====================
// TEACHER DATA & MODAL
// =====================
let teacherData = {
    1: {
        name: 'Drs. Supriyanto, M.Pd',
        position: 'Kepala Sekolah',
        education: 'S2 Manajemen Pendidikan - UNY',
        experience: '25 Tahun',
        bio: 'Memimpin SD Negeri 2 Kepuk sejak 2018 dengan visi menciptakan sekolah unggul dalam prestasi dan karakter.',
        achievements: ['Kepala Sekolah Berprestasi Tingkat Kabupaten 2022', 'Sertifikasi Kepala Sekolah Nasional', 'Pelatihan Manajemen Berbasis Sekolah', 'Workshop Pengembangan Kurikulum Merdeka'],
        contact: { email: 'supriyanto@sdn2kepuk.sch.id', phone: '(0274) 123-4567' }
    },
    2: {
        name: 'Siti Maryam, S.Pd',
        position: 'Guru Kelas 1A',
        education: 'S1 PGSD - UNY',
        experience: '15 Tahun',
        bio: 'Spesialis pembelajaran anak usia dini dengan metode fun learning yang menyenangkan dan efektif.',
        achievements: ['Guru Berprestasi Kecamatan 2024', 'Juara 1 Lomba Inovasi Pembelajaran 2023', 'Sertifikasi Pendidik Profesional', 'Pelatihan Pembelajaran Abad 21'],
        contact: { email: 'siti.maryam@sdn2kepuk.sch.id', phone: '-' }
    },
    3: {
        name: 'Budi Wijaya, S.Pd',
        position: 'Guru Kelas 2A',
        education: 'S1 PGSD - UNY',
        experience: '12 Tahun',
        bio: 'Ahli pengembangan kreativitas siswa melalui pembelajaran berbasis proyek dan seni.',
        achievements: ['Pembina Ekstrakurikuler Seni Terbaik 2023', 'Pelatihan Project Based Learning', 'Workshop Kreativitas Anak', 'Sertifikasi Pendidik Profesional'],
        contact: { email: 'budi.wijaya@sdn2kepuk.sch.id', phone: '-' }
    },
    4: {
        name: 'Rina Anggraini, S.Pd',
        position: 'Guru Bahasa Inggris',
        education: 'S1 Pendidikan Bahasa Inggris - UNS',
        experience: '10 Tahun',
        bio: 'Berpengalaman mengajar dengan metode komunikatif dan interaktif untuk anak.',
        achievements: ['TOEFL Score: 550', 'Pelatihan Teaching English for Young Learners', 'Workshop Multimedia Learning', 'Sertifikasi Pendidik Profesional'],
        contact: { email: 'rina.anggraini@sdn2kepuk.sch.id', phone: '-' }
    },
    5: {
        name: 'Ahmad Hidayat, S.Pd',
        position: 'Guru Penjasorkes',
        education: 'S1 Pendidikan Jasmani - UNY',
        experience: '8 Tahun',
        bio: 'Pelatih olahraga yang membawa siswa meraih prestasi di berbagai turnamen olahraga.',
        achievements: ['Pelatih Futsal Bersertifikat Lisensi C', 'Wasit Atletik Tingkat Kabupaten', 'Guru Olahraga Berprestasi 2023', 'Sertifikasi Pendidik Profesional'],
        contact: { email: 'ahmad.hidayat@sdn2kepuk.sch.id', phone: '-' }
    },
    6: {
        name: 'Dewi Lestari',
        position: 'Staf Tata Usaha',
        education: 'SMK Administrasi Perkantoran',
        experience: '7 Tahun',
        bio: 'Mengelola administrasi sekolah dengan profesional, teliti, dan ramah dalam melayani.',
        achievements: ['Pelatihan Administrasi Sekolah Tingkat Provinsi', 'Sertifikasi Komputer Perkantoran', 'Workshop Pelayanan Prima', 'Pelatihan Sistem Informasi Manajemen Sekolah'],
        contact: { email: 'dewi.lestari@sdn2kepuk.sch.id', phone: '-' }
    },
    7: {
        name: 'Nur Aini, S.Pd',
        position: 'Guru Kelas 3A',
        education: 'S1 PGSD - UNNES',
        experience: '9 Tahun',
        bio: 'Guru kelas yang berdedikasi dalam menciptakan suasana belajar yang aktif, kreatif, dan menyenangkan bagi siswa kelas 3.',
        achievements: ['Guru Teladan Tingkat Kecamatan 2023', 'Pelatihan Kurikulum Merdeka Belajar', 'Sertifikasi Pendidik Profesional', 'Workshop Pembelajaran Berbasis Karakter'],
        contact: { email: 'nur.aini@sdn2kepuk.sch.id', phone: '-' }
    }
};

function resolveCmsImagePath(path) {
    if (!path) return '';
    const normalized = String(path).replace(/\\/g, '/');
    if (normalized.startsWith('http://') || normalized.startsWith('https://')) return normalized;

    const mediaBase = (window.cmsMediaBaseUrl || '').replace(/\/$/, '');
    const storageBase = (window.cmsStorageBaseUrl || '/storage').replace(/\/$/, '');
    if (normalized.startsWith('/storage/settings/')) {
        return mediaBase ? `${mediaBase}/${normalized.replace(/^\/storage\//, '')}` : `${storageBase.replace(/\/storage$/, '')}${normalized}`;
    }
    if (normalized.startsWith('/')) return normalized;
    if (normalized.startsWith('settings/')) return mediaBase ? `${mediaBase}/${normalized}` : `${storageBase}/${normalized}`;
    if (normalized.startsWith('storage/settings/')) return mediaBase ? `${mediaBase}/${normalized.replace(/^storage\//, '')}` : `${storageBase.replace(/\/storage$/, '')}/${normalized}`;
    if (normalized.startsWith('public/settings/')) return mediaBase ? `${mediaBase}/${normalized.replace(/^public\//, '')}` : `${storageBase}/${normalized.replace(/^public\//, '')}`;
    return normalized;
}

function normalizeTeacherData(items) {
    const normalized = {};
    items.forEach((item, idx) => {
        const id = idx + 1;
        const achievementsRaw = item.achievements || '';
        const achievements = Array.isArray(achievementsRaw)
            ? achievementsRaw
            : String(achievementsRaw).split(';').map(s => s.trim()).filter(Boolean);

        normalized[id] = {
            name: item.name || '-',
            position: item.position || '-',
            education: item.education || '-',
            experience: item.experience || '-',
            bio: item.bio || '-',
            achievements: achievements.length ? achievements : ['-'],
            contact: {
                email: item.email || '-',
                phone: item.phone || '-',
            },
            category: item.category || 'guru',
            photo_path: item.photo_path || '',
        };
    });

    return normalized;
}

function renderTeachersFromCms(items) {
    const grid = document.getElementById('teachersGrid');
    if (!grid || !Array.isArray(items) || !items.length) return;

    teacherData = normalizeTeacherData(items);
    grid.innerHTML = items.map((item, idx) => {
        const id = idx + 1;
        const name = item.name || '-';
        const position = item.position || '-';
        const category = item.category || 'guru';
        const image = resolveCmsImagePath(item.photo_path || '');
        const alt = name;

        return `
            <div class="teacher-card teacher-card-item rounded-2xl shadow-lg p-8 reveal" data-category="${category}" data-id="${id}" onclick="openModal(${id})">
                <div class="teacher-photo-wrapper"><div class="teacher-photo">${image ? `<img src="${image}" alt="${alt}" style="width:100%;height:100%;object-fit:cover;object-position:center center;">` : `<span>${name.charAt(0)}</span>`}</div></div>
                <div class="text-center"><h3 class="text-xl font-bold text-gray-900 mb-1">${name}</h3><p class="text-blue-600 font-semibold">${position}</p></div>
            </div>
        `;
    }).join('');
    observeNewRevealElements(grid);

    const filterWrap = document.getElementById('teacherFilterWrap');
    if (filterWrap) {
        const categories = [...new Set(items.map(item => item.category || 'guru'))];
        const categoryLabel = {
            kepala: 'Kepala Sekolah',
            guru: 'Guru Kelas',
            mapel: 'Guru Mapel',
        };

        filterWrap.innerHTML = `<button class="filter-btn active px-6 py-3 bg-white rounded-xl shadow-md font-semibold" onclick="filterTeachers(event,'all')">Semua Tim</button>` +
            categories.map(category => `<button class="filter-btn px-6 py-3 bg-white rounded-xl shadow-md font-semibold" onclick="filterTeachers(event,'${category}')">${categoryLabel[category] || category}</button>`).join('');
    }
}

function openModal(id) {
    const t = teacherData[id];
    if (!t) return;
    document.getElementById('modalName').textContent = t.name;
    document.getElementById('modalContent').innerHTML = `
        <div class="text-center mb-6">
            <h4 class="text-2xl font-bold text-blue-600 mb-2">${t.position}</h4>
            <p class="text-gray-600">${t.education}</p>
        </div>
        <div class="space-y-6">
            <div class="bg-gray-50 rounded-xl p-6">
                <h5 class="font-bold text-gray-900 mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Pengalaman Mengajar
                </h5>
                <p class="text-gray-700">${t.experience} mengajar di bidang pendidikan</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <h5 class="font-bold text-gray-900 mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profil
                </h5>
                <p class="text-gray-700">${t.bio}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <h5 class="font-bold text-gray-900 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    Prestasi & Sertifikasi
                </h5>
                <ul class="space-y-2">
                    ${t.achievements.map(a => `
                        <li class="text-gray-700 flex items-start">
                            <svg class="w-5 h-5 text-emerald-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            ${a}
                        </li>
                    `).join('')}
                </ul>
            </div>
            <div class="bg-blue-50 rounded-xl p-6">
                <h5 class="font-bold text-gray-900 mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Informasi Kontak
                </h5>
                <div class="space-y-2">
                    <p class="text-gray-700"><span class="font-semibold">Email:</span> ${t.contact.email}</p>
                    ${t.contact.phone !== '-' ? `<p class="text-gray-700"><span class="font-semibold">Telepon:</span> ${t.contact.phone}</p>` : ''}
                </div>
            </div>
        </div>
    `;
    document.getElementById('modal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('modal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

function handleModalClick(event) {
    if (event.target.id === 'modal') {
        closeModal();
    }
}

// =====================
// GALLERY DATA & FILTER
// =====================
let galleryData = [
    { img: 'g1.webp', title: 'Pemberian Hadiah Siswa Berprestasi', description: 'Guru memberikan penghargaan kepada siswa berprestasi', category: 'kegiatan' },
    { img: 'g2.webp', title: 'Festival Tunas Bahasa Ibu', description: 'Siswa tampil dalam Festival Tunas Bahasa Ibu Kecamatan Bangsri 2024', category: 'prestasi' },
    { img: 'g3.webp', title: 'Juara Pramuka', description: 'Tim pramuka SDN 2 Kepuk meraih juara', category: 'prestasi' },
    { img: 'g4.webp', title: 'POPDA Kabupaten Jepara', description: 'Siswa SDN 2 Kepuk mengikuti Pekan Olahraga Pelajar Daerah', category: 'prestasi' },
    { img: 'g5.webp', title: 'Medali Olahraga', description: 'Siswa meraih medali dalam kompetisi olahraga', category: 'prestasi' },
    { img: 'g6.webp', title: 'POPDA Kabupaten Jepara 2023', description: 'Prestasi olahraga di POPDA Kabupaten Jepara 2023', category: 'prestasi' },
    { img: 'g7.webp', title: 'Olimpiade Sains Nasional 2024', description: 'Siswa SDN 2 Kepuk meraih prestasi di OSN 2024', category: 'prestasi' },
    { img: 'g8.webp', title: 'Program Vaksinasi Siswa', description: 'Vaksinasi COVID-19 untuk siswa SDN 2 Kepuk', category: 'kegiatan' },
    { img: 'g9.webp', title: 'Penampilan Tari Tradisional', description: 'Siswa tampil dalam lomba tari tradisional', category: 'kegiatan' },
    { img: 'g10.webp', title: 'Latihan Baris Berbaris', description: 'Latihan baris berbaris bersama TNI', category: 'kegiatan' },
    { img: 'g11.webp', title: 'Vaksinasi Siswa', description: 'Program kesehatan vaksinasi untuk siswa', category: 'kegiatan' },
    { img: 'g12.webp', title: 'Outing Class Saloka', description: 'Kegiatan outing class SDN 2 Kepuk di Saloka Theme Park', category: 'kegiatan' },
    { img: 'g13.webp', title: 'Gelar Karya P5 & Pelepasan Kelas 6', description: 'Acara Gelar Karya P5 dan pelepasan siswa kelas 6 SDN 2 Kepuk', category: 'kegiatan' },
    { img: 'g14.webp', title: 'Sholat Berjamaah', description: 'Pembiasaan sholat berjamaah di kelas', category: 'pembelajaran' }
];

function renderGalleryFromCms(items) {
    const grid = document.getElementById('galleryGrid');
    if (!grid || !Array.isArray(items) || !items.length) return;

    galleryData = items.map((item) => ({
        img: resolveCmsImagePath(item.image_path || ''),
        title: item.title || '-',
        description: item.description || '-',
        category: item.category || 'kegiatan',
    }));

    grid.innerHTML = galleryData.map((item, index) => {
        return `<div class="gallery-item-sm reveal" data-category="${item.category}" onclick="openLightbox(${index})"><img src="${item.img}" alt="${item.title}"></div>`;
    }).join('');
    observeNewRevealElements(grid);

    const categoryWrap = document.querySelector('#galeri .flex.flex-wrap.justify-center.gap-2');
    if (categoryWrap) {
        const categories = [...new Set(galleryData.map(item => item.category))];
        categoryWrap.innerHTML = `<button onclick="filterGallery(event,'all')" class="gallery-category-btn active px-4 py-1.5 text-sm rounded-full border border-gray-300 bg-white">Semua</button>` +
            categories.map(category => `<button onclick="filterGallery(event,'${category}')" class="gallery-category-btn px-4 py-1.5 text-sm rounded-full border border-gray-300 bg-white">${category}</button>`).join('');
    }

    // Keep initial gallery state collapsed even after CMS data re-renders the grid.
    applyGalleryLimit();
}

let currentImageIndex = 0;

// =====================
// GALLERY SHOW MORE
// =====================
const GALLERY_INITIAL_LIMIT = 4;
let currentGalleryCategory = 'all';
let isGalleryExpanded = false;

function applyGalleryLimit() {
    const allItems = document.querySelectorAll('.gallery-item-sm');
    const toggleWrap = document.getElementById('galleryToggleWrap');
    const toggleButton = document.getElementById('galleryToggleButton');
    let visibleIndex = 0;
    let matchingCount = 0;

    allItems.forEach(item => {
        const matchesFilter = currentGalleryCategory === 'all' || item.dataset.category === currentGalleryCategory;
        if (matchesFilter) {
            matchingCount++;
            const shouldShow = isGalleryExpanded || visibleIndex < GALLERY_INITIAL_LIMIT;
            visibleIndex++;

            if (!shouldShow) {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 200);
                return;
            }

            item.style.display = 'block';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        } else {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            setTimeout(() => { item.style.display = 'none'; }, 200);
        }
    });

    if (toggleWrap && toggleButton) {
        const hiddenCount = Math.max(matchingCount - GALLERY_INITIAL_LIMIT, 0);

        if (matchingCount > GALLERY_INITIAL_LIMIT) {
            toggleWrap.classList.remove('hidden');

            if (isGalleryExpanded) {
                toggleButton.textContent = 'Sembunyikan';
            } else {
                toggleButton.textContent = `Lihat Selengkapnya (${hiddenCount} foto lainnya)`;
            }
        } else {
            toggleWrap.classList.add('hidden');
        }
    }
}

function toggleGallery() {
    isGalleryExpanded = !isGalleryExpanded;
    applyGalleryLimit();
}

function filterGallery(event, category) {
    currentGalleryCategory = category;
    isGalleryExpanded = false;
    const btns = document.querySelectorAll('.gallery-category-btn');

    btns.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    applyGalleryLimit();
}

// =====================
// LIGHTBOX
// =====================
function openLightbox(index) {
    currentImageIndex = index;
    const data = galleryData[index];
    document.getElementById('lightboxImage').src = data.img;
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = 'auto';
}

function changeImage(direction) {
    currentImageIndex += direction;
    if (currentImageIndex < 0) {
        currentImageIndex = galleryData.length - 1;
    } else if (currentImageIndex >= galleryData.length) {
        currentImageIndex = 0;
    }
    const data = galleryData[currentImageIndex];
    document.getElementById('lightboxImage').src = data.img;
}

function handleLightboxClick(event) {
    if (event.target.id === 'lightbox') {
        closeLightbox();
    }
}

// Keyboard navigation for lightbox
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (lightbox.classList.contains('active')) {
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            changeImage(-1);
        } else if (e.key === 'ArrowRight') {
            changeImage(1);
        }
    }
});
// =====================
// BERITA MODAL
// =====================
let beritaData = [
    {
        img: 'b1.jpg',
        tag: 'Prestasi',
        tagClass: 'text-blue-600 bg-blue-100',
        date: 'Februari 2024',
        title: 'Imam Hadi Nugroho Raih Juara 2 Olimpiade Sains Nasional 2024',
        body: `
            <p>Kebanggaan kembali hadir untuk SD Negeri 2 Kepuk. Imam Hadi Nugroho, salah satu siswa berprestasi SDN 2 Kepuk, berhasil meraih <strong>Juara 2</strong> dalam ajang bergengsi <strong>Olimpiade Sains Nasional (OSN) 2024</strong> yang diselenggarakan di SDN 1 Wedelan, Kecamatan Bangsri, Jepara pada Februari 2024.</p>
            <p>Olimpiade Sains Nasional merupakan kompetisi tahunan yang diikuti oleh siswa-siswi terbaik dari berbagai sekolah dasar se-Kecamatan Bangsri. Kompetisi ini menguji kemampuan sains siswa secara menyeluruh, mulai dari ilmu pengetahuan alam, logika berpikir, hingga kemampuan analisis dan pemecahan masalah.</p>
            <p>Imam Hadi Nugroho tampil luar biasa di antara puluhan peserta dari berbagai sekolah. Dengan persiapan yang matang dan bimbingan intensif dari guru-guru SDN 2 Kepuk, ia berhasil mempersembahkan medali perak yang membanggakan bagi sekolah dan seluruh keluarganya.</p>
            <p>Kepala SD Negeri 2 Kepuk menyampaikan apresiasi yang sebesar-besarnya kepada Imam Hadi Nugroho beserta orang tua dan guru pembimbingnya. Prestasi ini menjadi bukti nyata bahwa SDN 2 Kepuk terus berkomitmen dalam melahirkan generasi penerus yang cerdas, berprestasi, dan berkarakter.</p>
            <p>Semoga prestasi Imam Hadi Nugroho menjadi inspirasi bagi seluruh siswa SDN 2 Kepuk untuk terus belajar dengan giat dan meraih cita-cita setinggi-tingginya.</p>
        `
    },
    {
        img: 'b2.jpg',
        tag: 'Prestasi',
        tagClass: 'text-blue-600 bg-blue-100',
        date: 'Oktober 2023',
        title: 'SDN 2 Kepuk Raih Medali Perak di POPDA Kabupaten Jepara 2023',
        body: `
            <p>Membanggakan! Atlet-atlet muda SD Negeri 2 Kepuk berhasil menorehkan prestasi gemilang dalam ajang <strong>Pekan Olahraga Pelajar Daerah (POPDA) Kabupaten Jepara Tahun 2023</strong> yang berlangsung pada September hingga 11 Oktober 2023. SDN 2 Kepuk berhasil meraih <strong>Juara 2 (Medali Perak)</strong> dan membawa nama baik sekolah di tingkat kabupaten.</p>
            <p>POPDA Kabupaten Jepara 2023 diikuti oleh ratusan atlet pelajar dari berbagai sekolah dasar dan menengah se-Kabupaten Jepara. Kompetisi ini menjadi wadah pembinaan olahraga pelajar sekaligus ajang seleksi atlet potensial daerah.</p>
            <p>Para atlet SDN 2 Kepuk tampil dengan penuh semangat dan sportivitas tinggi. Didampingi langsung oleh guru pembina olahraga, mereka menunjukkan performa terbaik sepanjang pertandingan hingga berhasil naik ke podium juara dan meraih medali perak yang membanggakan.</p>
            <p>Kepala SD Negeri 2 Kepuk menyampaikan rasa bangga dan apresiasi kepada seluruh atlet beserta guru pembina yang telah berjuang dengan sepenuh hati. Prestasi ini diharapkan menjadi motivasi bagi seluruh siswa untuk terus mengembangkan bakat di bidang olahraga.</p>
            <p>SDN 2 Kepuk berkomitmen untuk terus mendukung pengembangan potensi siswa tidak hanya di bidang akademik, tetapi juga di bidang olahraga demi mencetak generasi yang sehat, berprestasi, dan berkarakter.</p>
        `
    },
    {
        img: 'b3.jpg',
        tag: 'Pramuka',
        tagClass: 'text-blue-600 bg-blue-100',
        date: '2024',
        title: 'SDN 2 Kepuk Raih Juara 3 Lomba Pesta Siaga Kecamatan Bangsri',
        body: `
            <p>Kontingen Siaga SD Negeri 2 Kepuk berhasil mengharumkan nama sekolah dengan meraih <strong>Juara 3</strong> dalam <strong>Lomba Pesta Siaga</strong> tingkat Kecamatan Bangsri. Keberhasilan ini merupakan buah dari latihan keras dan kekompakan seluruh anggota regu yang dibimbing oleh para pembina pramuka sekolah.</p>
            <p>Pesta Siaga merupakan ajang kompetisi kepramukaan yang diperuntukkan bagi anggota Siaga (kelas 3–5 SD) dari berbagai sekolah dasar se-Kecamatan Bangsri. Lomba ini mencakup berbagai mata lomba seperti baris-berbaris, hasta karya, sandi pramuka, yel-yel, dan ketangkasan siaga yang menguji kekompakan serta pengetahuan kepramukaan para peserta.</p>
            <p>Kontingen SDN 2 Kepuk yang terdiri dari siswi-siswi bersemangat tampil percaya diri dan kompak di setiap babak perlombaan. Dengan seragam pramuka yang rapi dan semangat yang membara, mereka berhasil bersaing ketat dengan kontingen dari sekolah-sekolah lain dan akhirnya naik podium membawa trofi Juara 3.</p>
            <p>Kepala SD Negeri 2 Kepuk menyampaikan kebanggaan dan apresiasi setinggi-tingginya kepada seluruh anggota kontingen beserta para pembina pramuka yang telah mendampingi dengan penuh dedikasi. Prestasi ini membuktikan bahwa kegiatan ekstrakurikuler pramuka di SDN 2 Kepuk berjalan dengan baik dan mampu melahirkan generasi yang disiplin, mandiri, dan berkarakter.</p>
            <p>Semoga pencapaian ini menjadi batu loncatan untuk meraih prestasi yang lebih tinggi di lomba-lomba kepramukaan berikutnya, dan menginspirasi seluruh siswa SDN 2 Kepuk untuk aktif dalam kegiatan pramuka.</p>
        `
    },
    {
        img: 'b4.jpg',
        tag: 'Seni & Budaya',
        tagClass: 'text-blue-600 bg-blue-100',
        date: 'September 2024',
        title: 'SDN 2 Kepuk Raih Juara Harapan 1 Festival Tunas Bahasa Ibu Kecamatan Bangsri',
        body: `
            <p>Prestasi membanggakan kembali diraih oleh SD Negeri 2 Kepuk. Salah satu siswa terbaik SDN 2 Kepuk berhasil meraih <strong>Juara Harapan 1</strong> dalam ajang <strong>Festival Tunas Bahasa Ibu (FTBI)</strong> yang diselenggarakan oleh Saedikcam Bangsri bertempat di SDN Krasak Kampus Bangsri pada <strong>5 September 2024</strong>.</p>
            <p>Festival Tunas Bahasa Ibu merupakan kegiatan apresiasi peserta didik dalam rangka melestarikan dan mengembangkan kemampuan berbahasa daerah, khususnya Bahasa Jawa. Ajang ini diikuti oleh siswa-siswi perwakilan dari sekolah dasar se-Kecamatan Bangsri dengan berbagai cabang lomba seperti geguritan, macapat, pidato Bahasa Jawa, dan bercerita menggunakan bahasa daerah.</p>
            <p>Siswa SDN 2 Kepuk tampil percaya diri di hadapan dewan juri dengan mengenakan pakaian adat Jawa yang anggun. Penampilan yang ekspresif, pelafalan yang jelas, serta penghayatan yang mendalam membuat penampilannya mendapat sambutan antusias dari seluruh hadirin yang menyaksikan.</p>
            <p>Kepala SD Negeri 2 Kepuk menyampaikan apresiasi dan kebanggaan atas pencapaian tersebut. Beliau menegaskan bahwa kegiatan seperti FTBI sangat penting untuk menumbuhkan rasa cinta siswa terhadap bahasa dan budaya leluhur, sekaligus mengasah keberanian tampil di depan umum.</p>
            <p>Prestasi di FTBI ini semakin mempertegas komitmen SDN 2 Kepuk dalam membina siswa secara menyeluruh, tidak hanya unggul di bidang akademik, tetapi juga dalam pelestarian seni dan budaya lokal yang menjadi identitas bangsa.</p>
        `
    }
];

let prestasiData = [
    {
        img: 'b1.jpg',
        level: 'Akademik',
        tagClass: 'text-blue-600 bg-blue-100',
        date: 'Februari 2024',
        title: 'Juara 2 Olimpiade Sains Nasional Tingkat Kecamatan',
        summary: 'Siswa SDN 2 Kepuk meraih medali perak pada ajang OSN tingkat kecamatan.',
        body: 'Siswa SDN 2 Kepuk meraih medali perak pada ajang OSN tingkat kecamatan.'
    },
    {
        img: 'b3.jpg',
        level: 'Pramuka',
        tagClass: 'text-blue-600 bg-blue-100',
        date: 'Maret 2024',
        title: 'Juara 3 Pesta Siaga Kecamatan Bangsri',
        summary: 'Kontingen siaga tampil kompak dan berhasil membawa pulang juara 3.',
        body: 'Kontingen siaga tampil kompak dan berhasil membawa pulang juara 3.'
    },
    {
        img: 'b4.jpg',
        level: 'Seni Budaya',
        tagClass: 'text-blue-600 bg-blue-100',
        date: 'September 2024',
        title: 'Juara Harapan 1 Festival Tunas Bahasa Ibu',
        summary: 'Siswa SDN 2 Kepuk menunjukkan performa terbaik pada ajang FTBI.',
        body: 'Siswa SDN 2 Kepuk menunjukkan performa terbaik pada ajang FTBI.'
    }
];

function renderNewsFromCms(items) {
    const track = document.getElementById('beritaTrack');
    if (!track || !Array.isArray(items) || !items.length) return;

    beritaData = items.map((item) => ({
        img: resolveCmsImagePath(item.image_path || ''),
        tag: item.tag || 'Berita',
        tagClass: 'text-blue-600 bg-blue-100',
        date: item.date || '-',
        title: item.title || '-',
        body: item.body || item.summary || '-',
        summary: item.summary || '-',
    }));

    track.innerHTML = beritaData.map((item, index) => `
        <article class="bg-white rounded-xl shadow-sm border overflow-hidden card-hover flex flex-col cursor-pointer flex-shrink-0" style="width: calc((100% - 3*1.25rem) / 4)" onclick="openBerita(${index})">
            <img src="${item.img}" alt="${item.title}" class="w-full h-56 object-cover">
            <div class="p-4 flex flex-col flex-1">
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">${item.tag}</span>
                    <span class="text-xs text-gray-400">${item.date}</span>
                </div>
                <h4 class="text-sm font-bold text-gray-900 mb-1.5 leading-snug line-clamp-2">${item.title}</h4>
                <p class="text-xs text-gray-500 leading-relaxed flex-1 line-clamp-2">${item.summary}</p>
                <button onclick="event.stopPropagation();openBerita(${index})" class="text-xs text-blue-600 font-semibold mt-2 inline-flex items-center hover:text-blue-800 transition">Baca Selengkapnya <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
            </div>
        </article>
    `).join('');

    const dotsWrap = document.querySelector('#berita .flex.justify-center.gap-2.mt-6');
    if (dotsWrap) {
        dotsWrap.innerHTML = beritaData.map((_, index) => `<button class="berita-dot w-3 h-3 rounded-full ${index === 0 ? 'bg-blue-600' : 'bg-gray-300'} transition-all" onclick="goToBeritaSlide(${index})"></button>`).join('');
    }
}

function openBerita(index) {
    const b = beritaData[index];
    document.getElementById('beritaModalImgSrc').src = b.img;
    const tag = document.getElementById('beritaModalTag');
    tag.textContent = b.tag;
    tag.className = 'text-xs font-semibold px-2 py-0.5 rounded-full ' + b.tagClass;
    document.getElementById('beritaModalDate').textContent = b.date;
    document.getElementById('beritaModalTitle').textContent = b.title;
    document.getElementById('beritaModalBody').innerHTML = b.body;
    document.getElementById('beritaModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeBerita() {
    document.getElementById('beritaModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

function handleBeritaModalClick(event) {
    if (event.target.id === 'beritaModal') closeBerita();
}

function renderPrestasiFromCms(items) {
    const track = document.getElementById('prestasiTrack');
    if (!track || !Array.isArray(items) || !items.length) return;

    prestasiData = items.map((item) => ({
        img: resolveCmsImagePath(item.image_path || ''),
        level: item.level || 'Prestasi',
        tagClass: 'text-blue-600 bg-blue-100',
        date: item.date || '-',
        title: item.title || '-',
        summary: item.description || '-',
        body: item.description || '-',
    }));

    track.innerHTML = prestasiData.map((item, index) => `
        <article class="bg-white rounded-xl shadow-sm border overflow-hidden card-hover flex flex-col cursor-pointer shrink-0" style="width: calc((100% - 3*1.25rem) / 4)" onclick="openPrestasi(${index})">
            <img src="${item.img}" alt="${item.title}" class="w-full h-56 object-cover">
            <div class="p-4 flex flex-col flex-1">
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">${item.level}</span>
                    <span class="text-xs text-gray-400">${item.date}</span>
                </div>
                <h4 class="text-sm font-bold text-gray-900 mb-1.5 leading-snug line-clamp-2">${item.title}</h4>
                <p class="text-xs text-gray-500 leading-relaxed flex-1 line-clamp-2">${item.summary}</p>
                <button onclick="event.stopPropagation();openPrestasi(${index})" class="text-xs text-blue-600 font-semibold mt-2 inline-flex items-center hover:text-blue-800 transition">Baca Selengkapnya <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
            </div>
        </article>
    `).join('');

    const dotsWrap = document.getElementById('prestasiDots');
    if (dotsWrap) {
        dotsWrap.innerHTML = prestasiData.map((_, index) => `<button class="prestasi-dot w-3 h-3 rounded-full ${index === 0 ? 'bg-blue-600' : 'bg-gray-300'} transition-all" onclick="goToPrestasiSlide(${index})"></button>`).join('');
    }

    currentPrestasiSlide = 0;
    updatePrestasiSlider();
}

function openPrestasi(index) {
    const p = prestasiData[index];
    if (!p) return;

    document.getElementById('prestasiModalImgSrc').src = p.img;
    const tag = document.getElementById('prestasiModalTag');
    tag.textContent = p.level;
    tag.className = 'text-xs font-semibold px-2 py-0.5 rounded-full ' + p.tagClass;
    document.getElementById('prestasiModalDate').textContent = p.date;
    document.getElementById('prestasiModalTitle').textContent = p.title;
    document.getElementById('prestasiModalBody').innerHTML = `<p>${p.body}</p>`;
    document.getElementById('prestasiModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closePrestasi() {
    document.getElementById('prestasiModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

function handlePrestasiModalClick(event) {
    if (event.target.id === 'prestasiModal') closePrestasi();
}

// =====================
// TICKER BERITA
// =====================
const tickerItems = [
    'Selamat! Ahmad Rizki Juara 1 Olimpiade Matematika Tingkat Kabupaten',
    'PAT Kelas 1-5 dilaksanakan 20-27 Mei 2026',
    'Pentas Seni Akhir Tahun pada 28 Juni 2026 di Halaman Sekolah',
    'Rapat Orang Tua/Wali Murid: Sabtu 15 Maret 2026 pukul 08.00 WIB'
];
let tickerIndex = 0;
function rotateTicker() {
    const el = document.getElementById('tickerText');
    if (!el) return;
    el.style.opacity = '0';
    setTimeout(() => {
        tickerIndex = (tickerIndex + 1) % tickerItems.length;
        el.textContent = tickerItems[tickerIndex];
        el.style.opacity = '1';
    }, 500);
}
window.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('tickerText');
    if (el) {
        el.textContent = tickerItems[0];
        el.style.transition = 'opacity 0.5s';
        setInterval(rotateTicker, 5000);
    }
});
// Init gallery 2-row limit on load
window.addEventListener('DOMContentLoaded', function() {
    applyGalleryLimit();
});
// =====================
// BERITA SLIDER
// =====================
let currentBeritaSlide = 0;

function getBeritaVisibleCount() {
    if (window.innerWidth < 768) return 1;
    if (window.innerWidth < 1024) return 2;
    return 3;
}

function updateBeritaSlider() {
    const track = document.getElementById('beritaTrack');
    const dots = document.querySelectorAll('.berita-dot');
    const cards = track.querySelectorAll('article');
    const visibleCount = getBeritaVisibleCount();
    const maxSlide = cards.length - visibleCount;

    if (currentBeritaSlide > maxSlide) currentBeritaSlide = maxSlide;
    if (currentBeritaSlide < 0) currentBeritaSlide = 0;

    // Hitung lebar card + gap
    const gap = 20;
    const trackWidth = track.parentElement.offsetWidth;
    const cardWidth = (trackWidth - gap * (visibleCount - 1)) / visibleCount;
    const offset = currentBeritaSlide * (cardWidth + gap);

    track.style.transform = `translateX(-${offset}px)`;

    // Update card widths
    cards.forEach(card => {
        card.style.width = cardWidth + 'px';
    });

    // Update dots
    dots.forEach((dot, i) => {
        dot.style.backgroundColor = i === currentBeritaSlide ? '#2563eb' : '#d1d5db';
        dot.style.width = i === currentBeritaSlide ? '2rem' : '0.75rem';
        dot.style.borderRadius = i === currentBeritaSlide ? '6px' : '9999px';
    });
}

function nextBeritaSlide() {
    const track = document.getElementById('beritaTrack');
    const cards = track.querySelectorAll('article');
    const maxSlide = cards.length - getBeritaVisibleCount();
    currentBeritaSlide = currentBeritaSlide >= maxSlide ? 0 : currentBeritaSlide + 1;
    updateBeritaSlider();
}

function prevBeritaSlide() {
    const track = document.getElementById('beritaTrack');
    const cards = track.querySelectorAll('article');
    const maxSlide = cards.length - getBeritaVisibleCount();
    currentBeritaSlide = currentBeritaSlide <= 0 ? maxSlide : currentBeritaSlide - 1;
    updateBeritaSlider();
}

function goToBeritaSlide(index) {
    currentBeritaSlide = index;
    updateBeritaSlider();
}

let currentPrestasiSlide = 0;

function getPrestasiVisibleCount() {
    if (window.innerWidth < 768) return 1;
    if (window.innerWidth < 1024) return 2;
    return 3;
}

function updatePrestasiSlider() {
    const track = document.getElementById('prestasiTrack');
    if (!track) return;

    const dots = document.querySelectorAll('.prestasi-dot');
    const cards = track.querySelectorAll('article');
    if (!cards.length) return;

    const visibleCount = getPrestasiVisibleCount();
    const maxSlide = Math.max(cards.length - visibleCount, 0);

    if (currentPrestasiSlide > maxSlide) currentPrestasiSlide = maxSlide;
    if (currentPrestasiSlide < 0) currentPrestasiSlide = 0;

    const gap = 20;
    const trackWidth = track.parentElement.offsetWidth;
    const cardWidth = (trackWidth - gap * (visibleCount - 1)) / visibleCount;
    const offset = currentPrestasiSlide * (cardWidth + gap);

    track.style.transform = `translateX(-${offset}px)`;

    cards.forEach(card => {
        card.style.width = cardWidth + 'px';
    });

    dots.forEach((dot, i) => {
        dot.style.backgroundColor = i === currentPrestasiSlide ? '#2563eb' : '#d1d5db';
        dot.style.width = i === currentPrestasiSlide ? '2rem' : '0.75rem';
        dot.style.borderRadius = i === currentPrestasiSlide ? '6px' : '9999px';
    });
}

function nextPrestasiSlide() {
    const track = document.getElementById('prestasiTrack');
    if (!track) return;

    const cards = track.querySelectorAll('article');
    const maxSlide = Math.max(cards.length - getPrestasiVisibleCount(), 0);
    currentPrestasiSlide = currentPrestasiSlide >= maxSlide ? 0 : currentPrestasiSlide + 1;
    updatePrestasiSlider();
}

function prevPrestasiSlide() {
    const track = document.getElementById('prestasiTrack');
    if (!track) return;

    const cards = track.querySelectorAll('article');
    const maxSlide = Math.max(cards.length - getPrestasiVisibleCount(), 0);
    currentPrestasiSlide = currentPrestasiSlide <= 0 ? maxSlide : currentPrestasiSlide - 1;
    updatePrestasiSlider();
}

function goToPrestasiSlide(index) {
    currentPrestasiSlide = index;
    updatePrestasiSlider();
}

window.addEventListener('DOMContentLoaded', function() {
    if (Array.isArray(window.cmsTeachersData) && window.cmsTeachersData.length) {
        renderTeachersFromCms(window.cmsTeachersData);
    }

    if (Array.isArray(window.cmsGalleryData) && window.cmsGalleryData.length) {
        renderGalleryFromCms(window.cmsGalleryData);
    }

    if (Array.isArray(window.cmsNewsData) && window.cmsNewsData.length) {
        renderNewsFromCms(window.cmsNewsData);
    }

    if (Array.isArray(window.cmsAchievementsData) && window.cmsAchievementsData.length) {
        renderPrestasiFromCms(window.cmsAchievementsData);
    }

    updateBeritaSlider();
    updatePrestasiSlider();
});
window.addEventListener('resize', function() {
    updateBeritaSlider();
    updatePrestasiSlider();
});
