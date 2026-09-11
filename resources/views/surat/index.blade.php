<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persuratan Desa</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body class="dashboard-shell role-dashboard role-{{ $user->role }} min-h-screen text-slate-900">
    <header class="public-header">
        <div class="public-container public-nav">
            <a href="{{ route('welcome') }}" class="public-brand" aria-label="Beranda Desa Batujajar Barat">
                <img class="brand-mark" src="{{ asset('images/desa-logo.svg') }}" alt="Logo Desa Batujajar Barat">
                <span><strong>Desa Batujajar</strong><small>Barat · Kabupaten Bandung Barat</small></span>
            </a>
            <nav class="desktop-nav" aria-label="Navigasi utama">
                <a href="{{ route('surat.index') }}" class="active" aria-current="page">Lihat surat</a>
                @if ($user->isRole('penduduk'))
                    <a href="{{ route('surat.create') }}">Pengajuan surat</a>
                @endif
                <a href="{{ route('profil-desa') }}">Profil desa</a>
            </nav>
            <div class="dashboard-nav-actions">
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="nav-logout">Keluar</button></form>
                <button type="button" class="hamburger-button nav-hamburger" id="navToggle" aria-label="Buka menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </header>

    <main class="dashboard-main mx-auto min-h-screen max-w-7xl px-4 py-5 sm:px-6 lg:px-10 lg:py-8">

        <!-- Mobile navigation overlay -->
        <div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
        <aside class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-header">
                <div class="flex items-center gap-3">
                    <div class="role-mark flex h-10 w-10 items-center justify-center rounded-xl bg-[#17624c] text-lg text-white">{{ strtoupper(substr($user->role, 0, 2)) }}</div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#17624c]">{{ $user->name }}</p>
                        <p class="text-xs font-semibold text-slate-500">Desa Batujajar Barat</p>
                    </div>
                </div>
                <button type="button" class="mobile-nav-close" id="navClose" aria-label="Tutup menu">✕</button>
            </div>
            <nav class="mobile-nav-links">
                <a href="{{ route('surat.index') }}" class="mobile-nav-link active">
                    <span class="mobile-nav-icon">📋</span>
                    <span>Dashboard surat</span>
                </a>
                @if ($user->isRole('penduduk'))
                    <a href="{{ route('surat.create') }}" class="mobile-nav-link">
                        <span class="mobile-nav-icon">➕</span>
                        <span>Pengajuan baru</span>
                    </a>
                @endif
                <a href="{{ route('welcome') }}" class="mobile-nav-link">
                    <span class="mobile-nav-icon">🏠</span>
                    <span>Halaman desa</span>
                </a>
                <a href="{{ route('profil-desa') }}" class="mobile-nav-link">
                    <span class="mobile-nav-icon">ℹ️</span>
                    <span>Profil desa</span>
                </a>
            </nav>
            <div class="mobile-nav-footer">
                <div class="mobile-nav-user">
                    <p class="truncate text-xs text-slate-400">{{ $user->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mobile-nav-logout">
                        <span class="mobile-nav-icon">🚪</span>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <section class="hero-panel rounded-2xl px-6 py-7 shadow-xl shadow-emerald-900/10 sm:px-9 sm:py-9">
            <div class="relative z-10 max-w-2xl">
                <p class="text-sm font-medium text-[#f3c969]">Ruang kerja {{ ucfirst($user->role) }}</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">{{ $user->isRole('rt') ? 'Verifikasi pengajuan warga' : ($user->isRole('rw') ? 'Persetujuan wilayah RW' : ($user->isRole('admin') ? 'Kontrol layanan desa' : 'Ajukan surat dengan mudah')) }}</h1>
                <p class="mt-3 max-w-lg text-sm leading-6 text-emerald-50/85">{{ $user->isRole('rt') ? 'Periksa kelengkapan dan berikan keputusan untuk surat yang masuk ke wilayah RT Anda.' : ($user->isRole('rw') ? 'Tinjau pengajuan yang sudah lolos verifikasi RT sebelum diteruskan.' : ($user->isRole('admin') ? 'Pantau seluruh alur, selesaikan persetujuan, dan finalisasi surat desa.' : 'Pantau pengajuan surat Anda dan buat pengajuan baru.')) }}</p>
                @if ($user->isRole('penduduk'))
                    <a href="{{ route('surat.create') }}" class="mt-6 inline-flex items-center justify-center rounded-lg bg-[#f3c969] px-4 py-2.5 text-sm font-bold text-[#145640] shadow-sm transition hover:bg-[#f2c577]">+ Pengajuan baru</a>
                @endif
            </div>
        </section>

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-[#dce4d6] bg-[#e4ecdc] px-4 py-3 text-sm text-[#145640]">{{ session('success') }}</div>
        @endif

        @if ($user->unreadNotifications->isNotEmpty())
            <section class="mb-6 rounded-xl border border-amber-200 bg-amber-50 p-5">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="font-semibold text-amber-950">Pembaruan terbaru</h2>
                    <span class="rounded-full bg-amber-200 px-2.5 py-1 text-xs font-bold text-amber-950">{{ $user->unreadNotifications->count() }} baru</span>
                </div>
                <div class="mt-3 space-y-2">
                    @foreach ($user->unreadNotifications->take(5) as $notification)
                        <a href="{{ route('notifications.read', $notification) }}" class="notification-card block rounded-lg bg-white px-4 py-3 text-sm shadow-sm transition hover:bg-amber-100">
                            <strong class="block text-slate-800">{{ $notification->data['title'] ?? 'Pembaruan surat' }}</strong>
                            <span class="text-slate-600">{{ $notification->data['message'] ?? '' }}</span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="stats-grid grid gap-4 sm:grid-cols-3">
            @foreach ([['label' => 'Total ditemukan', 'value' => $summary['total'], 'hint' => 'sesuai filter saat ini', 'color' => 'text-slate-900'], ['label' => 'Sedang diproses', 'value' => $summary['diproses'], 'hint' => 'menunggu verifikasi', 'color' => 'text-amber-700'], ['label' => 'Sudah selesai', 'value' => $summary['selesai'], 'hint' => 'siap digunakan', 'color' => 'text-[#17624c]']] as $stat)
                <div class="stat-card rounded-xl border border-slate-200/80 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">{{ $stat['label'] }}</p>
                    <p class="mt-2 text-3xl font-bold {{ $stat['color'] }}">{{ $stat['value'] }}</p>
                    <p class="mt-1 text-xs text-slate-400">{{ $stat['hint'] }}</p>
                </div>
            @endforeach
        </section>

        <section class="table-shell mt-8 overflow-hidden rounded-xl border border-slate-200/80 bg-white">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                <h2 class="font-semibold">{{ $user->isRole('penduduk') ? 'Riwayat pengajuan saya' : 'Pengajuan yang perlu diproses' }}</h2>
                <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">@csrf<button type="submit" class="logout-button">Keluar</button></form>
            </div>
            <form method="GET" action="{{ route('surat.index') }}" class="dashboard-filters">
                <label class="filter-search">
                    <span aria-hidden="true">⌕</span>
                    <input type="search" name="q" value="{{ $filters['search'] }}" placeholder="Cari nomor, nama, atau NIK..." aria-label="Cari surat">
                </label>
                <select name="status" aria-label="Filter status">
                    <option value="">Semua status</option>
                    @foreach (['pending' => 'Menunggu RT', 'rt_approved' => 'Menunggu RW', 'rw_approved' => 'Menunggu admin', 'finalized' => 'Selesai', 'rejected' => 'Ditolak', 'rt_rejected' => 'Ditolak RT', 'rw_rejected' => 'Ditolak RW'] as $key => $label)
                        <option value="{{ $key }}" @selected($filters['status'] === $key)>{{ $label }}</option>
                    @endforeach
                </select>
                <select name="jenis" aria-label="Filter jenis surat">
                    <option value="">Semua jenis surat</option>
                    @foreach ($jenisSurat as $key => $prefix)
                        <option value="{{ $key }}" @selected($filters['jenis'] === $key)>{{ str_replace('_', ' ', ucfirst($key)) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="filter-button">Terapkan</button>
                @if ($filters['search'] || $filters['status'] || $filters['jenis'])
                    <a href="{{ route('surat.index') }}" class="filter-reset">Reset</a>
                @endif
            </form>
            <div class="dashboard-table-wrap overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Nomor surat</th>
                            <th class="px-5 py-3">Pemohon</th>
                            <th class="px-5 py-3">Jenis</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Tanggal</th>
                            <th class="px-5 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                    @forelse ($surat as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="whitespace-nowrap px-5 py-4 font-medium">{{ $item->nomor_surat }}</td>
                            <td class="px-5 py-4">{{ $item->penduduk->nama }}</td>
                            <td class="px-5 py-4">{{ str_replace('_', ' ', ucfirst($item->jenis_surat)) }}</td>
                            <td class="px-5 py-4">
                                <span class="status-badge status-{{ $item->status }}">{{ str_replace('_', ' ', $item->status) }}</span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-500">{{ $item->tanggal_pengajuan?->format('d M Y') }}</td>
                            <td class="px-5 py-4">
                                <div class="action-cell">
                                    <a href="{{ route('surat.show', $item) }}" class="preview-button">Lihat review</a>
                                    @php($approvalLevel = ['pending' => 'rt', 'rt_approved' => 'rw', 'rw_approved' => 'admin'][$item->status] ?? null)
                                    @if ($approvalLevel && $user->isRole($approvalLevel))
                                        <form method="POST" action="{{ route('surat.approve', [$item, $approvalLevel]) }}">@csrf<button type="submit" class="approve-button">Setujui {{ strtoupper($approvalLevel) }}</button></form>
                                        <form method="POST" action="{{ route('surat.reject', [$item, $approvalLevel]) }}">@csrf<button type="submit" class="reject-button">Tolak</button></form>
                                    @elseif ($approvalLevel)
                                        <span class="text-xs text-slate-400">Menunggu {{ strtoupper($approvalLevel) }}</span>
                                    @else
                                        <span class="text-xs text-slate-400">Selesai diproses</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-12 text-center text-slate-500">Belum ada pengajuan surat.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if ($surat->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">{{ $surat->withQueryString()->links() }}</div>
            @endif
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navToggle = document.getElementById('navToggle');
            const navClose = document.getElementById('navClose');
            const mobileNav = document.getElementById('mobileNav');
            const overlay = document.getElementById('mobileNavOverlay');

            function openNav() {
                mobileNav.classList.add('open');
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function closeNav() {
                mobileNav.classList.remove('open');
                overlay.classList.remove('open');
                document.body.style.overflow = '';
            }

            navToggle.addEventListener('click', openNav);
            navClose.addEventListener('click', closeNav);
            overlay.addEventListener('click', closeNav);
        });
    </script>
</body>
</html>