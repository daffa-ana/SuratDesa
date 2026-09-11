<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Berita dan informasi terkini Desa Batujajar Barat.">
    <title>Berita Desa | Desa Batujajar Barat</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body class="public-page">
    <header class="public-header">
        <div class="public-container public-nav">
            <a href="{{ route('welcome') }}" class="public-brand" aria-label="Beranda Desa Batujajar Barat">
                <img class="brand-mark" src="{{ asset('images/logo-batujajar-barat.png') }}" alt="Logo Desa Batujajar Barat">
                <span><strong>Desa Batujajar</strong><small>Barat · Kabupaten Bandung Barat</small></span>
            </a>
            <nav class="desktop-nav" aria-label="Navigasi utama">
                <a href="{{ route('welcome') }}#layanan">Layanan</a>
                <a href="{{ route('berita') }}" aria-current="page">Berita</a>
                <a href="{{ route('profil-desa') }}">Profil desa</a>
                <a href="{{ route('welcome') }}#alur">Cara mengajukan</a>
            </nav>
            <a href="{{ auth()->check() ? route('surat.index') : route('login') }}" class="nav-action">Lihat surat <span aria-hidden="true">↗</span></a>
        </div>
    </header>

    <main>
        <section class="profile-hero">
            <div class="public-container profile-hero-grid">
                <div>
                    <p class="public-eyebrow">Informasi terkini</p>
                    <h1>Berita dan <em>kegiatan desa</em>.</h1>
                    <p class="profile-hero-copy">Ikuti perkembangan pembangunan, pelayanan, dan kegiatan warga Desa Batujajar Barat dalam satu halaman.</p>
                </div>
                <div class="profile-fact-panel">
                    <small>Update terakhir</small>
                    <strong>September 2026</strong>
                    <p>Berita desa terbaru untuk warga dan mitra kerja.</p>
                </div>
            </div>
        </section>

        <section class="public-section news-section">
            <div class="public-container">
                <div class="news-grid">
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1544644181-af0e1e14916f?w=700&h=450&fit=crop&auto=format" alt="Pembangunan desa">
                        <div class="news-card-body">
                            <small>Pembangunan · 3 September 2026</small>
                            <h3>Renovasi Jalan Desa Blok Cibatu Selesai Dikerjakan</h3>
                            <p>Proyek perbaikan jalan sepanjang 1,2 km telah rampung dan siap digunakan warga. Kondisi akses ke permukiman kini lebih aman dan nyaman untuk kendaraan roda dua maupun roda empat.</p>
                            <a href="#">Baca selengkapnya <span>→</span></a>
                        </div>
                    </article>
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1572908721147-0a9eb395762d?w=700&h=450&fit=crop&auto=format" alt="Kegiatan posyandu">
                        <div class="news-card-body">
                            <small>Kesehatan · 27 Agustus 2026</small>
                            <h3>Posyandu Balita Rutin Dilaksanakan di RW 04</h3>
                            <p>Warga mendapatkan pelayanan imunisasi, penimbangan, dan penyuluhan gizi. Kegiatan ini rutin dilaksanakan untuk menjaga kesehatan ibu dan anak di lingkungan desa.</p>
                            <a href="#">Baca selengkapnya <span>→</span></a>
                        </div>
                    </article>
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1608335715837-1994a535d5c3?w=700&h=450&fit=crop&auto=format" alt="Kegiatan kemerdekaan desa">
                        <div class="news-card-body">
                            <small>Kegiatan · 15 Agustus 2026</small>
                            <h3>Peringatan HUT RI ke-81 Meriah di Lapangan Desa</h3>
                            <p>Berbagai lomba tradisional dan budaya Sunda meramaikan hari kemerdekaan. Lapangan desa dipadati warga, anak-anak, hingga perangkat desa yang ikut merayakan.</p>
                            <a href="#">Baca selengkapnya <span>→</span></a>
                        </div>
                    </article>
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=700&h=450&fit=crop&auto=format" alt="Kerja bakti desa">
                        <div class="news-card-body">
                            <small>Lingkungan · 8 Agustus 2026</small>
                            <h3>Kerja Bakti Gotong Royong Membersihkan Saluran Air Desa</h3>
                            <p>Warga bersama petugas desa melakukan pembersihan saluran air guna mencegah banjir saat musim hujan. Kegiatan ini menjadi bentuk nyata kepedulian lingkungan.</p>
                            <a href="#">Baca selengkapnya <span>→</span></a>
                        </div>
                    </article>
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=700&h=450&fit=crop&auto=format" alt="Pelatihan warga">
                        <div class="news-card-body">
                            <small>Pemberdayaan · 1 Agustus 2026</small>
                            <h3>Pelatihan Digital untuk UMKM Desa Digelar di Balai Desa</h3>
                            <p>Pelatihan penggunaan media sosial dan e-commerce dipusatkan untuk membantu pelaku UMKM desa menjangkau pasar lebih luas secara digital.</p>
                            <a href="#">Baca selengkapnya <span>→</span></a>
                        </div>
                    </article>
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=700&h=450&fit=crop&auto=format" alt="Sensus warga">
                        <div class="news-card-body">
                            <small>Administrasi · 21 Juli 2026</small>
                            <h3>Update Data Penduduk Dilakukan Secara Bertahap di Setiap RW</h3>
                            <p>Pemerintah desa melakukan pendataan ulang untuk memastikan data kependudukan dan layanan sosial bisa disalurkan tepat sasaran.</p>
                            <a href="#">Baca selengkapnya <span>→</span></a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <footer class="public-footer profile-footer">
        <div class="public-container">
            <span>© 2026 Pemerintah Desa Batujajar Barat</span>
            <a href="{{ route('welcome') }}">Kembali ke beranda <span>↗</span></a>
        </div>
    </footer>
</body>
</html>
