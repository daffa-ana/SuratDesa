<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profil dan pemerintahan Desa Batujajar Barat.">
    <title>Profil Desa | Desa Batujajar Barat</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body class="profile-page">
    <header class="public-header">
        <div class="public-container public-nav">
            <a href="{{ route('welcome') }}" class="public-brand" aria-label="Beranda Desa Batujajar Barat">
                <img class="brand-mark" src="{{ asset('images/desa-logo.svg') }}" alt="Logo Desa Batujajar Barat">
                <span><strong>Desa Batujajar</strong><small>Barat · Kabupaten Bandung Barat</small></span>
            </a>
            <nav class="desktop-nav" aria-label="Navigasi utama">
                <a href="{{ route('welcome') }}#layanan">Layanan</a>
                <a href="{{ route('profil-desa') }}" aria-current="page">Profil desa</a>
                <a href="{{ route('welcome') }}#alur">Cara mengajukan</a>
            </nav>
            <a href="{{ auth()->check() ? route('surat.index') : route('login') }}" class="nav-action">Lihat surat <span aria-hidden="true">↗</span></a>
        </div>
    </header>

    <main>
        <section class="profile-hero">
            <div class="public-container profile-hero-grid">
                <div>
                    <p class="public-eyebrow">Profil dan pemerintahan desa</p>
                    <h1>Mengenal <em>Batujajar Barat</em> lebih dekat.</h1>
                    <p class="profile-hero-copy">Desa yang bertumbuh bersama warganya, dengan pelayanan yang terbuka, pemerintahan yang hadir, dan ruang kolaborasi untuk semua.</p>
                </div>
                <div class="profile-fact-panel">
                    <small>Identitas wilayah</small>
                    <strong>Desa Batujajar Barat</strong>
                    <p>Kecamatan Batujajar · Kabupaten Bandung Barat · Provinsi Jawa Barat</p>
                </div>
            </div>
        </section>

        <section class="profile-content">
            <div class="public-container profile-intro-grid">
                <div>
                    <p class="public-eyebrow">Tentang desa</p>
                    <h2>Hadir untuk melayani dengan dekat.</h2>
                </div>
                <div>
                    <p>Desa Batujajar Barat adalah rumah bagi warga yang terus bergerak, bekerja, dan membangun kehidupan bersama. Pemerintah desa berkomitmen menghadirkan pelayanan administrasi yang mudah dipahami serta membuka ruang partisipasi bagi masyarakat.</p>
                    <div class="profile-values">
                        <div class="profile-value"><span>01 / Terbuka</span><p>Informasi dan proses pelayanan dapat diakses dengan jelas oleh warga.</p></div>
                        <div class="profile-value"><span>02 / Melayani</span><p>Setiap kebutuhan warga ditangani dengan ramah, tertib, dan bertanggung jawab.</p></div>
                        <div class="profile-value"><span>03 / Bertumbuh</span><p>Pembangunan desa dirancang untuk menciptakan kesempatan yang lebih baik.</p></div>
                        <div class="profile-value"><span>04 / Bersama</span><p>Warga adalah bagian penting dari setiap keputusan dan kemajuan desa.</p></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="government-section">
            <div class="public-container">
                <div class="government-heading">
                    <div><p class="public-eyebrow">Pemerintahan desa</p><h2>Orang-orang yang melayani desa.</h2></div>
                    <p>Struktur pemerintahan Desa Batujajar Barat bekerja bersama untuk memastikan pelayanan dan pembangunan berjalan baik.</p>
                </div>
                <div class="government-grid">
                    <article class="official-card leader"><small>Kepala desa</small><h3>Bapak Asep Suherman</h3><p>Memimpin penyelenggaraan pemerintahan dan pembangunan desa.</p></article>
                    <article class="official-card"><small>Sekretaris desa</small><h3>Ibu Rina Marlina</h3><p>Koordinasi administrasi dan pelayanan umum.</p></article>
                    <article class="official-card"><small>Kaur pemerintahan</small><h3>Bapak Dedi Hidayat</h3><p>Urusan tata pemerintahan dan kependudukan.</p></article>
                    <article class="official-card"><small>Kaur kesejahteraan</small><h3>Ibu Siti Aminah</h3><p>Program sosial dan pemberdayaan masyarakat.</p></article>
                    <article class="official-card"><small>Kaur pelayanan</small><h3>Bapak Yayan Suryana</h3><p>Pelayanan administrasi dan kebutuhan warga.</p></article>
                </div>
            </div>
        </section>

        <section class="public-section info-section">
            <div class="public-container info-grid">
                <div><p class="public-eyebrow">Kunjungi kami</p><h2>Ruang pelayanan selalu terbuka.</h2><p>Untuk kebutuhan yang memerlukan tatap muka, silakan datang pada jam pelayanan kantor desa.</p></div>
                <div class="info-list"><div><span>Alamat kantor</span><strong>Jl. Raya Batujajar Barat No. 1<br>Kabupaten Bandung Barat</strong></div><div><span>Kontak layanan</span><strong>(022) 6860 1234<br>layanan@batujajarbarat.desa.id</strong></div><div><span>Jam pelayanan</span><strong>Senin–Jumat<br>08.00–15.00 WIB</strong></div></div>
            </div>
        </section>
    </main>

    <footer class="public-footer profile-footer"><div class="public-container"><span>© 2026 Pemerintah Desa Batujajar Barat</span><a href="{{ route('welcome') }}">Kembali ke beranda <span>↗</span></a></div></footer>
</body>
</html>
