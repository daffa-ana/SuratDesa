<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat';

    protected $fillable = [
        'nomor_surat', 'jenis_surat', 'penduduk_id', 'rt_id', 'rw_id', 'admin_id',
        'status', 'keperluan', 'catatan_rt', 'catatan_rw', 'catatan_admin',
        'data_tambahan', 'file_pdf', 'tanggal_rt', 'tanggal_rw', 'tanggal_final',
    ];

    protected function casts(): array
    {
        return [
            'data_tambahan' => 'array',
            'tanggal_pengajuan' => 'datetime',
            'tanggal_rt' => 'datetime',
            'tanggal_rw' => 'datetime',
            'tanggal_final' => 'datetime',
        ];
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function rt()
    {
        return $this->belongsTo(Rt::class);
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class);
    }

    public function logs()
    {
        return $this->hasMany(SuratLog::class)->latest();
    }

    public static function generateNomorSurat(string $jenisSurat): string
    {
        $prefix = config('surat.prefixes.' . $jenisSurat, 'XX');
        $now = now();
        $count = static::withTrashed()
            ->where('jenis_surat', $jenisSurat)
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count() + 1;

        return sprintf('%s/%03d/%s/%s', $prefix, $count, $now->format('m'), $now->format('Y'));
    }
}