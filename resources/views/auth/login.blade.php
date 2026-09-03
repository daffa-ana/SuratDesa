<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Masuk | Persuratan Desa</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="login-page">
    <main class="login-layout">
        <section class="login-intro"><div class="brand-mark">SD</div><p class="eyebrow">Sistem administrasi desa</p><h1>Satu pintu untuk layanan surat warga.</h1><p class="intro-copy">Masuk sesuai peran Anda untuk melihat pekerjaan dan proses yang menjadi tanggung jawabnya.</p><div class="role-list"><span>RT <small>Verifikasi awal</small></span><span>RW <small>Persetujuan wilayah</small></span><span>ADMIN <small>Finalisasi layanan</small></span><span>PENDUDUK <small>Ajukan surat</small></span></div></section>
        <section class="login-card"><p class="eyebrow">Desa Sukamaju</p><h2>Selamat datang</h2><p class="login-subtitle">Masuk ke ruang kerja persuratan.</p>
            @if ($errors->any())<div class="login-error">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('login.store') }}">@csrf<div class="field"><label for="email">Email</label><input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@desa.id"></div><div class="field"><label for="password">Password</label><input id="password" type="password" name="password" required placeholder="Masukkan password"></div><label class="remember"><input type="checkbox" name="remember"> Ingat saya</label><button type="submit">Masuk ke dashboard <span>→</span></button></form>
        </section>
    </main>
</body>
</html>