<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    protected $table = 'rw';

    protected $fillable = ['nomor_rw', 'nama_ketua', 'alamat', 'telepon'];

    public function rt()
    {
        return $this->hasMany(Rt::class);
    }
}