<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $schoolLogo = \App\Helpers\SettingHelper::get('logo_image');
        $schoolFavicon = $schoolLogo ? asset('storage/' . $schoolLogo) : asset('images/logo-sdn2-kepuk.jpeg');
    @endphp
    <title>@yield('title', 'Admin CMS')</title>
    <link rel="icon" type="image/jpeg" href="{{ $schoolFavicon }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ $schoolFavicon }}">
    <link rel="apple-touch-icon" href="{{ $schoolFavicon }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --brand-500: #2563eb;
            --brand-700: #1d4ed8;
            --ink-900: #0f172a;
            --ink-700: #334155;
            --line: #e2e8f0;
            --surface: #ffffff;
            --surface-soft: #f1f5f9;
            --sidebar-1: #0b1f53;
            --sidebar-2: #1e3a8a;
            --sidebar-3: #1d4ed8;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--surface-soft);
            color: var(--ink-900);
        }

        .admin-shell {
            min-height: 100vh;
        }

        .admin-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 280px;
            background: linear-gradient(180deg, var(--sidebar-2) 0%, var(--sidebar-1) 60%, var(--sidebar-3) 100%);
            border-right: 1px solid rgba(255, 255, 255, .08);
            color: #dbeafe;
            padding: 1.1rem .95rem 1rem;
            z-index: 1020;
            transition: transform .3s ease;
            display: flex;
            flex-direction: column;
        }

        .admin-brand {
            border: 1px solid rgba(255, 255, 255, .16);
            background: rgba(255, 255, 255, .08);
            border-radius: .95rem;
            padding: .9rem;
            margin-bottom: 1.1rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .admin-brand p {
            margin: 0;
            font-size: .8rem;
            color: #bfdbfe;
        }

        .admin-brand h6 {
            margin: .15rem 0 0;
            font-weight: 800;
            color: #ffffff;
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            border-radius: .8rem;
            background: linear-gradient(135deg, #60a5fa, #2563eb);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .menu-group-title {
            margin: 1.05rem .55rem .55rem;
            font-size: .74rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(191, 219, 254, .72);
            font-weight: 700;
        }

        .sidebar-scroll {
            flex: 1;
            overflow-y: auto;
            margin-right: -.35rem;
            padding-right: .35rem;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .2);
            border-radius: 20px;
        }

        .side-link {
            display: flex;
            align-items: center;
            gap: .7rem;
            color: #dbeafe;
            text-decoration: none;
            padding: .68rem .78rem;
            border-radius: .72rem;
            margin-bottom: .35rem;
            transition: .2s ease;
            border: 1px solid rgba(255, 255, 255, .05);
            font-weight: 600;
        }

        .side-link:hover,
        .side-link.active {
            background: rgba(96, 165, 250, .22);
            color: #ffffff;
            border-color: rgba(147, 197, 253, .48);
        }

        .side-link i {
            font-size: 1.02rem;
        }

        .admin-account {
            margin-top: .9rem;
            border-top: 1px solid rgba(255, 255, 255, .14);
            padding-top: .85rem;
        }

        .account-box {
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: .9rem;
            padding: .7rem;
        }

        .account-row {
            display: flex;
            align-items: center;
            gap: .65rem;
            margin-bottom: .65rem;
        }

        .account-avatar {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            background: linear-gradient(135deg, #93c5fd, #2563eb);
            color: #eff6ff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .account-meta h6 {
            margin: 0;
            color: #ffffff;
            font-weight: 700;
            font-size: .95rem;
        }

        .account-meta p {
            margin: 0;
            color: #bfdbfe;
            font-size: .8rem;
        }

        .btn-logout {
            width: 100%;
            border-radius: .7rem;
            border: 1px solid rgba(255, 255, 255, .2);
            background: rgba(255, 255, 255, .08);
            color: #e8fff8;
            font-weight: 600;
            padding: .55rem .7rem;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, .16);
            color: #ffffff;
        }

        .admin-main {
            margin-left: 280px;
            padding: 1rem 1.25rem 1.65rem;
        }

        .topbar {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: .9rem;
            padding: .75rem .95rem;
            margin-bottom: 1rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .04);
        }

        .topbar-title {
            display: flex;
            align-items: center;
            gap: .65rem;
        }

        .topbar-menu {
            width: 36px;
            height: 36px;
            border-radius: .65rem;
            border: 1px solid var(--line);
            background: #f8fafc;
            color: #475569;
        }

        .btn-site {
            border-radius: .7rem;
            border: 1px solid rgba(37, 99, 235, .5);
            color: var(--brand-700);
            font-weight: 700;
            background: #eff6ff;
        }

        .btn-site:hover {
            background: #dbeafe;
            color: #1e40af;
        }

        .topbar-avatar {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--brand-500), var(--brand-700));
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            margin-left: .4rem;
        }

        .side-sublink-wrap {
            margin: .25rem 0 .65rem .4rem;
            border-left: 1px dashed rgba(191, 219, 254, .35);
            padding-left: .55rem;
        }

        .side-sublink {
            display: flex;
            align-items: center;
            gap: .5rem;
            color: #c6ddff;
            text-decoration: none;
            padding: .42rem .55rem;
            border-radius: .55rem;
            margin-bottom: .2rem;
            font-size: .84rem;
            font-weight: 600;
            border: 1px solid transparent;
            transition: .16s ease;
        }

        .side-sublink:hover,
        .side-sublink.active {
            color: #ffffff;
            border-color: rgba(147, 197, 253, .38);
            background: rgba(96, 165, 250, .18);
        }

        .content-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: .75rem;
            box-shadow: 0 10px 28px rgba(15, 23, 42, .04);
        }

        .btn-brand {
            background: var(--brand-500);
            border: none;
            color: #fff;
        }

        .btn-brand:hover {
            color: #fff;
            background: var(--brand-700);
        }

        .admin-toast {
            position: fixed;
            right: 1rem;
            top: 1rem;
            z-index: 1080;
            min-width: 280px;
            max-width: 360px;
            border-radius: .85rem;
            border: 1px solid var(--line);
            box-shadow: 0 16px 32px rgba(15, 23, 42, .14);
            overflow: hidden;
            transform: translateY(-16px);
            opacity: 0;
            pointer-events: none;
            transition: .25s ease;
            background: #fff;
        }

        .admin-toast.show {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .admin-toast-head {
            padding: .7rem .9rem;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, var(--brand-500), var(--brand-700));
        }

        .admin-toast-body {
            padding: .8rem .9rem;
            color: var(--ink-700);
        }

        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
                width: min(88vw, 300px);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="admin-shell">
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-brand">
                <span class="brand-logo"><i class="bi bi-buildings"></i></span>
                <div>
                    <h6>SDN 2 Kepuk</h6>
                    <p>Admin CMS</p>
                </div>
            </div>

            <div class="sidebar-scroll">
                <a href="{{ route('admin.dashboard') }}"
                    class="side-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <div class="menu-group-title">Konten</div>
                @php $activeContentTab = request('tab', 'sambutan'); @endphp
                <a href="{{ route('admin.home-content.edit') }}"
                    class="side-link {{ request()->routeIs('admin.home-content.*') ? 'active' : '' }}">
                    <i class="bi bi-collection"></i> Kelola Konten
                </a>
                <div class="side-sublink-wrap">
                    <a href="{{ route('admin.home-content.edit', ['tab' => 'sambutan']) }}"
                        class="side-sublink {{ request()->routeIs('admin.home-content.*') && $activeContentTab === 'sambutan' ? 'active' : '' }}">
                        <i class="bi bi-chat-quote"></i> Sambutan
                    </a>
                    <a href="{{ route('admin.home-content.edit', ['tab' => 'teachers']) }}"
                        class="side-sublink {{ request()->routeIs('admin.home-content.*') && $activeContentTab === 'teachers' ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i> Guru
                    </a>
                    <a href="{{ route('admin.home-content.edit', ['tab' => 'gallery']) }}"
                        class="side-sublink {{ request()->routeIs('admin.home-content.*') && $activeContentTab === 'gallery' ? 'active' : '' }}">
                        <i class="bi bi-images"></i> Galeri
                    </a>
                    <a href="{{ route('admin.home-content.edit', ['tab' => 'news']) }}"
                        class="side-sublink {{ request()->routeIs('admin.home-content.*') && $activeContentTab === 'news' ? 'active' : '' }}">
                        <i class="bi bi-newspaper"></i> Berita
                    </a>
                    <a href="{{ route('admin.home-content.edit', ['tab' => 'achievements']) }}"
                        class="side-sublink {{ request()->routeIs('admin.home-content.*') && $activeContentTab === 'achievements' ? 'active' : '' }}">
                        <i class="bi bi-trophy"></i> Prestasi
                    </a>
                    <a href="{{ route('admin.home-content.edit', ['tab' => 'ppdb']) }}"
                        class="side-sublink {{ request()->routeIs('admin.home-content.*') && $activeContentTab === 'ppdb' ? 'active' : '' }}">
                        <i class="bi bi-journal-check"></i> PPDB
                    </a>
                    <a href="{{ route('admin.home-content.edit', ['tab' => 'contact']) }}"
                        class="side-sublink {{ request()->routeIs('admin.home-content.*') && $activeContentTab === 'contact' ? 'active' : '' }}">
                        <i class="bi bi-telephone"></i> Kontak
                    </a>
                </div>

                <div class="menu-group-title">Data Sekolah</div>
                <a href="{{ route('admin.settings.edit') }}"
                    class="side-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear-fill"></i> Pengaturan Sekolah
                </a>

                <div class="menu-group-title">Sistem</div>
                <a href="{{ route('admin.users.index') }}"
                    class="side-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Manajemen User
                </a>
            </div>

            <div class="admin-account">
                <div class="account-box">
                    <div class="account-row">
                        <span class="account-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                        <div class="account-meta">
                            <h6>{{ auth()->user()->name ?? 'Admin' }}</h6>
                            <p>Administrator</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-logout">
                            <i class="bi bi-box-arrow-right me-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="admin-main">
            <div class="topbar d-flex align-items-center justify-content-between">
                <div class="topbar-title">
                    <button class="topbar-menu d-lg-none" type="button" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </button>
                    <div>
                        <h5 class="mb-0 fw-bold">@yield('page_title', 'Admin Panel')</h5>
                        <small class="text-secondary"><i class="bi bi-house-door-fill text-primary me-1"></i>Kelola data
                            sekolah dengan lebih detail.</small>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" class="btn btn-site">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Website
                    </a>
                    <span class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                </div>
            </div>
            @yield('content')
        </main>
    </div>

    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-secondary">
                    Tindakan ini tidak bisa dibatalkan. Lanjutkan penghapusan data?
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteAction">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-toast" id="adminToast">
        <div class="admin-toast-head">Sistem</div>
        <div class="admin-toast-body" id="adminToastMessage"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('adminSidebar');
        const toastEl = document.getElementById('adminToast');
        const toastMessageEl = document.getElementById('adminToastMessage');
        const deleteModalEl = document.getElementById('deleteConfirmModal');
        const deleteModal = new bootstrap.Modal(deleteModalEl);
        const confirmDeleteButton = document.getElementById('confirmDeleteAction');
        let pendingDeleteForm = null;

        function toggleSidebar() {
            sidebar.classList.toggle('open');
        }

        function showAdminToast(message) {
            toastMessageEl.textContent = message;
            toastEl.classList.add('show');
            window.setTimeout(() => {
                toastEl.classList.remove('show');
            }, 2600);
        }

        function confirmDelete(formElement) {
            pendingDeleteForm = formElement;
            deleteModal.show();
        }

        confirmDeleteButton.addEventListener('click', () => {
            if (pendingDeleteForm) {
                pendingDeleteForm.submit();
            }
        });

        @if (session('success'))
            showAdminToast(@json(session('success')));
        @endif
    </script>
    @stack('scripts')
</body>

</html>
