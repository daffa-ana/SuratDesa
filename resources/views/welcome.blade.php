<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal layanan dan informasi Desa Batujajar Barat.">
    <title>Desa Batujajar Barat | Layanan Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
</head>
<body class="public-page">
    <header class="public-header">
        <div class="public-container public-nav">
            <a href="{{ route('welcome') }}" class="public-brand" aria-label="Beranda Desa Batujajar Barat">
                <img class="brand-mark" src="{{ asset('images/desa-logo.svg') }}" alt="Logo Desa Batujajar Barat">
                <span><strong>Desa Batujajar</strong><small>Barat · Kabupaten Bandung Barat</small></span>
            </a>
            <nav class="desktop-nav" aria-label="Navigasi utama">
                <a href="#layanan">Layanan</a>
                <a href="{{ route('profil-desa') }}">Profil desa</a>
                <a href="#alur">Cara mengajukan</a>
            </nav>
            <a href="{{ auth()->check() ? route('surat.index') : route('login') }}" class="nav-action">Lihat surat <span aria-hidden="true">↗</span></a>
        </div>
    </header>

    <main>
        <section class="public-hero">
            <div class="public-container hero-grid">
                <div class="hero-copy">
                    <p class="public-eyebrow">Portal resmi pelayanan warga</p>
                    <h1>Desa yang dekat, layanan yang <em>jelas.</em></h1>
                    <p class="hero-description">Temukan informasi desa dan ajukan surat administrasi tanpa perlu menebak harus mulai dari mana.</p>
                    <div class="hero-actions">
                        <a href="{{ auth()->check() ? route('surat.index') : route('login') }}" class="primary-action">Lihat surat <span aria-hidden="true">→</span></a>
                        <a href="#informasi" class="text-action">Lihat informasi desa <span aria-hidden="true">↓</span></a>
                    </div>
                    <div class="hero-note"><span class="live-dot"></span><span><strong>Jam layanan</strong> Senin–Jumat, 08.00–15.00 WIB</span></div>
                </div>
                <div class="village-card" aria-label="Ringkasan layanan Desa Batujajar Barat">
                    <div class="village-card-top"><span class="sun-symbol">✦</span><span>BATUJAJAR BARAT</span><span class="card-year">2026</span></div>
                    <div class="village-landscape"><span class="landscape-sun"></span><span class="landscape-hill hill-one"></span><span class="landscape-hill hill-two"></span><span class="landscape-house">⌂</span></div>
                    <div class="village-card-bottom"><div><small>LAYANAN DIGITAL</small><strong>Satu ruang untuk<br>urusan warga.</strong></div><span class="card-arrow">↗</span></div>
                </div>
            </div>
        </section>

        <section id="layanan" class="public-section services-section">
            <div class="public-container">
                <div class="section-heading"><div><p class="public-eyebrow">Yang bisa Anda lakukan</p><h2>Layanan untuk kebutuhan sehari-hari.</h2></div><p>Mulai dari rumah. Pantau prosesnya. Datang hanya saat diperlukan.</p></div>
                <div class="service-grid">
                    <a href="{{ auth()->check() ? route('surat.index') : route('login') }}" class="service-card service-featured"><span class="service-icon">01</span><div><h3>Lihat surat</h3><p>Cek riwayat dan status surat Anda, lalu ajukan surat domisili, usaha, atau pengantar secara online.</p><span class="service-link">Buka daftar surat <b>→</b></span></div></a>
                    <div class="service-card"><span class="service-icon service-icon-light">02</span><div><h3>Pantau status</h3><p>Lihat riwayat pengajuan dan keputusan RT, RW, hingga perangkat desa dalam satu tempat.</p></div></div>
                    <div class="service-card"><span class="service-icon service-icon-light">03</span><div><h3>Informasi desa</h3><p>Dapatkan kabar pelayanan, jam operasional, dan informasi penting untuk warga.</p></div></div>
                </div>
            </div>
        </section>

        <section id="berita" class="public-section news-section">
            <div class="public-container">
                <div class="section-heading"><div><p class="public-eyebrow">Informasi terkini</p><h2>Berita Desa</h2></div><p>Kabar pembangunan, kegiatan, dan pelayanan terbaru untuk warga Batujajar Barat.</p></div>
                <div class="news-grid">
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1544644181-af0e1e14916f?w=700&h=450&fit=crop&auto=format" alt="Pembangunan desa">
                        <div class="news-card-body"><small>Pembangunan · 3 September 2026</small><h3>Renovasi Jalan Desa Blok Cibatu Selesai Dikerjakan</h3><p>Proyek perbaikan jalan sepanjang 1,2 km telah rampung dan siap digunakan warga.</p><a href="#berita">Baca selengkapnya <span>→</span></a></div>
                    </article>
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1572908721147-0a9eb395762d?w=700&h=450&fit=crop&auto=format" alt="Kegiatan posyandu">
                        <div class="news-card-body"><small>Kesehatan · 27 Agustus 2026</small><h3>Posyandu Balita Rutin Dilaksanakan di RW 04</h3><p>Warga mendapatkan pelayanan imunisasi, penimbangan, dan penyuluhan gizi.</p><a href="#berita">Baca selengkapnya <span>→</span></a></div>
                    </article>
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1608335715837-1994a535d5c3?w=700&h=450&fit=crop&auto=format" alt="Kegiatan kemerdekaan desa">
                        <div class="news-card-body"><small>Kegiatan · 15 Agustus 2026</small><h3>Peringatan HUT RI ke-81 Meriah di Lapangan Desa</h3><p>Berbagai lomba tradisional dan budaya Sunda meramaikan hari kemerdekaan.</p><a href="#berita">Baca selengkapnya <span>→</span></a></div>
                    </article>
                </div>
            </div>
        </section>

        <section id="alur" class="public-section process-section">
            <div class="public-container process-grid"><div><p class="public-eyebrow">Tidak perlu rumit</p><h2>Tiga langkah, selesai.</h2><p class="process-intro">Kami membuat alur pelayanan lebih mudah dipahami, supaya waktu Anda bisa digunakan untuk hal yang lebih penting.</p><a href="{{ auth()->check() ? route('surat.index') : route('login') }}" class="outline-action">Lihat surat sekarang <span>→</span></a></div><div class="steps"><div class="step"><span>01</span><div><h3>Masuk atau daftar</h3><p>Gunakan akun Anda untuk mengakses layanan persuratan.</p></div></div><div class="step"><span>02</span><div><h3>Isi data pengajuan</h3><p>Pilih jenis surat dan lengkapi data yang dibutuhkan.</p></div></div><div class="step"><span>03</span><div><h3>Pantau sampai selesai</h3><p>Ikuti status verifikasi dan unduh surat saat sudah selesai.</p></div></div></div></div>
        </section>

        <section id="informasi" class="public-section info-section">
            <div class="public-container info-grid"><div><p class="public-eyebrow">Sekilas tentang kami</p><h2>Ruang tumbuh bersama warga.</h2><p>Desa Batujajar Barat hadir untuk melayani dengan terbuka, cepat, dan ramah. Kanal digital ini melengkapi pelayanan tatap muka di kantor desa.</p><a href="{{ route('profil-desa') }}" class="info-link">Lihat profil dan pemerintahan desa <span>→</span></a></div><div class="info-list"><div><span>Alamat kantor</span><strong>Jl. Raya Batujajar Barat No. 1<br>Kabupaten Bandung Barat</strong></div><div><span>Kontak layanan</span><strong>(022) 6860 1234<br>layanan@batujajarbarat.desa.id</strong></div><div><span>Pelayanan tatap muka</span><strong>Senin–Jumat<br>08.00–15.00 WIB</strong></div></div></div>
        </section>
    </main>

    <footer class="public-footer"><div class="public-container"><span>© 2026 Pemerintah Desa Batujajar Barat</span><a href="{{ route('login') }}">Portal petugas <span>↗</span></a></div></footer>
</body>
</html>
