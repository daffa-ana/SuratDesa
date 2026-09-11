<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Surat</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body class="dashboard-shell form-page min-h-screen text-slate-900">
    <header class="public-header">
        <div class="public-container public-nav">
            <a href="{{ route('welcome') }}" class="public-brand" aria-label="Beranda Desa Batujajar Barat">
                <img class="brand-mark" src="{{ asset('images/desa-logo.svg') }}" alt="Logo Desa Batujajar Barat">
                <span><strong>Desa Batujajar</strong><small>Barat · Kabupaten Bandung Barat</small></span>
            </a>
            <nav class="desktop-nav" aria-label="Navigasi utama">
                <a href="{{ route('surat.index') }}">Lihat surat</a>
                <a href="{{ route('surat.create') }}" class="active" aria-current="page">Pengajuan surat</a>
                <a href="{{ route('profil-desa') }}">Profil desa</a>
            </nav>
            <div class="dashboard-nav-actions">
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="nav-logout">Keluar</button></form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:py-12">
        <div class="form-breadcrumb">
            <a href="{{ route('surat.index') }}">&larr; Kembali ke daftar</a>
            <span>LAYANAN WARGA / SURAT</span>
        </div>
        <div class="mt-5 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-xl shadow-emerald-900/5">
            <div class="form-card-head bg-[#17624c] px-6 py-7 text-white sm:px-8">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#f3c969]">Layanan warga</p>
                <h1 class="text-2xl font-bold">Pengajuan surat baru</h1>
                <p class="mt-2 text-sm text-white/80">Nomor surat akan dibuat otomatis setelah pengajuan disimpan.</p>
            </div>
            <div class="p-6 sm:p-8">
                @if ($errors->any())
                    <div class="mt-5 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('surat.store') }}" method="POST" class="mt-6 space-y-5">
                    @csrf
                    <label class="block">
                        <span class="text-sm font-semibold">Jenis surat</span>
                        <select name="jenis_surat" required class="mt-2 w-full rounded-lg border-slate-300">
                            <option value="">Pilih jenis surat</option>
                            @foreach ($jenisSurat as $key => $prefix)
                                <option value="{{ $key }}" @selected(old('jenis_surat') === $key)>{{ str_replace('_', ' ', ucfirst($key)) }} ({{ $prefix }})</option>
                            @endforeach
                        </select>
                    </label>
                    <div class="biodata-heading">
                        <strong>Biodata pemohon</strong>
                        <span>Isi manual sesuai identitas warga</span>
                    </div>
                    <div class="manual-grid">
                        <label>
                            <span>NIK</span>
                            <input name="nik" value="{{ old('nik') }}" inputmode="numeric" maxlength="16" required placeholder="16 digit NIK">
                        </label>
                        <label>
                            <span>Nama lengkap</span>
                            <input name="nama" value="{{ old('nama') }}" required placeholder="Nama sesuai KTP">
                        </label>
                        <label>
                            <span>Jenis kelamin</span>
                            <select name="jenis_kelamin" required>
                                <option value="">Pilih</option>
                                <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
                                <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                            </select>
                        </label>
                        <label>
                            <span>Tanggal lahir</span>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        </label>
                        <label class="full-field">
                            <span>Alamat lengkap</span>
                            <textarea name="alamat" rows="2" required placeholder="Alamat tempat tinggal">{{ old('alamat') }}</textarea>
                        </label>
                        <label>
                            <span>RT</span>
                            <input name="rt" value="{{ old('rt') }}" maxlength="3" required placeholder="001">
                        </label>
                        <label>
                            <span>RW</span>
                            <input name="rw" value="{{ old('rw') }}" maxlength="3" required placeholder="001">
                        </label>
                        <label>
                            <span>Agama</span>
                            <input name="agama" value="{{ old('agama') }}" placeholder="Agama">
                        </label>
                        <label>
                            <span>Pekerjaan</span>
                            <input name="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="Pekerjaan">
                        </label>
                        <label>
                            <span>Status perkawinan</span>
                            <select name="status_perkawinan">
                                <option value="">Pilih status</option>
                                @foreach (['belum_menikah' => 'Belum menikah', 'menikah' => 'Menikah', 'cerai' => 'Cerai'] as $key => $label)
                                    <option value="{{ $key }}" @selected(old('status_perkawinan') === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <span>Nomor telepon</span>
                            <input name="telepon" value="{{ old('telepon') }}" inputmode="tel" placeholder="08xxxxxxxxxx">
                        </label>
                    </div>
                    <label class="block">
                        <span class="text-sm font-semibold">Keperluan</span>
                        <textarea name="keperluan" required rows="4" class="mt-2 w-full rounded-lg border-slate-300" placeholder="Jelaskan keperluan surat">{{ old('keperluan') }}</textarea>
                    </label>
                    <button class="w-full rounded-lg bg-[#17624c] px-4 py-3 font-semibold text-white hover:bg-[#145640]">Simpan pengajuan</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>