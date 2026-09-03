<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persuratan Desa</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="dashboard-shell role-dashboard role-{{ $user->role }} min-h-screen text-slate-900">
    <main class="dashboard-main mx-auto min-h-screen max-w-7xl px-4 py-5 sm:px-6 lg:px-10 lg:py-8">
        <header class="mb-7 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="role-mark flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-800 text-xl text-white shadow-lg shadow-emerald-900/20">{{ strtoupper(substr($user->role, 0, 2)) }}</div>
                <div><p class="text-xs font-bold uppercase tracking-[0.18em] text-emerald-800">{{ strtoupper($user->role) }} · administrasi desa</p><p class="font-bold text-slate-800">Batujajar barat</p></div>
            </div>
            <div class="hidden text-right sm:block"><p class="text-xs text-slate-500">Kamis, 03 September 2026</p><p class="mt-1 text-sm font-semibold text-slate-700">Ruang layanan digital</p></div>
        </header>

        <section class="hero-panel rounded-2xl px-6 py-7 shadow-xl shadow-emerald-900/10 sm:px-9 sm:py-9">
            <div class="relative z-10 max-w-2xl"><p class="text-sm font-medium text-emerald-100">Ruang kerja {{ ucfirst($user->role) }}</p><h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">{{ $user->isRole('rt') ? 'Verifikasi pengajuan warga' : ($user->isRole('rw') ? 'Persetujuan wilayah RW' : ($user->isRole('admin') ? 'Kontrol layanan desa' : 'Ajukan surat dengan mudah')) }}</h1><p class="mt-3 max-w-lg text-sm leading-6 text-emerald-50/85">{{ $user->isRole('rt') ? 'Periksa kelengkapan dan berikan keputusan untuk surat yang masuk ke wilayah RT Anda.' : ($user->isRole('rw') ? 'Tinjau pengajuan yang sudah lolos verifikasi RT sebelum diteruskan.' : ($user->isRole('admin') ? 'Pantau seluruh alur, selesaikan persetujuan, dan finalisasi surat desa.' : 'Pantau pengajuan surat Anda dan buat pengajuan baru.')) }}</p>@if ($user->isRole('penduduk'))<a href="{{ route('surat.create') }}" class="mt-6 inline-flex items-center justify-center rounded-lg bg-amber-300 px-4 py-2.5 text-sm font-bold text-emerald-950 shadow-sm transition hover:bg-amber-200">+ Pengajuan baru</a>@endif</div>
        </section>

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
        @endif

        <section class="stats-grid grid gap-4 sm:grid-cols-3">
            @foreach ([['label' => 'Total surat', 'value' => $surat->total(), 'color' => 'text-slate-900'], ['label' => 'Halaman aktif', 'value' => $surat->currentPage(), 'color' => 'text-amber-700'], ['label' => 'Jenis surat', 'value' => count($jenisSurat), 'color' => 'text-emerald-700']] as $stat)
                <div class="stat-card rounded-xl border border-slate-200/80 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">{{ $stat['label'] }}</p>
                    <p class="mt-2 text-3xl font-bold {{ $stat['color'] }}">{{ $stat['value'] }}</p>
                </div>
            @endforeach
        </section>

        <section class="table-shell mt-8 overflow-hidden rounded-xl border border-slate-200/80 bg-white">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4"><h2 class="font-semibold">{{ $user->isRole('penduduk') ? 'Riwayat pengajuan saya' : 'Pengajuan yang perlu diproses' }}</h2><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="logout-button">Keluar</button></form></div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-5 py-3">Nomor surat</th><th class="px-5 py-3">Pemohon</th><th class="px-5 py-3">Jenis</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Aksi</th></tr></thead>
                    <tbody class="divide-y divide-slate-100">
                    @forelse ($surat as $item)
                        <tr class="hover:bg-slate-50"><td class="whitespace-nowrap px-5 py-4 font-medium">{{ $item->nomor_surat }}</td><td class="px-5 py-4">{{ $item->penduduk->nama }}</td><td class="px-5 py-4">{{ str_replace('_', ' ', ucfirst($item->jenis_surat)) }}</td><td class="px-5 py-4"><span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">{{ str_replace('_', ' ', $item->status) }}</span></td><td class="whitespace-nowrap px-5 py-4 text-slate-500">{{ $item->tanggal_pengajuan?->format('d M Y') }}</td><td class="px-5 py-4"><div class="action-cell">@php($approvalLevel = ['pending' => 'rt', 'rt_approved' => 'rw', 'rw_approved' => 'admin'][$item->status] ?? null) @if ($approvalLevel && $user->isRole($approvalLevel))<form method="POST" action="{{ route('surat.approve', [$item, $approvalLevel]) }}">@csrf<button type="submit" class="approve-button">Setujui {{ strtoupper($approvalLevel) }}</button></form><form method="POST" action="{{ route('surat.reject', [$item, $approvalLevel]) }}">@csrf<button type="submit" class="reject-button">Tolak</button></form>@elseif ($approvalLevel)<span class="text-xs text-slate-400">Menunggu {{ strtoupper($approvalLevel) }}</span>@else<span class="text-xs text-slate-400">Selesai diproses</span>@endif</div></td></tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-12 text-center text-slate-500">Belum ada pengajuan surat.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if ($surat->hasPages()) <div class="border-t border-slate-200 px-5 py-4">{{ $surat->links() }}</div> @endif
        </section>
    </main>
</body>
</html>