<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Persuratan Desa</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>
<body class="login-page">
    <main class="login-layout">
        <section class="login-intro">
            <a href="{{ route('welcome') }}" class="login-brand">
                <img class="brand-mark" src="{{ asset('images/logo-batujajar-barat.png') }}" alt="Logo Desa Batujajar Barat">
                <span><strong>Desa Batujajar</strong><small>Barat · Portal warga</small></span>
            </a>
            <p class="eyebrow">Sistem administrasi desa</p>
            <h1>Satu pintu untuk layanan surat warga.</h1>
            <p class="intro-copy">Masuk sesuai peran Anda untuk melihat pekerjaan dan proses yang menjadi tanggung jawabnya.</p>
            <div class="role-list">
                <span><b>RT</b> <small>Verifikasi awal</small></span>
                <span><b>RW</b> <small>Persetujuan wilayah</small></span>
                <span><b>ADMIN</b> <small>Finalisasi layanan</small></span>
                <span><b>WARGA</b> <small>Ajukan surat</small></span>
            </div>
            <a href="{{ route('welcome') }}" class="back-home">← Kembali ke halaman desa</a>
        </section>
        <section class="login-card">
            <div class="login-card-top">
                <span class="login-lock">✦</span>
                <span>RUANG LAYANAN DIGITAL</span>
            </div>
            <p class="eyebrow">Desa Batujajar Barat</p>
            <h2>Selamat datang</h2>
            <p class="login-subtitle">Masuk untuk mengurus layanan dengan lebih mudah.</p>
            @if ($errors->any())
                <div class="login-error">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <div class="field">
                    <label for="email">Alamat email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@desa.id">
                </div>
                <div class="field">
                    <div class="field-label-row">
                        <label for="password">Password</label>
                        <span>Rahasia dan aman</span>
                    </div>
                    <input id="password" type="password" name="password" required placeholder="Masukkan password">
                </div>
                <label class="remember">
                    <input type="checkbox" name="remember"> Ingat saya <span>•</span> Sesi tetap aktif
                </label>
                <button type="submit">Masuk ke dashboard <span>→</span></button>
            </form>
            <div class="divider-text">atau</div>
            <a href="{{ route('google.redirect') }}" class="google-button">Masuk dengan Google</a>
        </section>
    </main>
</body>
</html>