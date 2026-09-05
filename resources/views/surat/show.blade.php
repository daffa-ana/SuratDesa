<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review {{ $surat->nomor_surat }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>
<body class="review-page">
    <main class="review-layout">
        <div class="review-toolbar">
            <a href="{{ route('surat.index') }}">&larr; Kembali</a>
            <button type="button" onclick="window.print()" class="print-button">Cetak review</button>
        </div>
        <article class="letter-paper">
            <header class="letter-head">
                <div class="letter-emblem">DB</div>
                <div>
                    <h1>PEMERINTAH DESA BATUJAJAR BARAT</h1>
                    <p>Kecamatan Batujajar Barat · Kabupaten Bandung Barat</p>
                    <p>Jl. Raya Batujajar Barat No. 1 · layanan@batujajarbarat.desa.id</p>
                </div>
            </header>
            <div class="letter-rule"></div>
            <section class="letter-title">
                <h2>{{ strtoupper(str_replace('_', ' ', $surat->jenis_surat)) }}</h2>
                <p>Nomor: {{ $surat->nomor_surat }}</p>
            </section>
            <p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>
            <dl class="identity-list">
                <div><dt>Nama</dt><dd>{{ $surat->penduduk->nama }}</dd></div>
                <div><dt>NIK</dt><dd>{{ $surat->penduduk->nik }}</dd></div>
                <div><dt>Jenis kelamin</dt><dd>{{ $surat->penduduk->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd></div>
                <div><dt>Tempat tinggal</dt><dd>{{ $surat->penduduk->alamat }} RT {{ $surat->penduduk->rt }} / RW {{ $surat->penduduk->rw }}</dd></div>
                <div><dt>Tanggal lahir</dt><dd>{{ $surat->penduduk->tanggal_lahir?->translatedFormat('d F Y') }}</dd></div>
                <div><dt>Pekerjaan</dt><dd>{{ $surat->penduduk->pekerjaan ?: '-' }}</dd></div>
            </dl>
            <p>Surat keterangan ini dibuat untuk keperluan <strong>{{ $surat->keperluan }}</strong> dan dapat digunakan sebagaimana mestinya.</p>
            <p class="letter-date">Batujajar Barat, {{ $surat->tanggal_final?->translatedFormat('d F Y') ?: now()->translatedFormat('d F Y') }}</p>
            <div class="signature">
                <p>Kepala Desa Batujajar Barat</p>
                <div class="signature-space"></div>
                <strong>( ____________________ )</strong>
            </div>
            <footer class="review-status">
                <span>Status: <strong>{{ str_replace('_', ' ', $surat->status) }}</strong></span>
                <span>Pengajuan: {{ $surat->tanggal_pengajuan?->format('d M Y H:i') }}</span>
            </footer>
        </article>

        @if ($surat->logs->isNotEmpty())
            <section class="mt-8 rounded-xl border border-slate-200 bg-white p-6 shadow-sm" style="max-width:820px;margin-left:auto;margin-right:auto;">
                <h3 class="mb-4 font-semibold text-slate-800">Riwayat proses</h3>
                <div class="space-y-3">
                    @foreach ($surat->logs as $log)
                        <div class="flex items-start gap-3 rounded-lg border border-slate-100 bg-slate-50/50 p-3">
                            <div class="h-8 w-8 flex-shrink-0 rounded-full bg-[#e4ecdc] text-[#17624c] flex items-center justify-center text-xs">✓</div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-700">{{ str_replace(':', ' → ', str_replace('_', ' ', ucfirst($log->action))) }}</p>
                                @if ($log->notes)
                                    <p class="mt-0.5 text-xs text-slate-500">{{ $log->notes }}</p>
                                @endif
                                <p class="mt-0.5 text-xs text-slate-400">{{ $log->user?->name ?: 'System' }} · {{ $log->created_at?->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
</body>
</html>