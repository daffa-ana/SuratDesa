<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    protected $table = 'rt';

    protected $fillable = ['nomor_rt', 'rw_id', 'nama_ketua', 'alamat', 'telepon'];

    public function rw()
    {
        return $this->belongsTo(Rw::class);
    }
}