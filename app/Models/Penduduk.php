<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'penduduk';

    protected $fillable = [
        'nik', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'rt', 'rw',
        'agama', 'pekerjaan', 'status_perkawinan', 'kewarganegaraan', 'telepon', 'user_id',
    ];

    protected function casts(): array
    {
        return ['tanggal_lahir' => 'date'];
    }

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }
}