<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin CMS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --brand-500: #0f9f87;
            --brand-700: #0b6a5a;
            --ink-900: #1e293b;
            --ink-700: #475569;
            --line: #e5e7eb;
            --surface: #ffffff;
            --surface-soft: #f8fafc;
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
            width: 250px;
            background: linear-gradient(165deg, #0f172a 0%, #1e3a5f 60%, #0f9f87 130%);
            border-right: 0;
            color: #dbeafe;
            padding: 1rem;
            z-index: 1020;
            transition: transform .3s ease;
        }

        .admin-brand {
            border: 1px solid rgba(255, 255, 255, .2);
            background: rgba(255, 255, 255, .08);
            border-radius: .75rem;
            padding: .8rem .9rem;
            margin-bottom: 1rem;
        }

        .admin-brand p {
            margin: 0;
            font-size: .82rem;
            color: #cbd5e1;
        }

        .admin-brand h6 {
            margin: .15rem 0 0;
            font-weight: 700;
            color: #ffffff;
        }

        .side-link {
            display: flex;
            align-items: center;
            gap: .7rem;
            color: #dbeafe;
            text-decoration: none;
            padding: .62rem .75rem;
            border-radius: .6rem;
            margin-bottom: .35rem;
            transition: .2s ease;
            border: 1px solid rgba(255, 255, 255, .06);
        }

        .side-link:hover,
        .side-link.active {
            background: rgba(255, 255, 255, .14);
            color: #ffffff;
            border-color: rgba(255, 255, 255, .22);
        }

        .admin-main {
            margin-left: 250px;
            padding: 1rem 1.2rem 1.5rem;
        }

        .topbar {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: .75rem;
            padding: .75rem .9rem;
            margin-bottom: .9rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .04);
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
                <p>Content Management</p>
                <h6>SDN 2 Kepuk</h6>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="side-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}"
                class="side-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Manajemen User
            </a>
            <a href="{{ route('admin.settings.edit') }}"
                class="side-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="bi bi-sliders2"></i> Konten Website
            </a>
            <a href="{{ route('admin.home-content.edit') }}"
                class="side-link {{ request()->routeIs('admin.home-content.*') ? 'active' : '' }}">
                <i class="bi bi-collection"></i> CMS Homepage
            </a>

            <form action="{{ route('admin.logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn w-100 rounded-3 text-white"
                    style="background: rgba(239,68,68,.85); border: 0;">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </aside>

        <main class="admin-main">
            <div class="topbar d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-0 fw-bold">@yield('page_title', 'Admin Panel')</h5>
                    <small class="text-secondary">Pilih menu di kiri, lalu edit dan simpan.</small>
                </div>
                <button class="btn btn-light d-lg-none" type="button" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
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
