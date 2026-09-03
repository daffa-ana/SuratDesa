<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuratController extends Controller
{
    public function index(): View
    {
        $user = request()->user();
        $query = Surat::with('penduduk')->latest('tanggal_pengajuan');
        if ($user->isRole('penduduk')) {
            $query->whereHas('penduduk', fn ($penduduk) => $penduduk->where('user_id', $user->id));
        }

        return view('surat.index', [
            'surat' => $query->paginate(10),
            'jenisSurat' => config('surat.prefixes'),
            'user' => $user,
        ]);
    }

    public function create(): View
    {
        return view('surat.create', [
            'penduduk' => Penduduk::orderBy('nama')->get(),
            'jenisSurat' => config('surat.prefixes'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'jenis_surat' => ['required', 'string', 'in:' . implode(',', array_keys(config('surat.prefixes')))],
            'penduduk_id' => ['required', 'exists:penduduk,id'],
            'keperluan' => ['required', 'string', 'max:1000'],
        ]);

        $surat = Surat::create([
            ...$validated,
            'nomor_surat' => Surat::generateNomorSurat($validated['jenis_surat']),
        ]);

        if ($request->user()) {
            $surat->logs()->create([
                'user_id' => $request->user()->id,
                'action' => 'created',
                'new_status' => $surat->status,
            ]);
        }

        return to_route('surat.index')->with('success', 'Pengajuan surat berhasil dibuat.');
    }

    public function approve(Request $request, Surat $surat, string $level): RedirectResponse
    {
        $transitions = [
            'rt' => ['from' => 'pending', 'to' => 'rt_approved', 'date' => 'tanggal_rt'],
            'rw' => ['from' => 'rt_approved', 'to' => 'rw_approved', 'date' => 'tanggal_rw'],
            'admin' => ['from' => 'rw_approved', 'to' => 'finalized', 'date' => 'tanggal_final'],
        ];

        abort_unless(isset($transitions[$level]), 404);
        abort_unless($request->user()->isRole($level), 403);
        $transition = $transitions[$level];
        abort_unless($surat->status === $transition['from'], 422, 'Status surat belum dapat diproses pada tahap ini.');

        $oldStatus = $surat->status;
        $surat->update([
            'status' => $transition['to'],
            $transition['date'] => now(),
            'admin_id' => $level === 'admin' ? ($request->user()?->id ?? User::query()->value('id')) : $surat->admin_id,
        ]);
        $this->writeLog($surat, $request, 'approved:' . $level, $oldStatus);

        return to_route('surat.index')->with('success', 'Surat berhasil disetujui pada tahap ' . strtoupper($level) . '.');
    }

    public function reject(Request $request, Surat $surat, string $level): RedirectResponse
    {
        $allowed = [
            'rt' => ['pending', 'rt_approved'],
            'rw' => ['rt_approved', 'rw_approved'],
            'admin' => ['rw_approved'],
        ];
        abort_unless(isset($allowed[$level]), 404);
        abort_unless($request->user()->isRole($level), 403);
        abort_unless(in_array($surat->status, $allowed[$level], true), 422, 'Status surat belum dapat ditolak pada tahap ini.');

        $oldStatus = $surat->status;
        $surat->update(['status' => $level === 'admin' ? 'rejected' : $level . '_rejected']);
        $this->writeLog($surat, $request, 'rejected:' . $level, $oldStatus, $request->string('notes')->toString());

        return to_route('surat.index')->with('success', 'Pengajuan surat ditolak pada tahap ' . strtoupper($level) . '.');
    }

    private function writeLog(Surat $surat, Request $request, string $action, string $oldStatus, ?string $notes = null): void
    {
        $userId = $request->user()?->id ?? User::query()->value('id');
        if ($userId) {
            $surat->logs()->create([
                'user_id' => $userId,
                'action' => $action,
                'old_status' => $oldStatus,
                'new_status' => $surat->status,
                'notes' => $notes,
            ]);
        }
    }
}