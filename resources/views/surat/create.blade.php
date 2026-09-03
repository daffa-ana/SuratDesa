<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Pengajuan Surat</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="dashboard-shell min-h-screen text-slate-900">
    <main class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:py-12">
        <a href="{{ route('surat.index') }}" class="text-sm font-bold text-emerald-800 hover:text-emerald-950">&larr; Kembali ke daftar</a>
        <div class="mt-5 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-xl shadow-emerald-900/5">
            <div class="bg-emerald-800 px-6 py-7 text-white sm:px-8"><p class="text-xs font-bold uppercase tracking-[0.18em] text-emerald-200">Layanan warga</p>
            <h1 class="text-2xl font-bold">Pengajuan surat baru</h1>
            <p class="mt-2 text-sm text-emerald-50/80">Nomor surat akan dibuat otomatis setelah pengajuan disimpan.</p></div>
            <div class="p-6 sm:p-8">
            @if ($errors->any()) <div class="mt-5 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div> @endif
            <form action="{{ route('surat.store') }}" method="POST" class="mt-6 space-y-5">
                @csrf
                <label class="block"><span class="text-sm font-semibold">Jenis surat</span><select name="jenis_surat" required class="mt-2 w-full rounded-lg border-slate-300"><option value="">Pilih jenis surat</option>@foreach ($jenisSurat as $key => $prefix)<option value="{{ $key }}" @selected(old('jenis_surat') === $key)>{{ str_replace('_', ' ', ucfirst($key)) }} ({{ $prefix }})</option>@endforeach</select></label>
                <label class="block"><span class="text-sm font-semibold">Penduduk</span><select name="penduduk_id" required class="mt-2 w-full rounded-lg border-slate-300"><option value="">Pilih pemohon</option>@foreach ($penduduk as $item)<option value="{{ $item->id }}" @selected(old('penduduk_id') == $item->id)>{{ $item->nama }} - {{ $item->nik }}</option>@endforeach</select></label>
                <label class="block"><span class="text-sm font-semibold">Keperluan</span><textarea name="keperluan" required rows="4" class="mt-2 w-full rounded-lg border-slate-300" placeholder="Jelaskan keperluan surat">{{ old('keperluan') }}</textarea></label>
                <button class="w-full rounded-lg bg-emerald-700 px-4 py-3 font-semibold text-white hover:bg-emerald-800">Simpan pengajuan</button>
            </form>
            </div>
        </div>
    </main>
</body>
</html>